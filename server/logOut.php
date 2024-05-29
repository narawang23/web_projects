
<?php
session_start();
session_unset();
session_destroy();
header("Location: ../pages/logIn.html?logged_out=true");
exit();
?>