@extends('layouts.app')

@section('content')
<style>
    .password-toggle {
        position: absolute;
        right: 25px;
        transform: translateY(-175%);
        cursor: pointer;
        color: #666;
    }
    .password-input-group {
        position: relative;
    }
</style>
<script>
 // Toggle password visibility
    function togglePasswordVisibility(fieldId, icon) {
        const passwordField = document.getElementById(fieldId);
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        icon.classList.toggle('fa-eye-slash');
    }
    
    // Toggle between Student and Staff registration forms
    function toggleRegistrationForm(userType) {
        const studentForm = document.getElementById('student-registration');
        const staffForm = document.getElementById('staff-registration');

        if (userType === 'student') {
            studentForm.style.display = 'block';
            staffForm.style.display = 'none';
        } else {
            studentForm.style.display = 'none';
            staffForm.style.display = 'block';
        }
    }

    // Load the default tab
    document.addEventListener('DOMContentLoaded', () => {
        toggleRegistrationForm('student');
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <ul class="nav nav-tabs card-header-tabs" id="registerTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" onclick="toggleRegistrationForm('student')">Student</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" onclick="toggleRegistrationForm('staff')">Staff</button>
                        </li>
                    </ul>
                </div>

                 <div class="card-body">
                    <!-- Student Registration Form -->
                    <div id="student-registration">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" name="user_type" value="student">
                            <div class="form-group">
                                <label for="student_name">{{ __('Name') }}</label>
                                <input id="student_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="matric_number">{{ __('Matric Number') }}</label>
                                <input id="matric_number" type="text" class="form-control @error('matric_number') is-invalid @enderror" name="matric_number" value="{{ old('matric_number') }}" required pattern="\d{10}" title="Matric Number must be 10 digits">
                                @error('matric_number')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="student_email">{{ __('E-Mail Address') }}</label>
                                <input id="student_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                           <div class="form-group password-input-group">
                                <label for="student_password">{{ __('Password') }}</label>
                                <input id="student_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePasswordVisibility('student_password', this)"></i>
                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group password-input-group">
                                <label for="student-password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="student-password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePasswordVisibility('student-password-confirm', this)"></i>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">{{ __('Register as Student') }}</button>
                        </form>
                    </div>

                    <!-- Staff Registration Form -->
                    <div id="staff-registration" style="display: none;">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" name="user_type" value="staff">
                            <div class="form-group">
                                <label for="staff_name">{{ __('Name') }}</label>
                                <input id="staff_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="staff_id">{{ __('Staff ID') }}</label>
                                <input id="staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror" name="staff_id" value="{{ old('staff_id') }}" required>
                                @error('staff_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="staff_email">{{ __('E-Mail Address') }}</label>
                                <input id="staff_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                           <div class="form-group password-input-group">
                                <label for="staff_password">{{ __('Password') }}</label>
                                <input id="staff_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePasswordVisibility('staff_password', this)"></i>
                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group password-input-group">
                                <label for="staff-password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="staff-password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePasswordVisibility('staff-password-confirm', this)"></i>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">{{ __('Register as Staff') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Font Awesome for eye icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection

