
<?php
session_start();
$errorMessage = '';
if (isset($_SESSION['signupError'])) {
    $errorMessage = $_SESSION['signupError'];
    unset($_SESSION['signupError']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <title>TaskFlow: registration</title>
</head>

<body>
    <?php if (!empty($errorMessage)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($errorMessage); ?>
        </div>
    <?php endif; ?>
    <div class="formcontainer">
        <h1>Welcome to TaskFlow</h1>
        <hr>
        <form action="../server/registration.php" method="post" onsubmit="return validate();">
            <div class="textfield">
                <label for="email">Email Address</label><br>
                <input type="text" name="email" id="email" placeholder="x@x.x">
                <p id="emailAlert" class="alert-text"></p>
            </div>

            <div class="textfield">
                <label for="userName">User Name</label><br>
                <input type="text" name="userName" id="userName">
                <p id="nameAlert" class="alert-text"></p>
            </div>

            <div class="textfield">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password">
                <p id="pwdAlert" class="alert-text"></p>
            </div>

            <div class="textfield">
                <label for="pass2">Re-type Password</label><br>
                <input type="password" id="pass2">
                <p id="pwd2Alert"></p>
            </div>

            <div class="checkbox">
                <input type="checkbox" name="terms" id="terms">
                <label for="terms">I agree to the terms and conditions</label>
                <p id="#termsAlert"></p>
            </div>

            <button type="submit">Sign-Up</button>
            <button type="reset">Reset</button>

        </form>
        <p>Aleady have an account? <a href="logIn.html">Sign In></a> </p>
    </div>
    <script src="../scripts/registrationValidation.js"></script>
</body>

</html>