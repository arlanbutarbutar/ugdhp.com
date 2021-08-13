<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id-user'])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    setcookie('mobileAR', '', time() - 3600);
    setcookie('keyAR', '', time() - 3600);
    header("Location: masuk");exit;
}
