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
                    <li class="nav-item"><a class="nav-link" href="events/index.html">Quản lý sự kiện</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{$name}}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="events/detail.html/{{$slug}}">Tổng quan</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Báo cáo</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="reports/index.html">Công suất phòng</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$name}}</h1>
                </div>
            </div>

            <form method="POST" class="needs-validation" novalidate action="/events/edit.html/{{$slug}}">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Tên</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input name="name" type="text" class="form-control is-invalid" id="inputName" placeholder="" value="{{$name}}">
                        <div class="invalid-feedback">
                            Tên không được để trống.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input name="slug" type="text" class="form-control" id="inputSlug" placeholder="" value="{{$slug}}">

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
                        <input name="date" type="text"
                               class="form-control"
                               id="inputDate"
                               placeholder="yyyy-mm-dd"
                               value="{{$date}}">
                        @if($errors->has('date-format'))
                            <div style="color: red; font-size: 80%; margin-top: 0.25rem;">
                                {{ $errors->first('date-format') }}
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Lưu</button>
                <a href="events/detail.html/{{$slug}}" class="btn btn-link">Bỏ qua</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
