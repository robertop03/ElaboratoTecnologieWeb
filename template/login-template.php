<!-- FORM DI LOGIN -->
<div class="container my-5">
  <h1 class="text-center fw-bold mb-4">Login</h1>
  <form class="register-form">
    <div class="mb-3">
      <label for="email" class="form-label fw-bold text-dark">Email<span class="text-danger">*</span></label>
      <input type="email" class="form-control" id="email" placeholder="esempio@gmail.com" required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label fw-bold text-dark">Password<span class="text-danger">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" placeholder="deve essere di 8 caratteri" required />
        <button type="button" class="btn btn-outline-secondary toggle-password border">
          <span class="bi bi-eye" role="img" aria-label="icona occhio mostra passsword"></span>
        </button>
      </div>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-dark btn-lg">Accedi</button>
    </div>
  </form>
</div>
<!-- END FORM DI LOGIN -->
