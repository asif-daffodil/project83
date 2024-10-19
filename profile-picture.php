<?php  
    require_once "./header.php";
    if(!isset($_SESSION['user'])){
        header("Location: signin.php");
    }
    if(isset($_POST['profile_picture123'])){
        $profile_picture = $_FILES['profile_picture'];
        $profile_picture_name = $profile_picture['name'];
        $profile_picture_tmp_name = $profile_picture['tmp_name'];
        $profile_picture_size = $profile_picture['size'];
        $profile_picture_error = $profile_picture['error'];
        $profile_picture_type = $profile_picture['type'];
        $profile_picture_ext = explode('.',$profile_picture_name);
        $profile_picture_actual_ext = strtolower(end($profile_picture_ext));
        $allowed = ['jpg','jpeg','png'];
        if(in_array($profile_picture_actual_ext,$allowed)){
            if($profile_picture_error === 0){
                if($profile_picture_size < 1000000){
                    $profile_picture_new_name = uniqid('',true).".".$profile_picture_actual_ext;
                    $profile_picture_destination = 'uploads/'.$profile_picture_new_name;
                    move_uploaded_file($profile_picture_tmp_name,$profile_picture_destination);
                    $id = $_SESSION['user']['id'];
                    $sql = "UPDATE `users` SET `img` = '$profile_picture_destination' WHERE `id` = $id";
                    if($conn->query($sql)){
                        $_SESSION['user']['img'] = $profile_picture_destination;
                        echo "<script>toastr.success('Profile Picture updated successfully')</script>";
                        echo "<script>setTimeout(() => {window.location = 'index.php'},2000)</script>";
                    }else{
                        echo "<script>toastr.error('Profile Picture updation failed')</script>";
                    }
                }else{
                    echo "<script>toastr.error('Profile Picture size is too large')</script>";
                }
            }else{
                echo "<script>toastr.error('Profile Picture upload failed')</script>";
            }
        }else{
            echo "<script>toastr.error('Profile Picture type is not allowed')</script>";
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Profile Picture</h3>
                </div>
                <div class="card-body">
                    <img src="<?php echo $_SESSION['user']['img'] ?? "./uploads/pp.jpg"  ?>" alt="" id="profile_picture_preview" class="img-fluid mb-3" style="max-height: 150px">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark" name="profile_picture123">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('profile_picture').addEventListener('change',function(){
        let file = this.files[0];
        if(file){
            let reader = new FileReader();
            reader.onload = function(){
                document.getElementById('profile_picture_preview').setAttribute('src',reader.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<?php  
    require_once "./footer.php";
?>