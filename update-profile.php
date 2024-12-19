<?php  
    require_once "./header.php";
$countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Congo (Democratic Republic of the)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea (North)", "Korea (South)", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");

    if(!isset($_SESSION['user'])){
        header("Location: signin.php");
    }
    if(isset($_POST['update123'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id = $_SESSION['user']['id'];
        $sql = "UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE `id` = $id";
        if($conn->query($sql)){
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            echo "<script>toastr.success('User updated successfully')</script>";
            echo "<script>setTimeout(() => {window.location = 'index.php'},2000)</script>";
        }else{
            echo "<script>toastr.error('User updation failed')</script>";
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Update Profile</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $_SESSION['user']['name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $_SESSION['user']['email'] ?>" required>
                        </div>
                        <!-- address line 1 -->
                        <div class="mb-3">
                            <label for="address1">Address Line 1</label>
                            <input type="text" name="address1" id="address1" class="form-control" required>
                        </div>
                        <!-- address line 2 -->
                        <div class="mb-3">
                            <label for="address2">Address Line 2</label>
                            <input type="text" name="address2" id="address2" class="form-control" required>
                        </div>
                        <!-- city -->
                        <div class="mb-3">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>
                        <!-- state -->
                        <div class="mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" required>
                        </div>
                        <!-- zip -->
                        <div class="mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" id="zip" class="form-control" required>
                        </div>
                        <!-- country -->
                        <div class="mb-3">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control" required>
                                <option value="">Select Country</option>
                                <?php
                                    foreach($countries as $country){
                                        echo "<option value='$country'>$country</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- phone -->
                         <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
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