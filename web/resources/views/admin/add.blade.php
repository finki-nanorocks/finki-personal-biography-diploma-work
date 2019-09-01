@extends('layouts.app')
@section('title')
    Нов наставен кадар
@endsection
@section('css')
@endsection
@section('content')
    <section id="my-info">
        <div class="container pt-5">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-6 offset-sm-0 offset-md-2 offset-lg-3">
                    <div class="card rounded-0 shadow-lg">
                        <div class="card-header">
                            <a href="/panel" class="m-3 text-left text-dark" style="position: absolute; top:-7px;font-size:24px;"><i class="fas fa-times-circle fa-1x"></i></a>
                            <div class="text-center">
                                <strong class="h4 m-3 text-center">Нов наставен кадар</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="pt-2" method="POST" action="{{ route('createUser') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="fullName" name="fullName" aria-describedby="fullNameMessage" placeholder="Титула, име, презиме">
                                    @if ($errors->has('fullName'))
                                        <small id="fullNameMessage" class="form-text text-danger small font-weight-light">{{ $errors->first('fullName') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control rounded-0" id="email" name="email" aria-describedby="emailMessage" placeholder="Е-пошта">
                                    @if ($errors->has('email'))
                                        <small id="emailMessage" class="form-text text-danger small font-weight-light">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control rounded-0" id="password" name="password" aria-describedby="passwordMessage" placeholder="Лозинка">
                                    @if ($errors->has('password'))
                                        <small id="passwordMessage" class="form-text text-danger small font-weight-light">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary rounded-0 btn-block">Додади <i class="fas fa-user-plus"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
