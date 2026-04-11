<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.backend.partials.head')
</head>

<body>
    <div id="overlay" class="overlay"></div>
    <!-- TOPBAR -->
    @include('layouts.backend.partials.header')

    <!-- SIDEBAR -->
    @include('layouts.backend.partials.sidbar')

    <!-- MAIN CONTENT -->
    <main id="content" class="content py-10">
        @yield('content')
    </main>

    @include('layouts.backend.partials.script')

</body>

</html>
