<?php

    class Ordinateur {

        private $os;
        private $hddCapacity;

        private static $network = "192.168.1.200";

        public function __construct($os, $capacity)
        {
            $this->os = $os;
            $this->hddCapacity = $capacity;
        }

        public function displayOrdi() :string
        {
            return "OS : ".$this->os." - Disque dur de ".$this->hddCapacity." Go";
        }

        public static function displayNetwork() :string
        {
            return "Le réseau est ".self::$network;
        }

    }

    echo Ordinateur::displayNetwork();
    echo "<br>";
    echo "<br>";
    $ordi1 = new Ordinateur("Debian 9", "1000");
    $ordi2 = new Ordinateur("Windows 10", "500");

    echo $ordi1->displayOrdi();
    echo "<br>";
    echo $ordi2->displayOrdi();
    
    
