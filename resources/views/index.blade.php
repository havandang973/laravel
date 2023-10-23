<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hội thảo kỹ năng nghề TP Hà Nội 2023</title>

    <base href="../../">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-6 mx-sm-auto px-4">
            <div class="pt-3 pb-2 mb-3 border-bottom text-center">
                <h1 class="h2">Hội thảo kỹ năng nghề TP Hà Nội 2023</h1>
            </div>

            <form method="POST" class="form-signin" action="events/index.html">
                @csrf

                <h1 class="h3 mb-3 font-weight-normal">Đăng nhập</h1>

                <label for="inputEmail" class="sr-only">Email</label>
                <input required type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" autofocus>

                <label for="inputPassword" class="sr-only">Mật khẩu</label>
                <input required type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật khẩu">

                @if($errors->has('message'))
                    <span style="display: flex; justify-content: center; padding: 10px 0; font-size: 14px;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif

                <button class="btn btn-lg btn-primary btn-block" id="login" type="submit">Đăng nhập</button>
            </form>

        </main>
    </div>
</div>
</body>
</html>
