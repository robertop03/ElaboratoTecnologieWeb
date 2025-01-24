<!-- FORM DI REGISTRAZIONE -->
<div class="container my-5">
  <h1 class="text-center fw-bold mb-4"><?php echo $linguaAttuale == "en" ? "Create account" : "Crea account" ?></h1>
  <?php if(isset($templateParams["errore"])): ?>
    <div class="alert alert-danger">
      <?php echo $templateParams["errore"]; ?>
    </div>
  <?php endif; ?>
  <form class="register-form" action="#" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label fw-bold text-dark">Email<span class="text-danger">*</span></label>
      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $linguaAttuale == "en" ? "example@gmail.com" : "esempio@gmail.com" ?>" required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label fw-bold text-dark"><?php echo $linguaAttuale == "en" ? "Create a password" : "Crea una password" ?><span class="text-danger">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $linguaAttuale == "en" ? "should be at least 8 characters long" : "deve essere di almeno 8 caratteri" ?>" name="password" required />
        <button class="btn btn-outline-secondary toggle-password" type="button">
          <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
        </button>
      </div>
    </div>
    <div class="mb-3">
      <label for="confirm-password" class="form-label fw-bold text-dark"><?php echo $linguaAttuale == "en" ? "Confirm password" : "Conferma password" ?><span class="text-danger">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="confirm-password" placeholder="<?php echo $linguaAttuale == "en" ? "repeat password" : "ripeti password" ?>" name="confirm-password" required />
        <button class="btn btn-outline-secondary toggle-password" type="button">
          <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
        </button>
      </div>
    </div>
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="terms" required />
      <label class="form-check-label" for="terms"><?php echo $linguaAttuale == "en" ? "I accept the terms and privacy policy" : "Accetto i termini e le condizioni di privacy" ?><span class="text-danger">*</span> </label>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-dark btn-lg"> <?php echo $linguaAttuale == "en" ? "Create account" : "Crea account" ?></button>
    </div>
  </form>
  <div class="text-center mt-4">
    <p class="mb-0">
      <?php echo $linguaAttuale == "en" ? "Do you already have an account?" : "Hai già un account?"; ?>
      <a href="login.php" class="fw-bold text-decoration-none"><?php echo $linguaAttuale == "en" ? "Log in" : "Effettua login"; ?></a>
    </p>
  </div>

</div>
<!-- END FORM DI REGISTRAZIONE -->
