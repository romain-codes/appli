<?php

require "vendor/autoload.php";
use App\Service\RouterService;

session_start();

$response = RouterService::handleRequest($_GET);

//! CHARGEMENT DE LA REPONSE AU CLIENT
include "template/store/" . $response["view"];