<?php

use Motork\CarController;
use Motork\LeadController;

require_once __DIR__.'/../src/bootstrap.php';

$controller = CarController::create();
$leadController = LeadController::create();

$urlParts = parse_url($_SERVER['REQUEST_URI']);

if (preg_match('#^/detail/([^/]+)$#', $urlParts['path'], $matches)) {

    $url = explode("/",$urlParts['path']);
    $carId = $url[2];
    $controller->getDetail($carId);

}
else if (preg_match('/newLead/', $urlParts['path'], $matches)) {

    $lead = array(
        'firstname' => $_POST['name'],
        'lastname' => $_POST['surname'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'cap' => $_POST['zip'],
        'privacy' => ($_POST['privacy'] == "Y") ? 1 : 0,
        'carId' => $_POST['carId'],
    );

    $leadController->sendLead($lead);
}
else if (preg_match('/successLead/', $urlParts['path'], $matches)) {

    $leadController->getSuccessLead();
}
else if (preg_match('/showLeads/', $urlParts['path'], $matches)) {

    $leadController->getLeads();
}
else {
    $controller->getIndex();
}

