@extends('layouts.app')
@section('title')
    Мој профил
@endsection
@section('css')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section id="my-info">
        <div class="container">
            <div class="pt-5">
                <div class="nav-group">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @if(! Auth::user()->isAdmin)
                            <a class="rounded-0 nav-item nav-link text-muted <?php echo (Auth::user()->isAdmin) ? '' : 'active';?>"
                               id="nav-photo-tab" data-toggle="tab" href="#nav-photo" role="tab"
                               aria-controls="nav-photo" aria-selected="true">Фотографија</a>
                        @endif
                        <a class="rounded-0 nav-item nav-link text-muted <?php echo (Auth::user()->isAdmin) ? 'active' : '';?>"
                           id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info"
                           aria-selected="false">Информации</a>
                        <a class="rounded-0 nav-item nav-link text-muted" id="nav-password-tab" data-toggle="tab"
                           href="#nav-password" role="tab" aria-controls="nav-password"
                           aria-selected="false">Лозинка</a>
                        @if(! Auth::user()->isAdmin)
                            <a class="rounded-0 nav-item nav-link text-muted" id="nav-resume-tab" data-toggle="tab"
                               href="#nav-resume" role="tab" aria-controls="nav-resume" aria-selected="false">Резиме</a>
                        @endif
                    </div>
                </div>
                <div class="tab-content border border-top-0 shadow-sm pb-4" id="nav-tabContent">
                    <!-- avatar -->
                    <div class="tab-pane fade <?php echo (Auth::user()->isAdmin) ? '' : 'show active';?>" id="nav-photo"
                         role="tabpanel" aria-labelledby="nav-photo-tab">
                        <div class="row pt-5">
                            <div class="col-md-6 offset-md-3 col-sm-12">
                                <p class="text-left small border-left p-4 mt-4 mb-4">
                                    <span class="text-danger">*</span>Во овој таб може да ја ажурирате вашата
                                    фотографија.
                                    <br>
                                    <strong>Напомена: </strong>
                                    Потребно е сликата да биде не поголема од димензии 250x250 и да е од тип PNG.
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if(Auth::user()->img == null)
                                            <img src="https://i.ibb.co/VHsf8xC/slika-1.jpg" alt="Профилна слика"
                                                 class="mx-auto d-block img-width avatar">
                                        @else
                                            <img src="uploads/{{ Auth::user()->img }}" alt="Профилна слика"
                                                 class="mx-auto d-block img-width avatar">
                                        @endif
                                        <p class="small text-muted text-center font-weight-light m-0">Тековна
                                            фотографија</p>
                                    </div>
                                    <div class="col-md-6">

                                        <form action="{{ url('/upload/img') }}" method="post"
                                              class="m-1 pt-5 text-center" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group border p-1">
                                                <input id="img" name="img" type="file" required="required"
                                                       accept="image/png"
                                                       class="form-control-file form-control-sm rounded-0">
                                            </div>
                                            <div class="text-left">
                                                <button type="submit" class="btn btn-sm btn-info rounded-0"
                                                        id="btn-upload-img">Потврди ја промената
                                                </button>
                                            </div>
                                        </form>
                                        @if ($errors->any())
                                            <div class="alert alert-danger small rounded-0" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="small font-weight-light">{{$error}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- personal info -->
                    <div class="tab-pane fade <?php echo (Auth::user()->isAdmin) ? 'show active' : '';?>" id="nav-info"
                         role="tabpanel" aria-labelledby="nav-info-tab">
                        <div class="row pt-5">
                            <div class="col-md-6 offset-md-3">
                                <p class="text-left small border-left p-4">
                                    <span class="text-danger">*</span>Во овој таб може да ја промените вашите основни
                                    информации.
                                    Препорачливо е сите полиња да се пополнети, бидејќи ова се основни информации за
                                    вашиот профил.
                                    <br><br>
                                    @if(! Auth::user()->isAdmin)
                                        При избирање на категорија профилот ќе се прикажува во категориите од наставен
                                        кадар.
                                        <br><br>
                                        Со пополнување на <strong>репозитори име</strong> во правилен формат, сите ваши публикации ќе бидат земени од
                                        <a href="https://repository.ukim.mk" target="_blank">тука</a> за градење на вашиот профил.
                                        <br><br>
                                    @endif
                                    <strong>Напомена</strong>
                                    <br>Доколку правите промена на е-пошта оставете го катанецот отклучен, во спротивно
                                    промените нема да бидат земени предвид.
                                </p>
                                <form class="m-1 pt-4">
                                    <div class="form-group">
                                        <label for="email">E-пошта</label>
                                        <div class="input-group">
                                            <input id="email" name="email" type="email" required="required"
                                                   class="form-control here rounded-0" value="{{ $user->email }}"
                                                   disabled>
                                            <div class="input-group-append">
                                                <button class="btn btn-info rounded-0" type="button"
                                                        id="btn-email-input"><i class="fas fa-lock"></i></button>
                                            </div>
                                        </div>
                                        <small class="text-danger font-weight-light" id="err-msg-email"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullName">Титула, Име, Презиме</label>
                                        <input id="fullName" name="fullName" type="text" required="required"
                                               class="form-control here rounded-0" value="{{ $user->fullName }}"
                                               placeholder="пример проф. д-р Петко Петковски">
                                        <small class="text-danger font-weight-light" id="err-msg-full-name"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Адреса на раб.</label>
                                        <input id="address" name="address" type="text" required="required"
                                               class="form-control here rounded-0" value="{{ $user->address }}">
                                        <small class="text-danger font-weight-light" id="err-msg-address"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Институција</label>
                                        <input id="institution" name="institution" type="text" required="required"
                                               class="form-control here rounded-0" value="{{ $user->institution }}">
                                        <small class="text-danger font-weight-light" id="err-msg-institution"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">
                                            @if(Auth::user()->isAdmin)
                                                Факултет
                                            @else
                                                Катедра
                                            @endif
                                        </label>
                                        <input id="department" name="department" type="text" required="required"
                                               class="form-control here rounded-0" value="{{ $user->department }}">
                                        <small class="text-danger font-weight-light" id="err-msg-department"></small>
                                    </div>
                                    @if(! Auth::user()->isAdmin)
                                        <div class="form-group">
                                            <label for="repoId">Репозитори име</label>
                                            <input id="repoId" name="repoId" type="text" required="required"
                                                   class="form-control here rounded-0"
                                                   placeholder="пример Петковски, Петко" value="{{ $user->repoId }}">
                                            <small class="text-muted font-weight-light" id="err-msg-repo-id">Како да
                                                го пополнам <a download="repository_name.png" href="{{ asset('img/repository_name.png') }}" title="repository_name">репозитори името</a>?
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="id-assistant">Соработник / Aсистент</label>
                                            <select class="custom-select rounded-0" id="id-assistants"
                                                    name="id-assistant">
                                                <option value="" selected>Неодредено</option>
                                                @foreach($users as $u)
                                                    <option value="{{ $u['id'] }}" <?php echo ($u['id'] == $user->idAssistant) ? 'selected="true"' : '' ?>>
                                                        {{ $u['fullName'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger font-weight-light"
                                                   id="err-msg-id-assistant"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="id-category">Категорија</label>
                                            <select class="custom-select rounded-0" id="id-category" name="id-category">
                                                <option value="" selected>Неодредено</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category['id'] }}" <?php echo ($category['id'] == $user->idCategory) ? 'selected="true"' : '' ?>>
                                                        {{ $category['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger font-weight-light"
                                                   id="err-msg-id-category"></small>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <small class="text-danger font-weight-light" id="err-msg-user-id"></small>
                                    </div>

                                    <div class="alert alert-success mt-4 d-none small rounded-0" role="alert"
                                         id="d-info-msg">
                                        <i class="fas fa-check-circle"></i> <span class="alert-message small"></span>
                                    </div>

                                    <div class="text-right">
                                        <button name="submit" type="button" class="btn btn-info rounded-0"
                                                id="submit-info">Зачувај ги промените
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- password -->
                    <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                        <div class="row pt-5">
                            <div class="col-md-6 offset-md-3 col-sm-12">
                                <p class="text-left small border-left p-4">
                                    <span class="text-danger">*</span>Во овој таб може да ја промените вашата лозинка.
                                    <br/><br/>
                                    <strong>Препорачливо е во вашата нова лозинка да корисите големи, мали букви и
                                        слецијален знак за поголема безбедност.</strong>
                                </p>
                                <form class="m-1 pt-4">
                                    <div class="form-group">
                                        <label for="old-password">Стара лозинка</label>
                                        <input id="old-password" name="old-password" type="password" required="required"
                                               class="form-control here rounded-0"
                                               placeholder="Внесете ја старата лозинка">
                                        <small class="text-danger font-weight-light" id="err-msg-old-password"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">Нова лозинка</label>
                                        <input id="new-password" name="new-password" type="password" required="required"
                                               class="form-control here rounded-0">
                                        <small class="text-danger font-weight-light" id="err-msg-new-password"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success mt-4 small rounded-0 d-none" role="alert"
                                                 id="d-alert-password-success">
                                                <i class="fas fa-check-circle"></i> <span
                                                        class="alert-message small"></span>
                                            </div>
                                            <div class="alert alert-danger mt-4 rounded-0 d-none" role="alert"
                                                 id="d-alert-password-fail">
                                                <span class="alert-message small"></span>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-info rounded-0" id="btn-change-password"
                                                        type="button">Промени лозинка
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- resume -->
                    <div class="tab-pane fade" id="nav-resume" role="tabpanel" aria-labelledby="nav-resume-tab">
                        <div class="row pt-5">
                            <div class="col-md-10 offset-md-1 col-sm-12">
                                <p class="text-left small border-left p-4 mb-4"><span class="text-danger">*</span>Во
                                    овој таб може да подготвите кратко резиме за вас, за вашите напредувања, усовршувања
                                    ...</p>
                                <!-- Create the editor container -->
                                <form class="m-1">
                                    <div id="editor">
                                        {!! $user->text !!}
                                    </div>
                                    <div id="charNum"
                                         class="small text-muted font-italic font-weight-light text-right"></div>
                                    <input type="hidden" name="userId" id="userId" value="{{Auth::user()->id}}">
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success mt-4 d-none small rounded-0" role="alert"
                                             id="d-alert-resume-success">
                                            <i class="fas fa-check-circle"></i> <span
                                                    class="alert-message small"></span>
                                        </div>
                                        <div class="alert alert-danger mt-4 d-none rounded-0" role="alert"
                                             id="d-alert-resume-fail">
                                            <span class="alert-message small"></span>
                                        </div>
                                        <div class="text-right mt-3">
                                            <button class="btn btn-info rounded-0" id="submit-resume">Зачувај ги
                                                промените
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection