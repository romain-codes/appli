<?php
    namespace App\Manager;
    use App\Entity\Product;


    //! Gestionnaire de produits en base de données
    class ProductManager {
        private $pdo;

        //$ Constructeur
        public function __construct() {
            $this->pdo = new \PDO(
                "mysql:host=localhost:3306;dbname=appli-formulaire",
                "root",
                "",
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, //les erreurs venant de MySQL seront des Exception
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC //on récupère les données de MySQL dans un tableau associatif
                    //ex : ['name' => 'Biscuit', 'price' => 25.5]
                ]
            );
        }


        //$ Récupère tous les produits de la base de données
        public function getAll(){
            
            $sql = "SELECT id, name, price FROM product";//select tous les produits
            $stmt = $this->pdo->query($sql);//on prépare la requête
            $results = $stmt->fetchAll();//on récupère tous les enregistrements

            $products = [];//on initialise le tableau final qui va contenir les produits
            foreach($results as $result){//pour chaque résultat trouvé en base de données
                $products[] = new Product(//on instancie un objet Product
                    $result["id"],
                    $result["name"], 
                    $result["price"]
                );
            }
            return $products;
        }

        public function getOnebyId($id) {
            $sql = "SELECT id, name, price FROM product WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                "id" => $id
            ]);

            $result = $stmt->fetch();

            return new Product(
                $result['id'],
                $result['name'],
                $result['price']
            );
        }


        //$ Insère un nouveau produit dans la base de données
        public function insert($name, $price){
            $sql = "INSERT INTO product (name, price) VALUES (:name, :price)";
            $stmt = $this->pdo->prepare($sql);
            
            return $stmt->execute([
                "name" => $name,
                "price" => $price,
            ]); // retourne true ou false. Avec insert into, c'est ce qui nous intéresse.
        }

        public function delete($id) {
            $sql = "DELETE FROM product WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                "id" => $id,
            ]);
        }
    }