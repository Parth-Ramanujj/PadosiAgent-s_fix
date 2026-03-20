<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- <title>Family Insurance | Insurerity</title> -->
    <title>Padosi-connect-hub</title>
    <!-- /SEO Ultimate -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta charset="utf-8">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/logo-icon.png') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/bootstrap.min.js') }}">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('css/aos.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Core Libraries -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/htmx.min.js') }}"></script>

    @stack('styles')
</head>

<body hx-boost="true" hx-select="#app-content" hx-target="#app-content">
    <div id="app-content">
        @yield('content')
        
        @include('layouts.footer')
        @stack('scripts')
    </div>

    <!-- PRE LOADER -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="{{ asset('js/animation.js') }}"></script>
    <script src="{{ asset('js/back-to-top-button.js') }}"></script>
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="{{ asset('js/contact-validate.js') }}"></script>
    <script src="{{ asset('js/contact-form.js') }}"></script>
    <script src="{{ asset('js/counter.js') }}"></script>


    <script>
        // Global Re-initialization for SPA transitions
        document.addEventListener('htmx:afterSwap', function(evt) {
            // Re-init AOS animations
            if (typeof AOS !== 'undefined') {
                setTimeout(function() {
                    AOS.refreshHard(); 
                    AOS.init();
                }, 100);
            }
            
            // Re-init Bootstrap components if needed
            // $('[data-toggle="tooltip"]').tooltip();
            
            // Scroll to top
            window.scrollTo(0, 0);

            // Ensure loader is hidden after swap
            $('.loader-mask').fadeOut();
        });

        // Show/Hide Preloader on Navigation
        document.addEventListener('htmx:configRequest', function(evt) {
            // Don't show global preloader for elements marked with 'no-preloader'
            // or if the request already has a defined hx-indicator
            if (evt.detail.elt.closest('.no-preloader') || evt.detail.elt.hasAttribute('hx-indicator')) {
                return;
            }
            // $('.loader-mask').show().fadeIn(100);
        });

        document.addEventListener('htmx:afterOnLoad', function() {
             $('.loader-mask').fadeOut();
        });

        document.addEventListener('htmx:historyRestore', function() {
            $('.loader-mask').hide();
        });

        window.addEventListener('popstate', function() {
            $('.loader-mask').hide();
        });

        // Fallback for any stalled loaders
        setTimeout(function() {
            $('.loader-mask').fadeOut();
        }, 3000);
    </script>
</body>

</html>
