@extends('layouts.app')
@section('title')
    Предмети
@endsection
@section('css')
@endsection
@section('content')
    <section id="my-info">
        <div class="container pt-5">
            <div class="row">
                <div class="col-12">
                    <div class="text-right">
                        <a href="{{ route('subjectsCreateShow') }}" class="btn btn-light rounded-0">Нов предмет
                            <i class="fas fa-book-reader"></i></a>
                    </div>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Име на предмет</th>
                                <th scope="col">Семестар</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Локација</th>
                                <th scope="col" class="text-center">Ажурирај</th>
                                <th scope="col" class="text-center">Избриши</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php $i = 1; ?>
                            @foreach($subjects as $subject)
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td>{{ $subject["title"] }}</td>
                                    <td>{{ $subject["semester"] }}</td>
                                    <td>{{ $subject["status"] }}</td>
                                    <td>{{ $subject["place"] }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('subjectsEdit', $subject["id"] ) }}" method="GET">
                                            <button type="text" class="text-success"><i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('subjectsDelete', $subject["id"] ) }}" method="POST">
                                            @csrf
                                            <button type="button" class="text-danger delete-subject"><i
                                                        class="fas fa-eraser"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('js/subjects.js') }}"></script>
@endsection
