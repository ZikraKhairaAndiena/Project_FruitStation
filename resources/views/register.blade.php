@extends('customer.layouts.main')

@section('content')
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-6">
                <div class="card rounded-3 text-black" style="margin-top: 50px;"> <!-- Menambahkan margin top -->
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="{{ asset('img/fruitStation1.jpg') }}" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Create an account</h4>
                                </div>

                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Your Name" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 70px;" />
                                        <label class="form-label">Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Your Email" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 70px;" />
                                        <label class="form-label">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
                                            placeholder="Your Phone Number" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 70px;" />
                                        <label class="form-label">Phone Number</label>
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Your Address" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 100px;"></textarea>
                                        <label class="form-label">Address</label>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4 position-relative">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 70px;" />
                                        <label class="form-label">Password</label>
                                        <span class="position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; z-index: 1;" onclick="togglePassword('password', 'toggle-icon')">
                                            <i id="toggle-icon" class="fas fa-eye"></i>
                                        </span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4 position-relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                            placeholder="Password Confirm" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 70px;" />
                                        <label class="form-label">Password Confirm</label>
                                        <span class="position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; z-index: 1;" onclick="togglePassword('password_confirmation', 'toggle-icon-confirm')">
                                            <i id="toggle-icon-confirm" class="fas fa-eye"></i>
                                        </span>
                                    </div>

                                    <img src="{{ captcha_src() }}" alt="captcha" class="img-fluid mb-2">
                                    <div class="mt-2"></div>
                                    <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Please Insert Captcha" style="border-radius: 30px; border: 1px solid #ccc; padding: 25px; height: 70px;">
                                     @error('captcha')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" name="terms" value="1" />
                                        <label class="form-check-label">
                                            I agree to all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                        </label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button type="submit" class="btn btn-primary btn-block fa-lg mb-3"
                                        style="background: linear-gradient(to right, #ab2f80, #ebf77f); border: none; border-radius: 30px; color: white; padding: 10px 20px;">
                                            Register
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Already have an account?</p>
                                        <a href="{{ route('login') }}" class="btn btn-outline-danger" style="background: linear-gradient(to right, #56ab2f, #a8e063); border: none; border-radius: 30px; color: white; padding: 10px 20px;">
                                            Login Here
                                        </a>
                                    </div>
                                </form>

                            </div>
                        </div>
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
        padding-right: 60px; /* space for the icon */
        height: 70px; /* set a uniform height for all inputs */
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
