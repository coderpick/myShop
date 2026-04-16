<!DOCTYPE html>
<html lang="en" data-admin-theme="light">

<head>
    @include('layouts.backend.partials.head')
</head>

<body>

    {{-- SIDEBAR OVERLAY --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">

        {{-- SIDEBAR --}}
        @include('layouts.backend.partials.sidebar')



        {{-- MAIN CONTENT --}}
        <div class="admin-main" id="adminMain">

            {{-- HEADER --}}
            @include('layouts.backend.partials.header')

            {{-- Page CONTENT --}}

            @yield('content')

            {{-- FOOTER --}}
            @include('layouts.backend.partials.footer')

        </div>
    </div>

    {{-- script --}}
    @include('layouts.backend.partials.script')

    {!! ToastMagic::scripts() !!}
</body>

</html>
