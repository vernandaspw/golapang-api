@extends('layouts.polos')

@push('style')
    <style>
         body{
            background-color: rgb(84, 164, 104);
        }
    </style>
@endpush

@section('content')
<main class="login-form mt-5">
    <div class="cotainer">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @else
                        <form action="{{ url('mitra/auth/reset-password', []) }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail / Phone</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email_or_phone" required autofocus>
                                    @if ($errors->has('email_or_phone'))
                                        <span class="text-danger">{{ $errors->first('email_or_phone') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirm Password Baru</label>
                                <div class="col-md-6">
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn mt-3 rounded-pill text-white" style="background-color: rgb(84, 164, 104)">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@endsection
