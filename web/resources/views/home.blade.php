@extends('layouts.app')
@section('title')
    Дома
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8">
                <div class="card rounded-0 shadow-lg">
                    <div class="card-body">
                        <div class="alert alert-info rounded-0" role="alert" id="success-alert">
                            Вие сте најавен како <strong>{{ Auth::user()->fullName }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ url('profile') }}"
                                       class="btn btn-block btn-light rounded-0 m-1 pt-4 pb-4">
                                        <i class="fas fa-user fa-5x"></i><br>
                                        <h3>Профил</h3>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('subjects') }}"
                                       class="btn btn-block btn-light rounded-0 m-1 pt-4 pb-4">
                                        <i class="fas fa-briefcase fa-5x"></i><br>
                                        <h3>Предмети</h3>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="https://repository.ukim.mk/" target="_blank"
                                       class="btn btn-block btn-light rounded-0 m-1 pt-4 pb-4">
                                        <i class="fas fa-database fa-5x"></i><br>
                                        <h3>Репозитори</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 text-center small text-uppercase">
                                <a href="http://localhost:8888/teacher/?t={{ Auth::user()->id }}" target="_blank"
                                   class="text-info"> Погледни го твојот целосен профил</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
