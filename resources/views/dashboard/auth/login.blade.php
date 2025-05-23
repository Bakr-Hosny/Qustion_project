@extends('dashboard.layouts.blank')

@section('content')
    <section class="vh-100" style="background-color: #f4f7f9;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius:5px;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://unctad.org/sites/default/files/2021-03/2021-03-15_eCommerceCOVID19report-1-1220x675px.jpg"
                                    alt="login form" class="img-fluid"
                                    style="border-radius: 5px 0 0 5px;object-fit:cover; height:100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="{{ route('login') }}" method="POST">

                                        <div class="d-flex align-items-center mb-4 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #000000;"></i>
                                            <span class="h1 fw-bold mb-0">Logo</span>
                                        </div>

                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label class="form-label required" for="form2Example17">Email address</label>

                                            <input type="email" name="email" id="email"
                                                class="form-control form-control-lg"
                                                value="@if (session()->has('email')) {{ session()->get('email') }} @endif"
                                                required />

                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label required" for="form2Example27">Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg" required />
                                        </div>

                                        <div class="pt-1 mb-3">
                                            <button style="border-radius: 5px !important;"
                                                class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <br>
                                        <br>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
