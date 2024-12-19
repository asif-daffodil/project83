<?php
require_once "header.php";
if (isset($_SESSION['user'])) {
    header("Location: index.php");
}
if (isset($_POST['valibutton']) && $_POST['valibutton'] == 'Sign-in') {
    $hasError = false;
    $email = validate($_POST['yemail']);
    $password = validate($_POST['ypassword']);

    if (empty($email)) {
        $errEmail = "Email is required";
        $hasError = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Invalid email format";
        $hasError = true;
    } else {
        $correctEmail = $email;
    }

    if (empty($password)) {
        $errPassword = "Password is required";
        $hasError = true;
    } elseif (strlen($password) < 8) {
        $errPassword = "Password must be at least 8 characters long";
        $hasError = true;
    }

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            echo "<script>toastr.success('User logged in successfully')</script>";
            echo "<script>setTimeout(() => {window.location = 'index.php'},2000)</script>";
        } else {
            echo "<script>toastr.error('Invalid password')</script>";
        }
    } else {
        echo "<script>toastr.error('Invalid email')</script>";
    }
}
?>
<div class="container">
    <div class="row d-flex" style="min-height: calc(100vh - 50px);">
        <div class="col-lg-6 m-auto" style="height: max-content;">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="yemail" class="form-label">Email</label>
                            <input type="email" id="yemail" name="yemail"
                                class="form-control <?= isset($errEmail) ? 'is-invalid' : null ?>"
                                value="<?= $correctEmail ?? null ?>">
                            <div class="invalid-feedback"><?= $errEmail ?? null ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="ypassword" class="form-label">Password</label>
                            <input type="password" id="ypassword" name="ypassword"
                                class="form-control <?= isset($errPassword) ? 'is-invalid' : null ?>">
                            <div class="invalid-feedback"><?= $errPassword ?? null ?></div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark" name="valibutton" value="Sign-in">Sign
                                In</button>
                        </div>
                    </form>
                    <!-- don't have any account? -->
                    <div class="small">
                        Don't have any account? <a href="signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>
