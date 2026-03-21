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
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- StyleSheet link CSS -->
    <link href="{{ asset('css/style.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custome.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/responsive.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/contact-form-success.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.carousel.min.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.default.min.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/magnific-popup.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/aos.css') }}?v=2.3.4" rel="stylesheet" type="text/css">
    <!-- Profile Page Specific (moved to global head for smooth transitions) -->
    <link rel="stylesheet" href="{{ asset('css/agent-profile-view.css') }}?v={{ time() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Core Libraries -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/htmx.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/carousel.js') }}?v={{ time() }}"></script>


    
    <style>
        .swal2-backdrop-show {
            backdrop-filter: blur(8px) !important;
            -webkit-backdrop-filter: blur(8px) !important;
        }

        /* AOS Fallback: If AOS doesn't init or is slow, don't keep things hidden */
        [data-aos] {
            opacity: 1 !important;
            transform: none !important;
            visibility: visible !important;
        }
        
        /* But allow AOS to take over if it's loaded */
        .aos-init [data-aos] {
            opacity: inherit;
            transform: inherit;
            visibility: inherit;
        }

        /* Fix banner text overlap with badges - Desktop only */
        @media screen and (min-width: 992px) {
            .banner-con .banner_content {
                padding-top: 100px !important;
            }
        }
        
        /* Mobile banner fixes */
        @media screen and (max-width: 991px) {
            .banner-con .banner_content {
                padding: 40px 20px !important; /* Reduce padding to fit content */
            }
            .banner-con .banner_content h1:first-child {
                margin-bottom: 5px !important; /* Tighten gap between headings */
                line-height: 1.2 !important;
            }
            .banner-con .banner_content h1.text-size-16 {
                margin-bottom: 10px !important;
            }
            .banner-con .banner_content p {
                margin-bottom: 15px !important;
                font-size: 16px !important;
                line-height: 1.4 !important;
            }
        }

        /* Fix banner slider - hide overflow so next slide's background doesn't bleed right */
        .banner-con .owl-carousel,
        .banner-con .owl-carousel .owl-stage-outer,
        .banner-con .owl-carousel .owl-item {
            overflow: hidden !important;
        }
        
        /* Stop bootstrap rows in banner from bleeding with negative margins */
        .banner-con .row[class*="-banner-outer"] {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        /* Ensure badges are above the slider but not blocking interaction */
        .banner-top-text-block {
            z-index: 10 !important;
            pointer-events: none;
        }

        /* Ensure header menu is always above banner badges */
        .header {
            z-index: 1050 !important;
        }
        .navbar-collapse {
            z-index: 1060 !important;
        }
        .banner-top-text-box {
            pointer-events: auto;
        }
    </style>
</head>

<body hx-boost="true" hx-select="#app-content" hx-target="#app-content">
    <div id="app-content">
        @stack('styles')
        @yield('content')
        @stack('scripts')
        
        @if(session('login_success') && auth()->check())
            @php
                $welcomeName = auth()->user()->fullname;
                if (auth()->user()->role === 'agent' && auth()->user()->agent?->profile?->display_name) {
                    $welcomeName = auth()->user()->agent->profile->display_name;
                }
            @endphp
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: '<h3 style="color: #273c8e; margin-top: 10px;">Welcome Back!</h3>',
                        html: '<h5 style="color: #64748b; font-size: 16px; margin-top: 10px;">Great to see you again, <br><b style="color: #1a1a1a; font-size: 20px;">{{ $welcomeName }}</b></h5>',
                        icon: 'success',
                        iconColor: '#06A441',
                        timer: 3500,
                        showConfirmButton: false,
                        padding: '2.5rem',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        backdrop: `rgba(0,0,0,0.6)`
                    });
                });
            </script>
        @endif

        @if(!auth()->check() || auth()->user()->role !== 'agent')
            @include('layouts.footer')
        @endif
    </div>

    <!-- PRE LOADER -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('js/preloader.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/form-handler.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/back-to-top-button.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/contact-validate.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/contact-form.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/counter.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/aos.js') }}?v=2.3.4"></script>

    <script>
        // Initialize AOS
        $(document).ready(function() {
            AOS.init({
                duration: 1000,
                once: true
            });
        });
    </script>


    <script>
        // Global Re-initialization for SPA transitions
        document.addEventListener('htmx:afterSwap', function(evt) {
            // Only scroll to top if we updated the main content area (page navigation)
            if (evt.detail.target.id === 'app-content') {
                window.scrollTo(0, 0);
            }

            // Refresh AOS
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
                // Sometimes refresh isn't enough for newly added content
                setTimeout(() => AOS.init(), 100);
            }

            // Force visibility of all sections (prevents ghosting/hidden elements)
            setTimeout(function() {
                $('section').css({
                    'opacity': '1',
                    'visibility': 'visible',
                    'display': 'block'
                });
                
                // Specifically targeting About page classes that were reported missing
                $('.service-con, .aboutpage-con, .why-exist-con, .what-we-do-con, .seekers-agents-con, .commitment-con').css({
                    'opacity': '1',
                    'display': 'block'
                });

                $('.loader-mask').fadeOut('fast');

                // Auto-hide alerts that are visible on load
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    if (alert.offsetHeight > 0 || alert.offsetWidth > 0 || (alert.style.display && alert.style.display !== 'none')) {
                        setTimeout(() => {
                            alert.style.transition = 'opacity 0.5s ease';
                            alert.style.opacity = '0';
                            setTimeout(() => {
                                alert.style.display = 'none';
                            }, 500);
                        }, 5000);
                    }
                });
            }, 50);
        });

        // Password visibility toggle - Global Delegated Listener
        $(document).on('click', '.password-toggle-icon, #togglePassword', function() {
            const wrapper = $(this).closest('.password-field-wrapper');
            const passwordField = wrapper.length ? wrapper.find('input') : $('#password');
            
            if (passwordField.length) {
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            }
        });

        // Inline Loading for "View Profile" buttons
        $(document).on('click', '.view-profile-btn', function(e) {
            const $btn = $(this);
            // Only apply if it's a boosted link or standard link that hasn't been clicked yet
            if (!$btn.hasClass('is-loading')) {
                $btn.addClass('is-loading');
                const originalHtml = $btn.html();
                $btn.data('original-html', originalHtml);
                $btn.css('width', $btn.outerWidth() + 'px'); // Lock width
                $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Loading...');
                $btn.addClass('disabled').css('pointer-events', 'none');
            }
        });

        // Reset button states if navigation fails or is aborted
        document.addEventListener('htmx:afterRequest', function(evt) {
            $('.view-profile-btn.is-loading').each(function() {
                const $btn = $(this);
                $btn.removeClass('is-loading disabled').css('pointer-events', 'auto');
                if ($btn.data('original-html')) {
                    $btn.html($btn.data('original-html'));
                }
            });
        });

        // Global Login Form Loading State
        document.addEventListener('htmx:beforeRequest', function(evt) {
            const form = evt.detail.elt.closest('#login-form');
            if (form) {
                const submitBtn = form.querySelector('#submit-btn');
                const btnText = form.querySelector('#btn-text');
                const btnIcon = form.querySelector('#btn-icon');
                const btnSpinner = form.querySelector('#btn-spinner');

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'not-allowed';
                }
                if (btnText) {
                    // Try to preserve original text for later
                    if (!btnText.dataset.originalText) {
                        btnText.dataset.originalText = btnText.innerText;
                    }
                    btnText.innerText = 'Logging in...';
                }
                if (btnIcon) btnIcon.style.display = 'none';
                if (btnSpinner) btnSpinner.style.display = 'inline-block';
            }
        });

        document.addEventListener('htmx:afterRequest', function(evt) {
            const form = evt.detail.elt.closest('#login-form');
            if (form && evt.detail.xhr.status !== 200) {
                const submitBtn = form.querySelector('#submit-btn');
                const btnText = form.querySelector('#btn-text');
                const btnIcon = form.querySelector('#btn-icon');
                const btnSpinner = form.querySelector('#btn-spinner');

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                }
                if (btnText && btnText.dataset.originalText) {
                    btnText.innerText = btnText.dataset.originalText;
                }
                if (btnIcon) btnIcon.style.display = 'inline-block';
                if (btnSpinner) btnSpinner.style.display = 'none';
            }
        });

        // Standard form submit fallback
        $(document).on('submit', '#login-form', function() {
            const submitBtn = this.querySelector('#submit-btn');
            const btnText = this.querySelector('#btn-text');
            const btnIcon = this.querySelector('#btn-icon');
            const btnSpinner = this.querySelector('#btn-spinner');

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
            }
            if (btnText) {
                if (!btnText.dataset.originalText) btnText.dataset.originalText = btnText.innerText;
                btnText.innerText = 'Logging in...';
            }
            if (btnIcon) btnIcon.style.display = 'none';
            if (btnSpinner) btnSpinner.style.display = 'inline-block';
        });

        // Ensure loader is hidden on load
        $(window).on('load', function() {
            $('.loader-mask').fadeOut('slow');
        });

        // Show/Hide Preloader on Navigation
        document.addEventListener('htmx:configRequest', function(evt) {
            const path = evt.detail.path || '';
            const elt = evt.detail.elt;
            
            // Only show global preloader for login-related requests (Agent & Client Login)
            const isLoginRequest = path.includes('login');
            
            if (!isLoginRequest) {
                return;
            }

            // Don't show global preloader for elements marked with 'no-preloader'
            // or if the request already has a defined hx-indicator
            if (elt.closest('.no-preloader') || elt.hasAttribute('hx-indicator')) {
                return;
            }
            $('.loader-mask').show().fadeIn(100);
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

        // HTMX CSRF Configuration
        document.body.addEventListener('htmx:configRequest', (event) => {
            event.detail.headers['X-CSRF-Token'] = '{{ csrf_token() }}';
        });

        // Handle Session Expired (419)
        document.body.addEventListener('htmx:responseError', (event) => {
            if (event.detail.xhr.status === 419) {
                Swal.fire({
                    title: 'Session Expired',
                    text: 'Your session has expired. Please refresh the page.',
                    icon: 'warning',
                    confirmButtonText: 'Refresh'
                }).then(() => {
                    window.location.reload();
                });
            }
        });

        // Fallback for any stalled loaders
        setTimeout(function() {
            $('.loader-mask').fadeOut();
        }, 3000);

        // Find Agent Interceptor for Guests
        $(function() {
            @guest
            // Define the popup function globally
            window.showQuickRegisterPopup = function() {
                Swal.fire({
                    title: '<h3 style="color: #0d9488; margin-top: 10px;">Find Best Agents Nearby</h3>',
                    html: `
                        <div class="text-left" style="padding: 0 10px;">
                            <div id="swal-error-container" class="alert alert-danger d-none" style="font-size: 13px; padding: 10px; border-radius: 8px; margin-bottom: 15px; border: none; background-color: #fef2f2; color: #991b1b;">
                                <i class="fas fa-exclamation-circle mr-2"></i> <span id="swal-error-message"></span>
                            </div>

                            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Please share a few details to help us connect you with the right experts.</p>
                            
                            <div class="form-group mb-3">
                                <label style="font-size: 13px; font-weight: 600; color: #475569;">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="swal-fullname" class="form-control" placeholder="Enter your full name" style="border-radius: 8px; padding: 12px;">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label style="font-size: 13px; font-weight: 600; color: #475569;">Email Address <span class="text-danger">*</span></label>
                                <input type="email" id="swal-email" class="form-control" placeholder="name@example.com" style="border-radius: 8px; padding: 12px;">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label style="font-size: 13px; font-weight: 600; color: #475569;">Mobile Number</label>
                                <input type="text" id="swal-mobile" class="form-control" placeholder="10-digit mobile number" maxlength="10" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    style="border-radius: 8px; padding: 12px;">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label style="font-size: 13px; font-weight: 600; color: #475569;">Pincode <span class="text-danger">*</span></label>
                                <input type="text" id="swal-pincode" class="form-control" placeholder="Where are you looking for an agent?" maxlength="6" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    style="border-radius: 8px; padding: 12px;">
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Show Agents',
                    confirmButtonColor: '#0d9488',
                    cancelButtonText: 'Cancel',
                    padding: '2rem',
                    width: '450px',
                    preConfirm: () => {
                        const fullname = $('#swal-fullname').val().trim();
                        const email = $('#swal-email').val().trim();
                        const mobile = $('#swal-mobile').val().trim();
                        const pincode = $('#swal-pincode').val().trim();

                        const showError = (msg) => {
                            $('#swal-error-message').text(msg);
                            $('#swal-error-container').removeClass('d-none').hide().fadeIn();
                            setTimeout(() => {
                                $('#swal-error-container').fadeOut(() => {
                                    $(this).addClass('d-none');
                                });
                            }, 3000);
                        };

                        $('#swal-error-container').addClass('d-none');

                        if (!fullname) { showError('Full Name is required'); return false; }
                        if (!email) { showError('Email Address is required'); return false; }
                        if (!/^\S+@\S+\.\S+$/.test(email)) { showError('Please enter a valid email address'); return false; }
                        if (!pincode) { showError('Pincode is required'); return false; }
                        if (pincode.length < 6) { showError('Please enter a valid 6-digit pincode'); return false; }

                        return { fullname, email, mobile, pincode };
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    backdrop: `rgba(0,0,0,0.6)`
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Connecting you...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                                $.ajax({
                                    url: "{{ route('client.quick-register') }}",
                                    type: "POST",
                                    timeout: 15000,
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        ...result.value
                                    },
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Welcome!',
                                                text: 'We sent your credentials to your email.',
                                                timer: 3000,
                                                showConfirmButton: false,
                                                padding: '2rem'
                                            }).then(() => {
                                                window.location.href = response.redirect;
                                            });
                                        } else {
                                            Swal.fire('Error', response.message, 'error');
                                        }
                                    },
                                    error: function(xhr) {
                                        const message = xhr.status === 0
                                            ? 'Request timed out. Please check your internet and try again.'
                                            : (xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred');
                                        Swal.fire('Error', message, 'error');
                                    }
                                });
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Redirect to home page when user clicks Cancel
                        window.location.href = "{{ url('/') }}";
                    }
                });
            };

            $(document).on('click', 'a[href*="find-agents"], .find-agent-btn', function(e) {
                // If we are already on the find-agents page, do not intercept
                if (window.location.pathname.includes('find-agents')) {
                    return;
                }

                // If user is logged in (check for auth-only elements in case of HTMX/no-refresh login)
                if ($('#logout-form').length || $('#userMenu').length) {
                    return;
                }

                // Skip if this specific link or button has 'no-interceptor' class
                if ($(this).hasClass('no-interceptor') || $(this).closest('.no-interceptor').length) {
                    return;
                }
                
                e.preventDefault();
                e.stopPropagation();

                showQuickRegisterPopup();
            });
            @endguest

        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        function toggleFavoriteAgent(btn, agentId) {
            const isAuth = @json(auth()->check());
            
            if (!isAuth) {
                Swal.fire({
                    title: 'Login Required',
                    text: 'Please login to add agents to your favorites.',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Go to Login',
                    confirmButtonColor: '#273c8e'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('client.login') }}";
                    }
                });
                return;
            }

            const $btn = $(btn);
            const $svg = $btn.find('svg');

            $.ajax({
                url: "{{ route('agent.toggle-favorite') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    agent_id: agentId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        if (response.is_favorited) {
                            $btn.addClass('is-favorited text-red-500');
                            $svg.attr('fill', 'currentColor');
                        } else {
                            $btn.removeClass('is-favorited text-red-500');
                            $svg.attr('fill', 'none');
                        }
                    }
                },
                error: function(xhr) {
                    const message = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong';
                    Swal.fire('Error', message, 'error');
                }
            });
        }
    </script>
</body>

</html>
