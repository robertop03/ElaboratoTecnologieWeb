<?php
setcookie("adminLogin", "", time() - 3600, "/"); // Cancella il cookie
echo '<script type="text/javascript">window.location.href = "index.php";</script>';
exit;
?>