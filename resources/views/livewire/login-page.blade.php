<div>
    <div id="layoutAuthentication" class="bg-success">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            @if ($otp_page)
                                otp page
                                <div class="">
                                    {{ $code_expired_at }}
                                    {{ $code_resend_at }}
                                </div>
                            @else
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <center><img src="{{ asset('img/logo/gl-cover-bg-none-sm.jpg') }}" width="220"
                                            alt=""></center>
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login Office</h3>
                                    </div>
                                    @if (session('alert'))
                                        <div class="alert alert-danger">
                                            {{ session('alert') }}
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <form wire:submit.prevent='login'>
                                            <div class="form-floating mb-3">
                                                <input wire:model='email_or_phone' class="form-control" id="inputEmail"
                                                    placeholder="Email atau nomor WA" />
                                                <label for="inputEmail">Email / Nomor WA</label>
                                            </div>
                                            @if ($withPass == true)
                                                <div class="form-floating mb-3">
                                                    <input wire:model='password'
                                                        @if ($withPass == true) required @endif
                                                        class="form-control" id="inputPassword" type="password"
                                                        placeholder="Password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            @endif
                                            {{-- <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div> --}}

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                                                <button type="submit"
                                                    class="btn btn-success form-control">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        {{-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> --}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
</div>


{{-- <style>
    body{
        background-color: green;
    }
</style> --}}
