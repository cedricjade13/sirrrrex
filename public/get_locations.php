<?php
// app/public/get_locations.php

// Include necessary configuration and controller files
require '../config/config.php';
require '../config/conf.php';
require '../controllers/UserController.php';

// Create an instance of UserController
$userController = new UserController($conn);

// Set the content type to JSON
header('Content-Type: application/json');

// Check for 'country' parameter and retrieve states
if (isset($_GET['country'])) {
    $country = $_GET['country'];
    $states = $userController->getStatesByCountry($country);
    echo json_encode(['states' => $states]);
    exit;
}

// Check for 'state' parameter and retrieve cities
if (isset($_GET['state'])) {
    $state = $_GET['state'];
    $cities = $userController->getCitiesByState($state);
    echo json_encode(['cities' => $cities]);
    exit;
}

// Check for 'city' parameter and retrieve districts
if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $districts = $userController->getDistrictsByCity($city);
    echo json_encode(['districts' => $districts]);
    exit;
}

// Check for 'district' parameter and retrieve neighborhoods
if (isset($_GET['district'])) {
    $district = $_GET['district'];
    $neighborhoods = $userController->getNeighborhoodsByDistrict($district);
    echo json_encode(['neighborhoods' => $neighborhoods]);
    exit;
}

// If no valid parameter is provided, return an error message
echo json_encode(['error' => 'No valid parameter provided']);
exit;