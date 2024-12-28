<?php
require_once "header.php";
if (!isset($_SESSION['user'])) {
    echo "<script>window.location = 'signin.php'</script>";
}
$countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Congo (Democratic Republic of the)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea (North)", "Korea (South)", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");

if (isset($_POST['submit123'])) {
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
    <div class="row py-5">
        <div class="col-md-4 bg-light p-3 rounded shadow">
            <form action="" method="post">
                <!-- get name email phone address_line_1 address_line_2 city state zip country from session if exists and add is-invalid class if errName errEmail is exists and also add .invalid-feedback div  -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= (isset($errName)) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= (isset($_SESSION['user']['name'])) ? $_SESSION['user']['name'] : ''; ?>">
                    <?= (isset($errName)) ? '<div class="invalid-feedback">' . $errName . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= (isset($errEmail)) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= (isset($_SESSION['user']['email'])) ? $_SESSION['user']['email'] : ''; ?>">
                    <?= (isset($errEmail)) ? '<div class="invalid-feedback">' . $errEmail . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control <?= (isset($errPhone)) ? 'is-invalid' : ''; ?>" id="phone" name="phone" value="<?= (isset($_SESSION['user']['phone'])) ? $_SESSION['user']['phone'] : ''; ?>">
                    <?= (isset($errPhone)) ? '<div class="invalid-feedback">' . $errPhone . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="address_line_1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control <?= (isset($errAddressLine1)) ? 'is-invalid' : ''; ?>" id="address_line_1" name="address_line_1" value="<?= (isset($_SESSION['user']['address_line_1'])) ? $_SESSION['user']['address_line_1'] : ''; ?>">
                    <?= (isset($errAddressLine1)) ? '<div class="invalid-feedback">' . $errAddressLine1 . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="<?= (isset($_SESSION['user']['address_line_2'])) ? $_SESSION['user']['address_line_2'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control <?= (isset($errCity)) ? 'is-invalid' : ''; ?>" id="city" name="city" value="<?= (isset($_SESSION['user']['city'])) ? $_SESSION['user']['city'] : ''; ?>">
                    <?= (isset($errCity)) ? '<div class="invalid-feedback">' . $errCity . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control <?= (isset($errState)) ? 'is-invalid' : ''; ?>" id="state" name="state" value="<?= (isset($_SESSION['user']['state'])) ? $_SESSION['user']['state'] : ''; ?>">
                    <?= (isset($errState)) ? '<div class="invalid-feedback">' . $errState . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="zip" class="form-label">Zip</label>
                    <input type="text" class="form-control <?= (isset($errZip)) ? 'is-invalid' : ''; ?>" id="zip" name="zip" value="<?= (isset($_SESSION['user']['zip'])) ? $_SESSION['user']['zip'] : ''; ?>">
                    <?= (isset($errZip)) ? '<div class="invalid-feedback">' . $errZip . '</div>' : ''; ?>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select class="form-select <?= (isset($errCountry)) ? 'is-invalid' : ''; ?>" id="country" name="country">
                        <option value="">Select Country</option>
                        <?php
                        foreach ($countries as $country) {
                            echo "<option value='$country' " . ((isset($_SESSION['user']['country']) && $_SESSION['user']['country'] == $country) ? 'selected' : '') . ">$country</option>";
                        }
                        ?>
                    </select>
                    <?= (isset($errCountry)) ? '<div class="invalid-feedback">' . $errCountry . '</div>' : ''; ?>
                </div>
                <button type="submit" class="btn btn-primary" name="submit123">Submit</button>
            </form>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-7" id="cartProducts">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        if (localStorage.getItem('ghaziCart')) {
            let cart = JSON.parse(localStorage.getItem('ghaziCart'));
            $.post('ajax/checkout.php', {
                cart
            }, (data) => {
                $('#cartProducts').html(data);
            });
        }
    })
</script>
<?php
require_once "footer.php";
?>
