@extends('layouts.app', ['navoff' => true, 'bodyclass' => "bg-login", 'title' => 'VC - Login'])

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="container-fluid">
                <br>
                <div class="card" style="width: 30em;">
                    <div class="card-body">
                        <h5 class="card-title">VC</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Login</h6>
                        <br>
                        <form action="{{ route('users.login') }}" method="POST">
                            @csrf
                            @include('components/messages')

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                                            <label class="form-check-label" for="remember">Lembrar?</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Esqueceu a senha?') }}</a>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <a class="btn btn-link" href="{{ route('users.create') }}">É novo? cadastre-se.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection