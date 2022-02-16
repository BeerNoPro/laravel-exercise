@extends('handle-auth.dashboard')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Login</h3>
                        <div class="card-body">
                            <form action="{{ route('login.custom') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email"
                                        required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-info btn-block">Signin</button>
                                </div>

                                {{-- Login with Facebook --}}
                                <div class="flex items-center justify-end mt-4">
                                    <a class="btn text-center w-100" href="{{ url('handle-auth/facebook') }}"
                                        style="background: #3B5499; color: #ffffff; padding: 8px; border-radius:3px;">
                                        Login with Facebook
                                    </a>
                                </div>

                                {{-- Login with Google --}}
                                <div class="flex items-center justify-end mt-4">
                                    <a class="btn btn-primary text-center w-100" href="{{ url('handle-auth/google') }}"
                                        style="padding: 8px; border-radius:3px;">
                                        <i class="bi bi-google"></i>
                                        Login with Google
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
