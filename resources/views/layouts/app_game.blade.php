<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
        @include('includes.header')
    </head>

    <body>

        @yield('content')
        @include('includes.page-js')
    </body>
</html>
