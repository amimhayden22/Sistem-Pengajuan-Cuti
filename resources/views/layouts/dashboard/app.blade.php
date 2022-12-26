<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

        <!--CSRF Token-->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title') &mdash; Sistem Informasi Pengajuan Cuti</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/logo/favicon.ico') }}">

        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

        <!-- CSS Libraries -->
        @yield('style-libraries')

        <!-- CSS Custom -->
        @yield('style')
        <style>
            html{
                scroll-behavior: smooth;
            }
            #myBtn {
                display: none;
                position: fixed;
                bottom: 30px;
                right: 50px;
                z-index: 99;
            }
        </style>
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper">
                <!-- Navbar -->
                @include('layouts.dashboard.navbar')
                <!-- / Navbar -->

                <!-- Sidebar -->
                @include('layouts.dashboard.sidebar')
                <!-- / Sidebar -->

                <!-- Main Content -->
                <div class="main-content">
                    @yield('main-content')
                </div>
                <!-- / Main Content -->

                {{-- Button To Top --}}
                <button onclick="topFunction()" id="myBtn" class="btn btn-danger" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                {{-- /Button To Top --}}

                <!-- Footer -->
                @include('layouts.dashboard.footer')
                <!-- / Footer -->
            </div>
        </div>



        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>

        <!-- JS Libraies -->
        @yield('script-libraies')

        <!-- Template JS File -->
        <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
        <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

        <!-- Page Specific JS File -->
        @yield('script-page-specific')

        <!-- Custom Script -->
        @yield('script')
        <script>
            //Get the button
            var mybutton = document.getElementById("myBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
    </body>
</html
