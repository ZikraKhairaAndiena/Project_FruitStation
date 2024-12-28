@extends('customer.layouts.main')

@section('content')
<!-- Login Template -->
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <br>
            <br>
            <div class="text-center mb-3">
              <img src="{{ asset('img/fruitStation1.jpg') }}" alt="Fruit Station" style="width: 100%; max-width: 175px; height: auto;">
            </div>
            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Please login to your account</h2>
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="row gy-2 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" required style="border-radius: 30px; border: 1px solid #ccc; padding: 10px 15px;">
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-12 position-relative">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required style="border-radius: 30px; border: 1px solid #ccc; padding: 10px 15px;">
                    <label for="password" class="form-label">Password</label>
                    <span class="position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('password', 'toggle-icon')">
                      <i id="toggle-icon" class="fas fa-eye"></i>
                    </span>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex gap-2 justify-content-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe">
                      <label class="form-check-label text-secondary" for="rememberMe">
                        Keep me logged in
                      </label>
                    </div>
                    <a href="#!" class="link-primary text-decoration-none">Forgot password?</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" type="submit" style="background: linear-gradient(to right, #ab2f80, #ebf77f); border: none; border-radius: 30px; color: white; padding: 10px 20px;">Log in</button>
                  </div>
                </div>
                <div class="col-12">
                  <p class="m-0 text-secondary text-center">Don't have an account? <a href="{{ route('register') }}" class="link-primary text-decoration-none btn btn-outline-danger" style="background: linear-gradient(to right, #56ab2f, #a8e063); border: none; border-radius: 30px; color: white; padding: 10px 20px;">Create New</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    function togglePassword(fieldId, iconId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(iconId);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<style>
    .form-outline .form-control {
        padding-right: 50px; /* space for the icon */
    }
    .position-absolute {
        z-index: 1; /* Ensure the icon is above other elements */
        top: 50%;
        right: 15px;
        transform: translateY(-50%); /* Center vertically */
        cursor: pointer;
    }
</style>

@endsection
