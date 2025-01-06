<!-- FORM DI REGISTRAZIONE -->
<div class="container my-5">
  <h1 class="text-center fw-bold mb-4">Crea account</h1>
  <form class="register-form">
    <div class="mb-3">
      <label for="email" class="form-label fw-bold text-dark">Email<span class="text-danger">*</span></label>
      <input type="email" class="form-control" id="email" placeholder="esempio@gmail.com" required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label fw-bold text-dark">Crea una password<span class="text-danger">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" placeholder="deve essere di 8 caratteri" name="password" required />
        <button class="btn btn-outline-secondary toggle-password" type="button">
          <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
        </button>
      </div>
    </div>
    <div class="mb-3">
      <label for="confirm-password" class="form-label fw-bold text-dark">Conferma password<span class="text-danger">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="confirm-password" placeholder="ripeti password" name="confirm-password" required />
        <button class="btn btn-outline-secondary toggle-password" type="button">
          <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
        </button>
      </div>
    </div>
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="terms" required />
      <label class="form-check-label" for="terms"> I accept the terms and privacy policy<span class="text-danger">*</span> </label>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-dark btn-lg"> Crea account </button>
    </div>
  </form>
</div>
<!-- END FORM DI REGISTRAZIONE -->
