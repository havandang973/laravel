<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event Backend</title>

    <base href="../../">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="events/index.html">Nền tảng sự kiện</a>
    <span class="navbar-organizer w-100">{{session('name')}}</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" id="logout" href="index.html">Đăng xuất</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="events/index.html">Quản lý sự kiện</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Quản lý sự kiện</h1>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Tạo sự kiện mới</h2>
                </div>
            </div>

            <form class="needs-validation" action="/events/create.html" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Tên</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="" value="{{old('name')}}" required>
{{--                        <div class="invalid-feedback">--}}
{{--                            Tên không được để trống.--}}
{{--                        </div>--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" class="form-control" id="inputSlug" name="slug" placeholder="" value="{{old('slug')}}">
{{--                        @if ($errors->any())--}}
{{--                            <div style="color: red; font-size: 12px;">--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                        <span>{{$error}}</span>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        @if($errors->has('slug-existing'))
                            <div style="color: red; font-size: 80%; margin-top: 0.25rem;">
                                {{ $errors->first('slug-existing') }}
                            </div>
                        @elseif($errors->has('slug-invalid'))
                            <div style="color: red; font-size: 80%; margin-top: 0.25rem;">
                                {{ $errors->first('slug-invalid') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputDate">Ngày</label>
                        <input type="text"
                               class="form-control"
                               id="inputDate"
                               name="date"
                               placeholder="yyyy-mm-dd"
                               value="{{old('date')}}" required>
                        @if($errors->has('date-format'))
                            <div style="color: red; font-size: 80%; margin-top: 0.25rem;">
                                {{ $errors->first('date-format') }}
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Lưu sự kiện</button>
                <a href="{{route('events')}}" class="btn btn-link">Bỏ qua</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
