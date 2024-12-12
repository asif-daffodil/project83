<?php
require_once "./header.php";
require_once "./components/hero.php";
require_once "./components/heroBottom.php";
?>
<div class="container">
    <?php require_once "./components/latestProducts.php" ?>
</div>
<div class="position-relative py-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.397672081983!2d90.36733127522177!3d23.73319438943683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bfbe6c0bab8b%3A0x8784d7f5150e9ae3!2sAsif%20Abir!5e0!3m2!1sen!2sbd!4v1731140313911!5m2!1sen!2sbd" width="100%" style="border:0; filter: grayscale(); min-height: 350px; height: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="position-absolute top-0 start-o"></iframe>
    <div class="col-md-5 mx-auto p-5 rounded shadow border position-relative" style="background: rgba(255,255,255,0.9)">
        <form action="" method="post">
            <div class="mb-3">
                <label for="yname">Your Name</label>
                <input type="text" id="yname" name="yname" class="form-control">
            </div>
            <div class="mb-3">
                <label for="yemail">Your Email</label>
                <input type="email" id="yemail" name="yemail" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ysubject">Subject</label>
                <input type="text" id="ysubject" name="ysubject" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ymsg">Message</label>
                <textarea name="ymsg" id="ymsg" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

</div>

<?php
require_once "./footer.php";
?>
