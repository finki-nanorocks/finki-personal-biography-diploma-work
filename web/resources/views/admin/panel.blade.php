@extends('layouts.app')
@section('title')
    Наставен кадар
@endsection
@section('css')
@endsection
@section('content')
    <section id="my-info">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="search" placeholder="Пребарај наставен кадар по име, презиме, e-пошта" class="form-control form-control rounded-0" lang="mk" xml:lang="mk" dir="ltr" />
                        <small id="emailMessage" class="form-text text-muted small font-weight-light">За пребарување по целосно име и презиме променете ја тастатурата на Македонски јазик</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="btn-group float-right">
                        <a href="{{ route('showCategories') }}" class="btn btn-light rounded-0">
                            Категории <i class="fas fa-toggle-on"></i>
                        </a>
                        <a href="{{ route('subjectsCreateShow') }}" class="btn btn-light rounded-0">
                            Нов предмет <i class="fas fa-book"></i>
                        </a>
                        <a href="{{ route('createUserLoadForm') }}" class="btn btn-light rounded-0">
                            Нов кадар <i class="fas fa-user-plus"></i>
                        </a>
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
                                <th scope="col">име и презиме</th>
                                <th scope="col">Е-пошта</th>
                                <th scope="col" class="text-center">Најави се како</th>
                                <th scope="col" class="text-center">Избриши профил</th>
                            </tr>
                            </thead>
                            <tbody id="table-users">
                            <?php $i = 1; ?>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td>{{ $teacher["fullName"] }}</td>
                                    <td>{{ $teacher["email"] }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('loginUser')  }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $teacher["id"] }}" name="userId">
                                            <button type="text" class="text-primary"><i class="fas fa-user"></i></button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('deleteUser')  }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $teacher["id"] }}" name="userId">
                                            <button type="button" class="text-danger delete-usr" ><i class="fas fa-user-times"></i></button>
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
    <script>
        $(document).ready(function (e) {

            // confirm message to delete user
            $(".delete-usr").on('click', function () {
                let succ = confirm("Дали сте сигурни дека сакате да го избришете профилот?");
                if(succ)
                {
                    $(this).attr('type', 'submit');
                }
            });

            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table-users tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
    </script>
@endsection
