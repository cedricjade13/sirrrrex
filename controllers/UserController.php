<?php
require_once '../models/User.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function createUser($data) {
        return $this->userModel->create($data);
    }

    public function updateUser($id, $data) {
        return $this->userModel->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->userModel->delete($id);
    }

    public function displayUsers() {
        return $this->userModel->getAll();
    }

    public function viewUser($id) {
        return $this->userModel->getById($id);
    }

    // Get states from the database using the User model
    // usercontroller.php
    public function getStatesByCountry($country) {
        $stmt = $this->userModel->getStatesByCountry($country);
        return $stmt;
    }

    public function getCitiesByState($state) {
        $stmt = $this->userModel->getCitiesByState($state);
        return $stmt;
    }

    public function getDistrictsByCity($city) {
        $stmt = $this->userModel->getDistrictsByCity($city);
        return $stmt;
    }

    public function getNeighborhoodsByDistrict($district) {
        $stmt = $this->userModel->getNeighborhoodsByDistrict($district);
        return $stmt;
    }
}
?>
