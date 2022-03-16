@extends('layouts.auth')

@section('title')
    <title>Dashboard Login</title>
@endsection

@section('style')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="{{ asset('/image/loginHero.webp') }}" class="img-fluid" alt="Sample image">
                    </div>

                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0">E-LAPOR</p>
                            </div>
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger form-label">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input id="email" name="email" type="email" class="form-control form-control-lg"
                                    placeholder="john.doe@gmail.com" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus />

                                <label class="form-label" for="email">Alamat Email</label>
                            </div>

                            <!-- Password input -->

                            <div class="form-outline mb-3">
                                <input type="password" id="password" name="password" class="form-control form-control-lg"
                                    placeholder="Enter password" required autocomplete="current-password" />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="form2Example3">
                                        Remember me
                                    </label>
                                </div>
                                {{-- <a href="#!" class="text-body">Forgot password?</a> --}}
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
