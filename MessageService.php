<?php
    //! Classe/service de gestion des messages (erreur, succès, etc.) en session
    abstract class MessageService {
        //$ Récupère tous les messages d'un certain type et les supprime de la session
        public static function getMessages($type){
            if(isset($_SESSION['messages'][$type])){
                $messages = $_SESSION['messages'][$type];
                unset($_SESSION['messages'][$type]);
                return $messages;
            }
            else return false;
        }

        //$ Ajoute un message en session en précisant le type de message dont il s'agit
        public static function setMessage($type, $message){
            $_SESSION['messages'][$type][] = $message;
        }
    }
