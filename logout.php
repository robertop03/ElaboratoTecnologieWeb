<?php

$_SESSION = [];

// Cancella il cookie della sessione
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
deleteCookie('cart');
session_destroy();
unset($_COOKIE[session_name()]);
header("Location: login.php");
exit();
?>
