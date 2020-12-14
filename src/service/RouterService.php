<?php

namespace App\Service;

abstract class RouterService {
    public static function handleRequest($params) :array {
        //! APPEL DU CONTROLEUR
        $class = "Store"; // controleur par défaut

        if (isset($params['ctrl'])) {
            $uri_class = ucfirst($params['ctrl']);
            if(class_exists("App\Controller\\" . $uri_class . "Controller")) {
                $class = $uri_class;
            }   
        }

        $classname = "App\Controller\\" . $class . "Controller"; // Fully Qualified Class Name (FQCN)
        $controller = new $classname();


        //! APPEL DE LA METHODE DANS LE CONTROLEUR
        $method = "indexAction"; // méthode par défaut

        if (isset($params['action'])) {
            $uri_method = $params['action']."Action";
            if(method_exists($controller, $uri_method)) {
                $method = $uri_method;
            }
        }


        //! PRISE EN CHARGE DU PARAMETRE OPTIONNEL $params['id']
        $id = null;

        if(isset($params['id'])){
            $id = $params['id'];
        }

        return $controller->$method($id);
    }
}