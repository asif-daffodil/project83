<?php  
    require_once "./header.php";
    if(isset($_POST['sendMessage'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // DB table name: contact_messages
        $sql = "INSERT INTO contact_messages (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>toastr.success('Your Message has been sent')</script>";
        }else{
            echo "<script>toastr.error('Failed to send message')</script>";
        }
    }
?>
    <div class="container my-5">
        <h2 class="display-4 text-center mb-5">Contact Us</h2>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="sendMessage">Send Message</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="mb-4">
                    <h4>Address</h4>
                    <p>123, ABC Road, Dhaka, Bangladesh</p>
                </div>
                <div class="mb-4">
                    <h4>Email</h4>
                    <p>contact@example.com</p>
                </div>
                <div class="mb-4">
                    <h4>Phone</h4>
                    <p>+880 1234 567890</p>
                </div>
                <div class="mb-4">
                    <h4>Working Hours</h4>
                    <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                </div>
                <div class="mb-4">
                    <h4>Follow Us</h4>
                    <a href="#" class="me-2"><i class="fa-brands fa-facebook fs-3"></i></a>
                    <a href="#" class="me-2"><i class="fa-brands fa-twitter fs-3"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram fs-3"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.397672081983!2d90.36733127522177!3d23.73319438943683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bfbe6c0bab8b%3A0x8784d7f5150e9ae3!2sAsif%20Abir!5e0!3m2!1sen!2sbd!4v1731140313911!5m2!1sen!2sbd" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div></div>

<?php  
    require_once "./footer.php";
?>