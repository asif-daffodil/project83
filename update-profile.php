<?php
require_once "./header.php";
$countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Congo (Democratic Republic of the)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea (North)", "Korea (South)", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
}
if (isset($_POST['update123'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    if (empty($name)) {
        $errName = "Please enter name";
    } elseif (!preg_match("/^[a-zA-Z.\-\' ]*$/", $name)) {
        $errName = "Only letters and white space allowed";
    } else {
        $crrName = $conn->real_escape_string(validate($name));
    }

    if (empty($email)) {
        $errEmail = "Please enter email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Please enter valid email";
    } else {
        if ($email != $_SESSION['user']['email']) {
            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $errEmail = "Email already exists";
            } else {
                $crrEmail = $conn->real_escape_string(validate($email));
            }
        } else {
            $crrEmail = $conn->real_escape_string(validate($email));
        }
    }

    if (empty($address_line_1)) {
        $errAddressLine1 = "Please enter address line 1";
    } else {
        $crrAddressLine1 = $conn->real_escape_string(validate($address_line_1));
    }

    if (!empty($address_line_2)) {
        $crrAddressLine2 = $conn->real_escape_string(validate($address_line_2));
    }else{
        $crrAddressLine2 = null;
    }

    if (empty($city)) {
        $errCity = "Please enter city";
    } else {
        $crrCity = $conn->real_escape_string(validate($city));
    }

    if (empty($state)) {
        $errState = "Please enter state";
    } else {
        $crrState = $conn->real_escape_string(validate($state));
    }

    if (empty($zip)) {
        $errZip = "Please enter zip";
    } else {
        $crrZip = $conn->real_escape_string(validate($zip));
    }

    if (empty($country)) {
        $errCountry = "Please select country";
    } else {
        $crrCountry = $conn->real_escape_string(validate($country));
    }

    if (empty($phone)) {
        $errPhone = "Please enter phone";
    } else {
        $crrPhone = $conn->real_escape_string(validate($phone));
    }

    $id = $_SESSION['user']['id'];

    if(isset($crrName) && isset($crrEmail) && isset($crrAddressLine1) && isset($crrCity) && isset($crrState) && isset($crrZip) && isset($crrCountry) && isset($crrPhone)){
        $sql = "UPDATE `users` SET `name` = '$crrName', `email` = '$crrEmail', `address_line_1` = '$crrAddressLine1', `address_line_2` = '$crrAddressLine2', `city` = '$crrCity', `state` = '$crrState', `zip` = '$crrZip', `country` = '$crrCountry', `phone` = '$crrPhone' WHERE `id` = '$id'";
        if($conn->query($sql)){
            $sql = "SELECT * FROM `users` WHERE `id` = '$id'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $_SESSION['user'] = $row;
                echo "<script>toastr.success('Profile updated successfully')</script>";
            }
        }else{
            echo "<script>toastr.error('Something went wrong')</script>";
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Update Profile</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- name -->
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm <?= isset($errName) ? "is-invalid" : null ?>" value="<?= $crrName ?? $_SESSION['user']['name'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errName ?? null ?>
                                    </div>
                                </div>
                                <!-- email -->
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm <?= isset($errEmail) ? "is-invalid" : null ?>" value="<?= $crrEmail ?? $_SESSION['user']['email'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errEmail ?? null ?>
                                    </div>
                                </div>
                                <!-- address line 1 -->
                                <div class="mb-3">
                                    <label for="address_line_1">Address Line 1</label>
                                    <input type="text" name="address_line_1" id="address_line_1" class="form-control form-control-sm <?= isset($errAddressLine1) ? "is-invalid" : null ?>" value="<?= $crrAddressLine1 ?? $_SESSION['user']['address_line_1'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errAddressLine1 ?? null ?>
                                    </div>
                                </div>
                                <!-- address line 2 -->
                                <div class="mb-3">
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" name="address_line_2" id="address_line_2" class="form-control form-control-sm" value="<?= $crrAddressLine2 ?? $_SESSION['user']['address_line_2'] ?? null ?>">
                                </div>
                                <!-- city -->
                                <div class="mb-3">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control form-control-sm <?= isset($errCity) ? "is-invalid" : null ?>" value="<?= $crrCity ?? $_SESSION['user']['city'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errCity ?? null ?>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- state -->
                                <div class="mb-3">
                                    <label for="state">State/Division</label>
                                    <input type="text" name="state" id="state" class="form-control form-control-sm <?= isset($errState) ? "is-invalid" : null ?>" value="<?= $crrState ?? $_SESSION['user']['state'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errState ?? null ?>
                                    </div>
                                </div>
                                <!-- zip -->
                                <div class="mb-3">
                                    <label for="zip">Zip/Post Code/Post Office</label>
                                    <input type="text" name="zip" id="zip" class="form-control form-control-sm <?= isset($errZip) ? "is-invalid" : null ?>" value="<?= $crrZip ?? $_SESSION['user']['zip'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errZip ?? null ?>
                                    </div>
                                </div>
                                <!-- country -->
                                <div class="mb-3">
                                    <label for="country">Country</label>
                                    <select name="country" id="country" class="form-select form-select-sm <?= isset($errCountry) ? "is-invalid" : null ?>">
                                        <option value="">Select Country</option>
                                        <?php
                                        foreach ($countries as $country) {
                                        ?>
                                            <option value='<?= $country ?>' <?= isset($crrCountry) && $crrCountry == $country ? "selected" : (isset($_SESSION['user']['country']) &&  $_SESSION['user']['country'] == $country ? "selected" : null) ?>><?= $country ?></option>;
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errCountry ?? null ?>
                                    </div>
                                </div>
                                <!-- phone -->
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-sm <?= isset($errPhone) ? "is-invalid" : null ?>" value="<?= $_SESSION['user']['phone'] ?? null ?>">
                                    <div class="invalid-feedback">
                                        <?= $errPhone ?? null ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark" name="update123">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "./footer.php";
?>