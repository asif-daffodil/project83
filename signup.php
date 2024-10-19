<?php  
    require_once "header.php";
    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }
    if(isset($_POST['signup123'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name','$email','$password')";
        if($conn->query($sql)){
            echo "<script>toastr.success('User created successfully')</script>";
            echo "<script>setTimeout(() => {window.location = 'signin.php'},2000)</script>";
        }else{
            echo "<script>toastr.error('User creation failed')</script>";
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Sign Up</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark" name="signup123">Sign Up</button>
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
    