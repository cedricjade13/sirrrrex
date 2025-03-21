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
    public function getStates() {
        return $this->userModel->getStates();
    }

    // Get districts by stateId using the User model
    public function getDistricts($stateId) {
        return $this->userModel->getDistricts($stateId);
    }

    // Get neighborhoods by districtId using the User model
    public function getNeighborhoods($districtId) {
        return $this->userModel->getNeighborhoods($districtId);
    }
}
?>
