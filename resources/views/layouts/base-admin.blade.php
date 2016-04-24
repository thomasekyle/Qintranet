<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<!--<div class="container"> -->

    <header class="row">
        @include('includes.admin-header')
    </header>
    <div class="container">
        <div id="main" class="row">
            @yield('content')
        </div>
    </div>
    <footer class="footer">
        @include('includes.footer')
    </footer>
    
<!--</div>-->
</body>
</html>