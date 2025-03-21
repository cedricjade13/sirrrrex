<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db; // Initialize the connection
    }

    public function create($data) {
        $sql = "INSERT INTO personal_data (last_name, first_name, middle_initial, 
        date_of_birth, gender, civil_status, other_civil_status, tax_identification_number, 
        nationality, religion, place_of_birth_city, place_of_birth_province, place_of_birth_country, 
        home_address_city, home_address_province, home_address_country, mobile_number, email_address, 
        telephone_number, father_last_name, father_first_name, father_middle_name, mother_last_name, 
        mother_first_name, mother_middle_name, place_of_birth_state, home_address_state, 
        place_of_birth_district, home_address_district, place_of_birth_neighborhood, home_address_neighborhood) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssssssssssssssss",
            $data['last_name'], $data['first_name'], $data['middle_initial'], $data['date_of_birth'],
            $data['gender'], $data['civil_status'], $data['other_civil_status'], $data['tax_identification_number'],
            $data['nationality'], $data['religion'], $data['place_of_birth_city'], $data['place_of_birth_province'],
            $data['place_of_birth_country'], $data['home_address_city'], $data['home_address_province'],
            $data['home_address_country'], $data['mobile_number'], $data['email_address'], $data['telephone_number'],
            $data['father_last_name'], $data['father_first_name'], $data['father_middle_name'],
            $data['mother_last_name'], $data['mother_first_name'], $data['mother_middle_name'],
            $data['place_of_birth_state'], $data['home_address_state'], $data['place_of_birth_district'], 
            $data['home_address_district'], $data['place_of_birth_neighborhood'], $data['home_address_neighborhood']
        );
    
        return $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE personal_data SET 
                    last_name=?, first_name=?, middle_initial=?, date_of_birth=?, 
                    gender=?, civil_status=?, other_civil_status=?, 
                    tax_identification_number=?, nationality=?, religion=?, 
                    place_of_birth_city=?, place_of_birth_province=?, place_of_birth_country=?, 
                    home_address_city=?, home_address_province=?, home_address_country=?, 
                    mobile_number=?, email_address=?, telephone_number=?, 
                    father_last_name=?, father_first_name=?, father_middle_name=?, 
                    mother_last_name=?, mother_first_name=?, mother_middle_name=?, 
                    place_of_birth_state=?, home_address_state=?, 
                    place_of_birth_district=?, home_address_district=?, 
                    place_of_birth_neighborhood=?, home_address_neighborhood=? 
                WHERE id=?";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param("ssssssssssssssssssssssssssssi", 
            $data['last_name'], $data['first_name'], $data['middle_initial'], 
            $data['date_of_birth'], $data['gender'], $data['civil_status'], 
            $data['other_civil_status'], $data['tax_identification_number'], 
            $data['nationality'], $data['religion'], $data['place_of_birth_city'], 
            $data['place_of_birth_province'], $data['place_of_birth_country'], 
            $data['home_address_city'], $data['home_address_province'], 
            $data['home_address_country'], $data['mobile_number'], $data['email_address'], 
            $data['telephone_number'], $data['father_last_name'], $data['father_first_name'], 
            $data['father_middle_name'], $data['mother_last_name'], $data['mother_first_name'], 
            $data['mother_middle_name'], $data['place_of_birth_state'], $data['home_address_state'], 
            $data['place_of_birth_district'], $data['home_address_district'], 
            $data['place_of_birth_neighborhood'], $data['home_address_neighborhood'], $id
        );
        
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM personal_data WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = "SELECT * FROM personal_data";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM personal_data WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        // Calculate age and add it to the user array
        if ($user) {
            $user['age'] = $this->calculateAge($user['date_of_birth']);
        }

        return $user;
    }

    private function calculateAge($dateOfBirth) {
        $dob = new DateTime($dateOfBirth);
        $today = new DateTime();
        return $today->diff($dob)->y; // Get the age in years
    }

    // Method to get countries
    // user.php
    public function getStatesByCountry($country) {
        $sql = "SELECT * FROM states WHERE country_id = (SELECT id FROM countries WHERE name = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $country);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getCitiesByState($state) {
        $sql = "SELECT * FROM cities WHERE state_id = (SELECT id FROM states WHERE name = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $state);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getDistrictsByCity($city) {
        $sql = "SELECT * FROM districts WHERE city_id = (SELECT id FROM cities WHERE name = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $city);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getNeighborhoodsByDistrict($district) {
        $sql = "SELECT * FROM neighborhoods WHERE district_id = (SELECT id FROM districts WHERE name = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $district);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>