<?php
// app/public/form.php

require '../config/config.php';
require '../config/conf.php';
require '../controllers/UserController.php';

$userController = new UserController($conn);

$errors = []; // Initialize an array to hold error messages
$data = []; // Initialize an array to hold form data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST; // Assuming data is coming from a form

    // Validate names
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['last_name'])) {
        $errors['last_name'] = "Last name must not contain numbers.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['first_name'])) {
        $errors['first_name'] = "First name must not contain numbers.";
    }
    // Updated validation for middle initial to accept only one letter
    if (!preg_match("/^[a-zA-Z]$/", $data['middle_initial'])) {
        $errors['middle_initial'] = "Middle initial must be a single letter.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['father_last_name'])) {
        $errors['father_last_name'] = "Father's last name must not contain numbers.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['father_first_name'])) {
        $errors['father_first_name'] = "Father's first name must not contain numbers.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['father_middle_name'])) {
        $errors['father_middle_name'] = "Father's middle name must not contain numbers.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['mother_last_name'])) {
        $errors['mother_last_name'] = "Mother's last name must not contain numbers.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['mother_first_name'])) {
        $errors['mother_first_name'] = "Mother's first name must not contain numbers.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $data['mother_middle_name'])) {
        $errors['mother_middle_name'] = "Mother's middle name must not contain numbers.";
    }

    // Validate date of birth (must be at least 18 years old)
    $dateOfBirth = new DateTime($data['date_of_birth']);
    $today = new DateTime();
    $age = $today->diff($dateOfBirth)->y;
    if ($age < 18) {
        $errors['date_of_birth'] = "You must be at least 18 years old.";
    }

    // Validate tax identification number (must be numeric)
    if (!preg_match("/^\d+$/", $data['tax_identification_number'])) {
        $errors['tax_identification_number'] = "Tax Identification Number must be numeric.";
    }

    // Validate mobile number (must be 11 to 15 digits)
    if (!preg_match("/^\d{11,15}$/", $data['mobile_number'])) {
        $errors['mobile_number'] = "Must not a letter and must be between 11-15 digits.";
    }

    // Validate email address (already validated by HTML5)
    if (!filter_var($data['email_address'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_address'] = "Email Address must be in a valid format.";
    }

    // Validate country selection (dropdown)
    $countries = ['USA', 'Canada', 'UK', 'Australia']; // Example countries
    if (!in_array($data['home_address_country'], $countries) || !in_array($data['place_of_birth_country'], $countries)) {
        $errors['country'] = "Please select a valid country from the dropdown.";
    }

    // If there are no errors, proceed with user creation or update
    if (empty($errors)) {
        if (isset($data['id'])) {
            if ($userController->updateUser  ($data['id'], $data)) {
                $message = "Information updated successfully!";
            } else {
                $message = "Error updating user.";
            }
        } else {
            if ($userController->createUser  ($data)) {
                $message = "Information created successfully!";
            } else {
                $message = "Error creating user.";
            }
        }
        header("Location: index.php?message=" . urlencode($message)); // Redirect with message
        exit; // Ensure no further code is executed after redirect
    }
}

// If it's a GET request, we are displaying the form for a new user
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>Add New Information</title>
    <style>
        .error {
            color: red; /* Set error message color to red */
            font-size: 0.9em; /* Optional: make the font size smaller */
        }

        .sidebar a{
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }

        .sidebar h2{
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }

        .content{
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }

        .info-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .info-grid input,
        .info-grid select {
            flex: 1 1 calc(33.333% - 20px); /* Each item takes 1/3 of the width */
            min-width: 400px; /* Prevents items from shrinking too much */
            box-sizing: border-box; /* Ensures padding and border are included in the width */
        }

        .info-grid .gender_male input{
            min-width: 50px;            
        }

        .info-grid .gender_female input{
            min-width: 50px;
        }

        .info-grid .gender_male input{
            min-width: 50px;     
            margin-left: 10px;       
        }
        .info-grid .gender_female p{
            margin-right: 208px;            
        }

        
        

        .gender-selection {
            display: flex;
            font-size: 13px; /* Font size for the labels */
            color: #333; /* Neutral text color */
        }

        /* Style each label to align the radio button on the left */
        .gender-selection label {
            display: flex;
            align-items: center; /* Center the radio button and text vertically */
            gap: 4px; /* Space between radio button and label text */
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        /* Ultra small custom radio button */
        

        /* Optional: Add hover effect for better UX */
        .gender-selection input[type="radio"]:hover {
            border-color: #888; /* Change border color on hover */
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            padding: 8px 0;
            border-bottom: 2px solid #ccc;
            margin-top: 20px;
        }

        /* Info Container */
        .info-container {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        /* Styling individual info */
        .info-row {
            display: flex;
            flex: 1 1 100%; /* Each row takes full width */
            gap: 20px; /* Space between items in the row */
        }
        
    </style>
    
</head>
<body>
    <div class="sidebar">
        <h2><i class="fa-solid fa-sitemap"></i>  CJPG</h2>
        <a href="index.php"><i class="fa-solid fa-circle-info"></i> Information  List</a>
        <a href="form.php"><i class="fa-solid fa-user-plus"></i> Add New</a>
        <!-- Add more links as needed -->
    </div>
    <div class="content">
        <h1>New Information</h1>
        <hr>
        <br>
        <form method="POST" action="form.php">
            <div class="info-container">
                <h2 class="section-title">Personal Information</h2>
                
                <div class="info-grid">
                    <div class="info-row">
                        <div>
                            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($data['last_name'] ?? ''); ?>" >
                            <div>
                                <?php if (isset($errors['last_name'])): ?>
                                    <div class='error'><?php echo htmlspecialchars($errors['last_name']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($data['first_name'] ?? ''); ?>" >
                            <div>
                                <?php if (isset($errors['first_name'])): ?>
                                    <div class='error'><?php echo htmlspecialchars($errors['first_name']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <input type="text" name="middle_initial" placeholder="Middle Initial" value="<?php echo htmlspecialchars($data['middle_initial'] ?? ''); ?>" >
                            <div>
                                <?php if (isset($errors['middle_initial'])): ?>
                                    <div class='error'><?php echo htmlspecialchars($errors['middle_initial']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div>
                            <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($data['date_of_birth'] ?? ''); ?>" >
                            <div>
                                <?php if (isset($errors['date_of_birth'])): ?>
                                    <div class='error'><?php echo htmlspecialchars($errors['date_of_birth']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="gender-selection">
                            <label for="gender_male" class="gender_male">
                                <input class="c" type="radio" name="gender" value="Male" id="gender_male"  <?php echo (isset($data['gender']) && $data['gender'] === 'Male') ? 'checked' : ''; ?>>
                                <p>Male</p>
                            </label>

                            <label for="gender_female" class="gender_female">
                                <input class="c" type="radio" name="gender" value="Female" id="gender_female"  <?php echo (isset($data['gender']) && $data['gender'] === 'Female') ? 'checked' : ''; ?>>
                                <p>Female</p>
                            </label>
                        </div>

                        <div>
                            <select name="civil_status" id="civil_status" >
                                <option value="">Select Civil Status</option>
                                <option value="Single" <?php echo (isset($data['civil_status']) && $data['civil_status'] === 'Single') ? 'selected' : ''; ?>>Single</option>
                                <option value="Married" <?php echo (isset($data['civil_status']) && $data['civil_status'] === 'Married') ? 'selected' : ''; ?>>Married</option>
                                <option value="Widowed" <?php echo (isset($data['civil_status']) && $data['civil_status'] === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                <option value="Divorced" <?php echo (isset($data['civil_status']) && $data['civil_status'] === 'Divorced') ? 'selected' : ''; ?>>Divorced</option>                               
                            </select>
                            <input type="text" id="other_civil_status" name="other_civil_status" placeholder="Other Civil Status" value="<?php echo htmlspecialchars($data['other_civil_status'] ?? ''); ?>" style="display: none;">
                        </div>
                    </div>

                    <div class="info-row">
                        <div>
                            <input type="text" name="tax_identification_number" placeholder="Tax Identification Number" value="<?php echo htmlspecialchars($data['tax_identification_number'] ?? ''); ?>" >
                            <div>
                                <?php if (isset($errors['tax_identification_number'])): ?>
                                    <div class='error'><?php echo htmlspecialchars($errors['tax_identification_number']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <input type="text" name="nationality" placeholder="Nationality" value="<?php echo htmlspecialchars($data['nationality'] ?? ''); ?>" >
                        </div>

                        <div>
                            <input type="text" name="religion" placeholder="Religion" value="<?php echo htmlspecialchars($data['religion'] ?? ''); ?>" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-container">
                <h2 class="section-title">Place of Birth</h2>
                <div class="info-grid">
                    <div class="info-row">
                        <div>
                            <select name="place_of_birth_country" id="place_of_birth_country">
                                <option value="">Select Country</option>
                                <option value="USA" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'USA') ? 'selected' : ''; ?>>USA</option>
                                <option value="Canada" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'Canada') ? 'selected' : ''; ?>>Canada</option>
                                <option value="UK" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'UK') ? 'selected' : ''; ?>>UK</option>
                                <option value="Australia" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'Australia') ? 'selected' : ''; ?>>Australia</option>
                                <option value="Philippines" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'Philippines') ? 'selected' : ''; ?>>Philippines</option>
                            </select>
                        </div>
                        <div>
                            <select name="place_of_birth_state" id="place_of_birth_state">
                                <option value="">Select State</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                        <div>
                            <select name="place_of_birth_city" id="place_of_birth_city">
                                <option value="">Select City</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                        
                    </div>
                    <div class="info-row">
                        
                        <div>
                            <select name="place_of_birth_district" id="place_of_birth_district">
                                <option value="">Select District</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                        <div>
                            <select name="place_of_birth_neighborhood" id="place_of_birth_neighborhood">
                                <option value="">Select Neighborhood</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-container">
                <h2 class="section-title">Home Address</h2>
                <div class="info-grid">
                    <div class="info-row">
                    

                        <div>
                            <select name="home_address_country" id="home_address_country">
                                <option value="">Select Country</option>
                                <option value="USA" <?php echo (isset($data['home_address_country']) && $data['home_address_country'] === 'USA') ? 'selected' : ''; ?>>USA</option>
                                <option value="Canada" <?php echo (isset($data['home_address_country']) && $data['home_address_country'] === 'Canada') ? 'selected' : ''; ?>>Canada</option>
                                <option value="UK" <?php echo (isset($data['home_address_country']) && $data['home_address_country'] === 'UK') ? 'selected' : ''; ?>>UK</option>
                                <option value="Australia" <?php echo (isset($data['home_address_country']) && $data['home_address_country'] === 'Australia') ? 'selected' : ''; ?>>Australia</option>
                                <option value="Philippines" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'Philippines') ? 'selected' : ''; ?>>Philippines</option>
                                <option value="Europe" <?php echo (isset($data['place_of_birth_country']) && $data['place_of_birth_country'] === 'Europe') ? 'selected' : ''; ?>>Europe</option>
                            </select>
                        </div>
                        <div>
                            <select name="home_address_state" id="home_address_state">
                                <option value="">Select State</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                        <div>
                            <select name="home_address_city" id="home_address_city">
                                <option value="">Select City</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                        
                    </div>
                    <div class="info-row">
                        
                        <div>
                            <select name="home_address_district" id="home_address_district">
                                <option value="">Select District</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                        <div>
                            <select name="home_address_neighborhood" id="home_address_neighborhood">
                                <option value="">Select Neighborhood</option>
                                <!-- States will be populated here via AJAX -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-container">
                <h2 class="section-title">Contact Information</h2>
                <div class="info-grid">
                    <div class="info-row">
                        <div>
                            <input type="text" name="mobile_number" placeholder="Mobile Number" value="<?php echo htmlspecialchars($data['mobile_number'] ?? ''); ?>" >
                            <?php if (isset($errors['mobile_number'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['mobile_number']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <input type="email" name="email_address" placeholder="Email Address" value="<?php echo htmlspecialchars($data['email_address'] ?? ''); ?>" >
                            <?php if (isset($errors['email_address'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['email_address']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <input type="text" name="telephone_number" placeholder="Telephone Number" value="<?php echo htmlspecialchars($data['telephone_number'] ?? ''); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-container">
                <h2 class="section-title">Parent's Information</h2>
                <div class="info-grid">
                    <div class="info-row">
                        <div>
                            <input type="text" name="father_last_name" placeholder="Father's Last Name" value="<?php echo htmlspecialchars($data['father_last_name'] ?? ''); ?>" >
                            <?php if (isset($errors['father_last_name'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['father_last_name']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <input type="text" name="father_first_name" placeholder="Father's First Name" value="<?php echo htmlspecialchars($data['father_first_name'] ?? ''); ?>" >
                            <?php if (isset($errors['father_first_name'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['father_first_name']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <input type="text" name="father_middle_name" placeholder="Father's Middle Name" value="<?php echo htmlspecialchars($data['father_middle_name'] ?? ''); ?>">
                                <?php if (isset($errors['father_middle_name'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['father_middle_name']); ?></div>
                            <?php endif; ?>
                        
                        </div>
                    </div>

                    <div class="info-row">
                        <div>
                            <input type="text" name="mother_last_name" placeholder="Mother's Last Name" value="<?php echo htmlspecialchars($data['mother_last_name'] ?? ''); ?>" >
                            <?php if (isset($errors['mother_last_name'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['mother_last_name']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <input type="text" name="mother_first_name" placeholder="Mother's First Name" value="<?php echo htmlspecialchars($data['mother_first_name'] ?? ''); ?>" >
                            <?php if (isset($errors['mother_first_name'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['mother_first_name']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <input type="text" name="mother_middle_name" placeholder="Mother's Middle Name" value="<?php echo htmlspecialchars($data['mother_middle_name'] ?? ''); ?>">
                                <?php if (isset($errors['mother_middle_name'])): ?>
                                <div class='error'><?php echo htmlspecialchars($errors['mother_middle_name']); ?></div>
                            <?php endif; ?>
                        
                        </div>
                    </div>
                </div>
            </div>`

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
    // Function to toggle the visibility of the "Other Civil Status" input
        function toggleOtherCivilStatus() {
            var civilStatusSelect = document.getElementById('civil_status');
            var otherCivilStatusInput = document.getElementById('other_civil_status');
            
            if (civilStatusSelect.value === 'Other') {
                otherCivilStatusInput.style.display = 'block';
            } else {
                otherCivilStatusInput.style.display = 'none';
                otherCivilStatusInput.value = ''; // Clear the input if not selected
            }
        }

        // Add event listener to the civil status dropdown
        document.getElementById('civil_status').addEventListener('change', toggleOtherCivilStatus);

        // Check the initial value of the civil status dropdown on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleOtherCivilStatus(); // Call the function to set the initial state
        });

        // Dynamic loading of states, cities, districts, and neighborhoods
    document.getElementById('place_of_birth_country').addEventListener('change', function() {
        var country = this.value;
        fetch(`get_locations.php?country=${country}`)
            .then(response => response.json())
            .then(data => {
                var stateSelect = document.getElementById('place_of_birth_state');
                stateSelect.innerHTML = '<option value="">Select State</option>'; // Reset states
                data.states.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.name}">${state.name}</option>`;
                });
            });
    });

    document.getElementById('place_of_birth_state').addEventListener('change', function() {
        var state = this.value;
        fetch(`get_locations.php?state=${state}`)
            .then(response => response.json())
            .then(data => {
                var citySelect = document.getElementById('place_of_birth_city');
                citySelect.innerHTML = '<option value="">Select City</option>'; // Reset cities
                data.cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.name}">${city.name}</option>`;
                });
            });
    });

    document.getElementById('home_address_country').addEventListener('change', function() {
        var country = this.value;
        fetch(`get_locations.php?country=${country}`)
            .then(response => response.json())
            .then(data => {
                var stateSelect = document.getElementById('home_address_state');
                stateSelect.innerHTML = '<option value="">Select State</option>'; // Reset states
                data.states.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.name}">${state.name}</option>`;
                });
            });
    });

    document.getElementById('home_address_state').addEventListener('change', function() {
        var state = this.value;
        fetch(`get_locations.php?state=${state}`)
            .then(response => response.json())
            .then(data => {
                var citySelect = document.getElementById('home_address_city');
                citySelect.innerHTML = '<option value="">Select City</option>'; // Reset cities
                data.cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.name}">${city.name}</option>`;
                });
            });
    });

    document.getElementById('place_of_birth_city').addEventListener('change', function() {
        const city = this.value;
        fetch(`get_locations.php?city=${city}`)
            .then(response => response.json())
            .then(data => {
                const districtSelect = document.getElementById('place_of_birth_district');
                districtSelect.innerHTML = '<option value="">Select District</option>'; // Reset districts
                data.districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name; // Assuming 'name' is the district name
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            });
    });

    document.getElementById('place_of_birth_district').addEventListener('change', function() {
        const district = this.value;
        fetch(`get_locations.php?district=${district}`)
            .then(response => response.json())
            .then(data => {
                const neighborhoodSelect = document.getElementById('place_of_birth_neighborhood');
                neighborhoodSelect.innerHTML = '<option value="">Select Neighborhood</option>'; // Reset neighborhoods
                data.neighborhoods.forEach(neighborhood => {
                    const option = document.createElement('option');
                    option.value = neighborhood.name; // Assuming 'name' is the neighborhood name
                    option.textContent = neighborhood.name;
                    neighborhoodSelect.appendChild(option);
                });
            });
    });
    document.getElementById('home_address_city').addEventListener('change', function() {
        const city = this.value;
        fetch(`get_locations.php?city=${city}`)
            .then(response => response.json())
            .then(data => {
                const districtSelect = document.getElementById('home_address_district');
                districtSelect.innerHTML = '<option value="">Select District</option>'; // Reset districts
                data.districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name; // Assuming 'name' is the district name
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            });
    });

    document.getElementById('home_address_district').addEventListener('change', function() {
        const district = this.value;
        fetch(`get_locations.php?district=${district}`)
            .then(response => response.json())
            .then(data => {
                const neighborhoodSelect = document.getElementById('home_address_neighborhood');
                neighborhoodSelect.innerHTML = '<option value="">Select Neighborhood</option>'; // Reset neighborhoods
                data.neighborhoods.forEach(neighborhood => {
                    const option = document.createElement('option');
                    option.value = neighborhood.name; // Assuming 'name' is the neighborhood name
                    option.textContent = neighborhood.name;
                    neighborhoodSelect.appendChild(option);
                });
            });
    });
    </script>
</body>
</html>