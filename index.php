<?php

require "vendor/autoload.php";
require "config.php";

use App\Service\RouterService;

session_start();

$response = RouterService::handleRequest($_GET);

//! CHARGEMENT DE LA REPONSE AU CLIENT
ob_start();

include TEMPLATE_DIR.$response["view"];
$page = ob_get_contents();

ob_end_clean();

include TEMPLATE_DIR."layout.php";
