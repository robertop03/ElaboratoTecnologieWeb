<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === 'admin' && $password === 'admin') {
        setcookie('adminLogin', 'true', time() + 3600, '/');
        echo '<script type="text/javascript">window.location.href = "index.php";</script>';
        exit; 
    } else {
        $error_message = '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
    }
}
?>
<div class="container my-5">
    <h1 class="text-center fw-bold mb-4">Login Admin</h1>
    <?php
    if (isset($error_message)) {
        echo $error_message;
    }
    ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="username" class="form-label fw-bold text-dark">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label fw-bold text-dark">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-dark btn-lg">Log in</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

