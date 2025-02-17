@extends('layouts.auth')

@section('title', 'Two Factor Challenge - Posts site')

@section('content')
    <x-errors.error-messages
        errTitle="Two-Factor Authentication"
        errSubtitle="Please confirm access to your account"
    ></x-errors.error-messages>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Two-Factor Authentication</h4>
                    </div>
                    <div class="card-body">
                        <p id="auth-text" class="mb-4 text-sm text-gray-600">
                            Please confirm access to your account by entering the authentication code provided by your authenticator application.
                        </p>

                        <form method="POST" action="#">
                            @csrf
                            <div id="auth-code-group">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control" id="code" name="code" inputmode="numeric" autocomplete="one-time-code" autofocus>
                                </div>
                            </div>

                            <div id="recovery-code-group" class="d-none">
                                <div class="mb-3">
                                    <label for="recovery_code" class="form-label">Recovery Code</label>
                                    <input type="text" class="form-control" id="recovery_code" name="recovery_code" autocomplete="one-time-code">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-link p-0 text-decoration-none" id="toggle-recovery">
                                    Use a recovery code
                                </button>
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection