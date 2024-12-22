<?php
require_once "header.php";
if (!isset($_SESSION['user'])) {
    echo "<script>window.location = 'signin.php'</script>";
}
$countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Congo (Democratic Republic of the)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea (North)", "Korea (South)", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
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
                <button type="submit" class="btn btn-primary">Submit</button>
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