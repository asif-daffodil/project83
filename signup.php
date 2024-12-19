<?php
require_once "header.php";
if (isset($_SESSION['user'])) {
    header("Location: index.php");
}
if (isset($_POST['valibutton']) && $_POST['valibutton'] == 'Sign-up') {
    $hasError = false;
    $name = validate($_POST['yname']);
    $email = validate($_POST['yemail']);
    $password = validate($_POST['ypassword']);

    if (empty($name)) {
        $errName = "Name is required";
        $hasError = true;
    } elseif (!preg_match('/^[A-Za-z\s.]+$/', $name)) {
        $errName = "Only letters, dots, and white spaces are allowed";
        $hasError = true;
    } else {
        $correctName = $name;
    }

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

    if (!$hasError) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name','$email','$hashedPassword')";
        if ($conn->query($sql)) {
            echo "<script>toastr.success('User created successfully')</script>";
            echo "<script>setTimeout(() => {window.location = 'signin.php'}, 2000)</script>";
        } else {
            echo "<script>toastr.error('User creation failed')</script>";
        }
    }
}
?>
<div class="container">
    <div class="row d-flex" style="min-height: calc(100vh - 50px);">
        <div class="col-lg-6 m-auto" style="height: max-content;">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Sign Up</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="yname" class="form-label">Name</label>
                            <input type="text" id="yname" name="yname"
                                class="form-control <?= isset($errName) ? 'is-invalid' : null ?>"
                                value="<?= $correctName ?? null ?>">
                            <div class="invalid-feedback"><?= $errName ?? null ?></div>
                        </div>
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
                            <button type="submit" class="btn btn-dark" name="valibutton" value="Sign-up">Sign Up</button>
                        </div>
                        <div class="small">
                            Already have an account? <a href="signin.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.php";
?>
