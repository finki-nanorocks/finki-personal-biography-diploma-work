@extends('layouts.app')
@section('title')
    Додади нов предмет
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
                            <a href="/subjects" class="m-3 text-left text-dark" id="link-subjects"><i
                                        class="fas fa-times-circle fa-1x"></i></a>
                            <div class="text-center">
                                <strong class="h4 m-3 text-center">Нов предмет</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="pt-2" method="POST" action="{{ route('subjectsCreateStore') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="title" name="title"
                                           aria-describedby="emailMessage" placeholder="Наслов на предмет">
                                    @if ($errors->has('title'))
                                        <small id="emailMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control rounded-0" id="semester" name="semester"
                                           aria-describedby="semesterMessage" placeholder="Семестар">
                                    @if ($errors->has('semester'))
                                        <small id="semesterMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('semester') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="status" name="status"
                                           aria-describedby="statusMessage" placeholder="Статус">
                                    @if ($errors->has('status'))
                                        <small id="statusMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('status') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="place" name="place"
                                           aria-describedby="placeMessage" placeholder="Локација">
                                    @if ($errors->has('place'))
                                        <small id="placeMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('place') }}</small>
                                    @endif
                                </div>
                                @if(Auth::user()->isAdmin)
                                    <div class="form-group">
                                        Предметот ќе го одржува:
                                        <div class="input-group">
                                            <select class="custom-select rounded-0" id="idUser" name="idUser">
                                                <option selected>Наставен кадар</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user['id'] }}">{{ $user['fullName'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary rounded-0 btn-block">Додади <i
                                            class="fas fa-check-circle"></i></button>
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
