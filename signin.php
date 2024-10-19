<?php  
    require_once "header.php";
    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }
    if(isset($_POST['signin123'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($password,$row['password'])){
                $_SESSION['user'] = $row;
                echo "<script>toastr.success('User logged in successfully')</script>";
                echo "<script>setTimeout(() => {window.location = 'index.php'},2000)</script>";
            }else{
                echo "<script>toastr.error('Invalid password')</script>";
            }
        }else{
            echo "<script>toastr.error('Invalid email')</script>";
        }
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto my-5">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3>Sign In</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark" name="signin123">Sign In</button>
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