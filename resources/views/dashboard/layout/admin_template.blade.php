<!DOCTYPE html>
<html lang="pt-br">

<head>

    @include('dashboard.layout.header_scripts')

    @yield('header-extras')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('dashboard.layout.header')

        @include('dashboard.layout.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

                @yield('content_header')

            </section>

            <section class="content">

                @yield('content')

            </section>
        </div>

        @include('dashboard.layout.footer')

    </div>

    @include('dashboard.layout.footer_scripts')

  	@yield('footer-extras')

</body>

</html>
