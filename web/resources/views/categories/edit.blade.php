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
                            <a href="{{ route('showCategories') }}" class="m-3 text-left text-dark" id="link-subjects"><i
                                        class="fas fa-times-circle fa-1x"></i></a>
                            <div class="text-center">
                                <strong class="h4 m-3 text-center">Ажурирај категорија</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="pt-2" method="POST" action="{{ route('updateCategory',  $category->id ) }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-0" id="name-category" name="name"
                                           aria-describedby="semesterMessage" placeholder="Име на категорија"
                                           value="{{ $category->name }}">
                                    @if ($errors->has('name'))
                                        <small id="semesterMessage"
                                               class="form-text text-danger small font-weight-light">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-success rounded-0 btn-block">Ажурирај <i
                                            class="fas fa-clipboard"></i></button>
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
