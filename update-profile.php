<?php  
    require_once "./header.php";
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