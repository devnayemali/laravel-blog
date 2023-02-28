<!DOCTYPE html>
<html lang="en">

<head>

    @include('backend.auth.includes.header')

</head>

<body class="bg-gradient-primary">

    @yield('content')

    @include('backend.auth.includes.scripts')

</body>

</html>
