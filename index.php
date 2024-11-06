<?php
session_start();
// <!-- Display Confirmation Message -->
            if (isset($_SESSION['status'])) {
                echo '<div id="confirmationMessage" class="alert alert-info" role="alert">' . $_SESSION['status'] . '</div>';
                unset($_SESSION['status']); // Clear the message after displaying
            }
?>


<!-- HTML code start here  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
   
</head>
<body>
        <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-box card p-5 shadow-md" style="width: 20rem;">
            <h4 class="text-center mb-4 text-dark">Send messege</h4>
            <form id="emailForm" action="./actions/php/mailer.php" method="post">
               <input type="text" name="subject" class="form-control mb-3" placeholder="Subject" required>
                <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
                <input type="text" name="email" class="form-control mb-3" placeholder="Email" required>
                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message" required="required" data-error="Message is required."></textarea><br>
                <button type="submit" name="submit" class="btn btn-dark w-100">Send</button>
            </form>
        </div>
        </div>


    <script src="assets/js/jquery-2.2.3.min.js"></script>  
    <script src="assets/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>  
    <script src="assets/js/script.js"></script>  
</body>
</html>