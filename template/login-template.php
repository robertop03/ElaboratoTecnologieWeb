<!-- FORM DI LOGIN -->
<div class="container my-5">
  <h1 class="text-center fw-bold mb-4">Login</h1>
  <?php if(isset($templateParams["errorelogin"])): ?>
  <p class="text-center"><?php echo $templateParams["errorelogin"]; ?></p>
  <?php endif; ?>
  <form class="register-form" action="#" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label fw-bold text-dark">Email<span class="text-danger">*</span></label>
      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $linguaAttuale == "en" ? "example@gmail.com" : "esempio@gmail.com" ?>" required autocomplete="email" />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label fw-bold text-dark">Password<span class="text-danger">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $linguaAttuale == "en" ? "should be at least 8 characters long" : "deve essere di almeno 8 caratteri" ?>" required autocomplete="current-password"/>
        <button type="button" class="btn btn-outline-secondary toggle-password border">
          <span class="bi bi-eye" role="img" aria-label="icona occhio mostra passsword"></span>
        </button>
      </div>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-dark btn-lg"><?php echo $linguaAttuale == "en" ? "Log in" : "Accedi" ?></button>
    </div>
  </form>
  <div class="text-center mt-4">
    <p class="mb-0">
      <?php echo $linguaAttuale == "en" ? "Don't have an account?" : "Non hai un account?"; ?>
      <a href="register.php" class="fw-bold text-decoration-none"><?php echo $linguaAttuale == "en" ? "Create new account" : "Crea nuovo account"; ?></a>
    </p>
  </div>
</div>
<!-- END FORM DI LOGIN -->
