<!DOCTYPE html>
<html lang="en">
@include('theme.partials.head')
<body>
@include('theme.partials.header')
<div class="container">
    @yield('content.top')
    <div class="row">
        <div class="col-sm-8">
        @yield('content')
        </div>
        <div class="col-sm-4">
        @yield('sidebar')
        </div>
    </div>
    @yield('content.bottom')
</div>
@include('theme.partials.footer')
</body>
</html>