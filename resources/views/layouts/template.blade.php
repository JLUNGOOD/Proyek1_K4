<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        @include('layouts.navbar');
        @include('layouts.sidebar');
        <div class="content-wrapper"></div>
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                       
                    </div>
            </section>
    
            <section class="content">
    
                <div class="card">
                    <div class="card-header">
    
                    <div class="card-body">
                      @yield('content')
                    </div>
                  </div>
    
                </section>
        </div>
    </div>
</body>
</html>
