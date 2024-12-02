@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <ul class="nav nav-tabs card-header-tabs" id="loginTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student-login" role="tab" aria-controls="student-login" aria-selected="true">
                                Student
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="staff-tab" data-toggle="tab" href="#staff-login" role="tab" aria-controls="staff-login" aria-selected="false">
                                Staff
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="loginTabsContent">
                        <!-- Student Login Tab -->
                        <div class="tab-pane fade show active" id="student-login" role="tabpanel" aria-labelledby="student-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="student_matric_number">{{ __('Matric Number') }}</label>
                                    <input id="student_matric_number" type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier" value="{{ old('identifier') }}" placeholder="Enter your Matric Number" required autofocus>
                                    @error('identifier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="student_password">{{ __('Password') }}</label>
                                    <input id="student_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your Password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login as Student') }}</button>
                                </div>
                            </form>
                        </div>

                        <!-- Staff Login Tab -->
                        <div class="tab-pane fade" id="staff-login" role="tabpanel" aria-labelledby="staff-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="staff_id">{{ __('Staff ID') }}</label>
                                    <input id="staff_id" type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier" value="{{ old('identifier') }}" placeholder="Enter your Staff ID" required autofocus>
                                    @error('identifier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="staff_password">{{ __('Password') }}</label>
                                    <input id="staff_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your Password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login as Staff') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-outline-primary btn-block" onclick="window.open('https://mail.uitm.edu.my/')">
                        Tatacara Pengaktifan Google UiTM
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


