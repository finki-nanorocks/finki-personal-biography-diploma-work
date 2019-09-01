@extends('layouts.app')
@section('title')
    Најава
@endsection
@section('navbar')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5 mt-5">
            <div class="col-md-6">
                <div class="card rounded-0 shadow-lg">
                    <div class="card-header text-center">
                        <img src="{{asset('img/mdf_logo.png')}}" alt="logos" class="img-fluid d-block mx-auto w-25">
                        <span class="small">Универзитет „Св. Кирил и Методиј“ – Скопје<br> Медицински факултет </span>
                        <br> <strong>Наставен кадар</strong>
                    </div>
                    <div class="card-body">
                        <form class="pt-2" method="POST" action="{{ route('login') }}" id="login-form">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control rounded-0" id="email" name="email"
                                       aria-describedby="emailMessage" placeholder="Е-пошта" value="">
                                @if ($errors->has('email'))
                                    <small id="emailMessage"
                                           class="form-text text-danger small font-weight-light">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control rounded-0" id="password" name="password"
                                       placeholder="Лозинка" value="">
                                @if ($errors->has('password'))
                                    <small id="passwordMessage"
                                           class="form-text text-danger small font-weight-light">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="check"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="check">Запамети ме</label>
                            </div>
                            <button type="button" class="btn btn-primary rounded-0 btn-block" id="login-btn">Најава <i
                                        class="fas fa-sign-in-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
