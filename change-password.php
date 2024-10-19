<?php  
    require_once "./header.php";
    if(!isset($_SESSION['user'])){
        header("Location: signin.php");
    }
    if(isset($_POST['change_password123'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM `users` WHERE `id` = $id";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if(password_verify($old_password,$user['password'])){
                if($new_password == $confirm_password){
                    $new_password = password_hash($new_password,PASSWORD_DEFAULT);
                    $sql = "UPDATE `users` SET `password` = '$new_password' WHERE `id` = $id";
                    if($conn->query($sql)){
                        echo "<script>toastr.success('Password changed successfully')</script>";
                        echo "<script>setTimeout(() => {window.location = 'index.php'},2000)</script>";
                    }else{
                        echo "<script>toastr.error('Password updation failed')</script>";
                    }
                }else{
                    echo "<script>toastr.error('New password and confirm password should be same')</script>";
                }
            }else{
                echo "<script>toastr.error('Old password is incorrect')</script>";
            }
        }else{
            echo "<script>toastr.error('User not found')</script>";
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Change Password</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark" name="change_password123">Change Password</button>
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