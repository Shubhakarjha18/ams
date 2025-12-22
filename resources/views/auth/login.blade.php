@extends('backend.layouts.login')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100 px-3">
    <div class="card shadow-lg mt-5 mx-auto" style="max-width: 400px; width: 100%;">
        <div class="card-header bg-secondary">
            <h3 class="text-center text-white">Login</h3>
        </div>
        <div class="card-body">
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="fs-5 fw-bolder m-2">Email</label>
                    <input type="email" name="email" class="form-control w-100" placeholder="Enter Your Email">
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="fs-5 fw-bolder m-2">Password</label>
                    <input type="password" name="password" class="form-control w-100" placeholder="Enter Your Password">
                </div>

                <div class="form-group text-center mb-3">
                    <button type="submit" class="btn btn-info w-100 text-dark fw-bolder" id="loginBtn">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                        <span id="btnText">Sign In</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Enter a valid email address"
                },
                password: {
                    required: "Password is required"
                }
            },
            errorClass: "text-danger",
            errorElement: "span",
            submitHandler: function(form) {
                $("#loginBtn").prop("disabled", true);
                $("#btnText").html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Signing In...');
                form.submit();
            }
        });
    });
</script>
@endpush
