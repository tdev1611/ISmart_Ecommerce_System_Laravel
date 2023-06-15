<!doctype html>
<html lang="en">

<head>
    <title>ISMART</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('login-form/css/style.css') }}">
    <script src="{{ asset('login-form/js/jquery.min.js') }}"></script>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"><a href="{{ route('homes') }}">Ismart</a></h2>
                </div>
                <div class="col-md-6 text-center mb-5">
                  <p>Chào mừng bạn đến với ISMART</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url({{ asset('login-form/images/bg-1.jpg') }});  ">
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('login-form/js/popper.js') }}"></script>
    <script src="{{ asset('login-form/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-form/js/main.js') }}"></script>

</body>

</html>
