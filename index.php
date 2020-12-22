<?php

require "vendor/autoload.php";

use App\Service\RouterService;

session_start();

$response = RouterService::handleRequest($_GET);

//! CHARGEMENT DE LA REPONSE AU CLIENT
ob_start();

include "template/store/" . $response["view"];
$page = ob_get_contents();

ob_end_clean();

include "template/layout.php";
