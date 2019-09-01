@extends('layouts.app')
@section('title')
    Категории
@endsection
@section('css')
@endsection
@section('content')
    <section id="my-info">
        <div class="container pt-5">
            <div class="row pt-2">
                <div class="col-md-6">
                    <h4 class="text-center">Додади нова категорија</h4>
                    <div class="card rounded-0">
                        <div class="container">
                            <form class="m-1 pt-4 pb-4" method="POST" action="{{ route('createCategory') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="category-name">Име на нова категорија</label>
                                    <input id="category-name" name="name" type="text" required="required"
                                           class="form-control here rounded-0"
                                           placeholder="Категорија">
                                    @if ($errors->has('name'))
                                        <small class="text-danger font-weight-light"
                                               id="err-msg-category-name">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-right">
                                            <button class="btn btn-info rounded-0" id="btn-change-password"
                                                    type="submit">Додади категорија
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="text-center">Категории за наставен кадар</h4>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Категорија</th>
                                <th scope="col" class="text-center">Ажурирај</th>
                                <th scope="col" class="text-center">Избриши</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php $i = 1; ?>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td>{{ $category["name"] }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('editCategory', $category["id"] ) }}" type="text"
                                           class="btn btn-sm text-success"><i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('deleteCategory') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idCategory" value="{{ $category["id"] }}">
                                            <button type="button" class="text-danger delete-category"><i
                                                        class="fas fa-eraser"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(isset($msgErrCategory))
                            <div class="alert alert-danger" role="alert">
                                {{ $msgErrCategory }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('js/categories.js') }}"></script>
@endsection
