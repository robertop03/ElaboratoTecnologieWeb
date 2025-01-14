<?php
if (!(isset($_SESSION["email"]) && $db->checkIsAdmin($_SESSION["email"]) == 1)) {
    echo "You don't have permission to access this page. Please login as an admin.";
    exit();
} 
?>