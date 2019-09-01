@extends('layouts.app')
@section('title')
    Ажурирај предмет
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
                                <strong class="h4 m-3 text-center">Ажурирај предмет</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="pt-2" method="POST" action="{{ route('subjectsUpdate', $subject['id'] ) }}">
                                @csrf
                                @if(Auth::user()->isAdmin)
                                    <div class="form-group">
                                        Предметот го одржува:
                                        <input type="text" class="form-control rounded-0" value="{{ $fullName }}"
                                               disabled>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="title" name="title"
                                           aria-describedby="emailMessage" placeholder="Наслов на предмет"
                                           value="{{$subject['title']}}">
                                    @if ($errors->has('title'))
                                        <small id="emailMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control rounded-0" id="semester" name="semester"
                                           aria-describedby="semesterMessage" placeholder="Семестар"
                                           value="{{$subject['semester']}}">
                                    @if ($errors->has('semester'))
                                        <small id="semesterMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('semester') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="status" name="status"
                                           aria-describedby="statusMessage" placeholder="Статус"
                                           value="{{$subject['status']}}">
                                    @if ($errors->has('status'))
                                        <small id="statusMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('status') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="place" name="place"
                                           aria-describedby="placeMessage" placeholder="Локација"
                                           value="{{$subject['place']}}">
                                    @if ($errors->has('place'))
                                        <small id="placeMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('place') }}</small>
                                    @endif
                                </div>

                                @if(Auth::user()->isAdmin)
                                    <div class="form-group mt-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="updateUser">Aжурирај
                                                кој го одржува предметот
                                            </label>
                                        </div>
                                        <div class="input-group pt-2" id="updateUserBlock" style="display: none;">
                                            <select class="custom-select rounded-0" id="idUser" name="idUser">
                                                <option value="{{ $subject['idUser'] }}" selected>Наставен кадар
                                                </option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user['id'] }}">{{ $user['fullName'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-success rounded-0 btn-block">Ажурирај <i
                                            class="fas fa-clipboard-check"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('js/subject-edit.js') }}"></script>
@endsection
