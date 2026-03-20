<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PadosiAgent - Coming Soon</title>
    
    <meta property="og:title" content="Reagsing the PadosiAgent! 🚀">
    <meta property="og:description" content="Join #PadosiAgent #PadosiAgentTeam — India’s platform for Mutual Fund Advisors, Insurance Agents, CA, and Lawyers.">
    <meta property="og:image" content="https://padosiagents.com/share-banner.jpg">
    <meta property="og:url" content="https://padosiagents.com/contest-share">
    <meta property="og:type" content="website">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">

      <!-- Add CSRF Token Meta Tag HERE in HEAD -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="PadosiAgent - We are working on something awesome. Launching December 1st, 2025. Join us as an agent or customer!">
    <meta name="author" content="PadosiAgent">
    <meta name="keywords" content="PadosiAgent, coming soon, agents, customers, launch 2025">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="PadosiAgent - Coming Soon">
    <meta property="og:description" content="We are working on something awesome. Launching December 1st, 2025!">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@PadosiAgent">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/padosiagent_css.css') }}">
</head>

<body>
    <div class="full-width container">
        <!-- Background Images -->
        <div class="background-bokeh"></div>
        <!-- <div class="spotlight-gradient"></div> -->

        <!-- Curtains -->
        <img src="{{ asset('images/curtain-left.png') }}" class="curtain curtain-left" alt="curtain curtain-left">
        <img src="{{ asset('images/curtain-right.png') }}" class="curtain curtain-right" alt="curtain curtain-right">

        <!-- Spotlight Lamp -->
        <img src="{{ asset('images/spotlight-lamp.png') }}" class="spotlight-lamp" alt="Spotlight">

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-wrapper">
                <!-- Title -->
                <div class="title-section">
                    <h1 class="main-title">
                        <span class="title-hindi active" id="currentLanguage">पड़ोसी</span><span class="title-agent">Agent</span>
                    </h1>
                    <p class="subtitle">Beacuse behind every Safe & Happy Home, There's <span>Padosi</span></p>
                    {{-- <p class="subtitle">We are working on Something <span>awesome</span></p> --}}
                </div>

                <!-- Launch Banner -->
                <div class="launch-banner-outer">
                    <div class="launch-banner">
                        <p>We will be Live on 1st December 2025</p>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="countdown-container">
                    <div class="countdown-item">
                        <div class="countdown-circle">
                            <img src="{{ asset('images/circle-timer.png') }}" class="circle-bg" alt="Timer circle">
                            <span class="countdown-number" id="days">00</span>
                            <span class="countdown-label">DAYS</span>
                        </div>

                    </div>

                    <div class="countdown-item">
                        <div class="countdown-circle">
                            <img src="{{ asset('images/circle-timer.png') }}" class="circle-bg" alt="Timer circle">                            <span class="countdown-number" id="hours">00</span>
                            <span class="countdown-label">HOURS</span>
                        </div>

                    </div>

                    <div class="countdown-item">
                        <div class="countdown-circle">
                            <img src="{{ asset('images/circle-timer.png') }}" class="circle-bg" alt="Timer circle">
                            <span class="countdown-number" id="minutes">00</span>
                            <span class="countdown-label">MINUTES</span>
                        </div>

                    </div>

                    <div class="countdown-item">
                        <div class="countdown-circle">
                            <img src="{{ asset('images/circle-timer.png') }}" class="circle-bg" alt="Timer circle">
                            <span class="countdown-number" id="seconds">00</span>
                            <span class="countdown-label">SECONDS</span>
                        </div>

                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="cta-buttons">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgentRegistration">
                        <svg width="33" height="38" viewBox="0 0 33 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.9474 38C13.6687 37.8471 13.3562 37.8941 13.0609 37.8706C9.06144 37.5508 5.2269 36.6084 1.60159 34.8652C1.4795 34.8067 1.36627 34.7248 1.24 34.6805C0.586738 34.4493 0.262193 34.0371 0.232451 33.3004C0.181839 32.0549 -0.0597443 30.8172 0.0138263 29.5655C0.0780049 28.4734 0.266367 27.4074 0.878411 26.464C1.33862 25.7549 1.96006 25.241 2.77664 25.0109C5.18777 24.3305 7.47785 23.3793 9.61244 22.0608C9.84724 21.9157 10.0987 21.6011 10.3252 21.6966C10.4895 21.7654 10.5156 22.1714 10.5976 22.4286C11.6161 25.6224 12.633 28.8162 13.651 32.01C13.6839 32.1138 13.7225 32.2161 13.758 32.3184C13.9077 32.3027 13.8863 32.1702 13.9145 32.0914C14.2985 31.0244 14.6669 29.9521 15.0567 28.8872C15.1308 28.6842 15.0901 28.5454 14.9784 28.3816C14.5385 27.7398 14.1248 27.0803 13.9369 26.3122C13.639 25.0938 14.1289 24.3441 15.3624 24.1291C15.9171 24.032 16.4681 24.0529 17.0123 24.2131C17.9765 24.498 18.382 25.1794 18.1581 26.1698C17.9755 26.979 17.5622 27.6808 17.0926 28.3497C16.9491 28.5548 16.9418 28.727 17.0253 28.9545C17.3937 29.9615 17.7433 30.9748 18.1007 31.986C18.1404 32.0982 18.1852 32.2078 18.2614 32.406C18.4493 31.8556 18.6178 31.3907 18.7665 30.9195C19.712 27.9349 20.6569 24.9504 21.5904 21.9621C21.6827 21.6673 21.7464 21.6084 22.036 21.7962C24.0563 23.1022 26.2008 24.174 28.5363 24.763C30.9176 25.3641 31.7149 26.894 31.9826 28.979C32.171 30.4442 31.8913 31.8874 31.8115 33.3405C31.7739 34.0209 31.4707 34.369 30.8822 34.6612C28.3578 35.9145 25.7134 36.7931 22.9512 37.3321C21.3848 37.6379 19.8048 37.8356 18.2118 37.9275C18.1456 37.9317 18.0584 37.8962 18.0287 38C16.6684 38 15.3082 38 13.9474 38Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.9905 0C17.2169 0.130966 17.4799 0.0960069 17.7215 0.15862C19.2211 0.549953 20.5177 1.25592 21.4496 2.5374C21.5117 2.62297 21.5492 2.72316 21.6797 2.75916C22.9982 3.12284 23.5497 4.14343 23.8038 5.35813C24.1597 7.05756 24.0037 8.75125 23.5795 10.4215C23.5143 10.6776 23.5174 10.7455 23.8023 10.7737C24.1983 10.8133 24.4388 11.1859 24.4754 11.7134C24.5062 12.1611 24.4383 12.5999 24.3397 13.0345C24.1649 13.8057 23.9411 14.5612 23.5962 15.275C23.4349 15.609 23.2513 15.9361 22.8803 16.0911C22.7065 16.1636 22.741 16.3342 22.7071 16.4668C22.1039 18.8158 20.8214 20.6723 18.668 21.8322C16.3685 23.0704 13.8452 22.6691 11.8442 20.797C10.57 19.6047 9.70177 18.1636 9.33757 16.4402C9.29948 16.2586 9.23791 16.1276 9.04746 16.0222C8.65039 15.802 8.46724 15.3883 8.31228 14.9854C7.92199 13.9716 7.54683 12.9505 7.56405 11.8391C7.575 11.1076 7.81607 10.831 8.53455 10.7251C8.25332 9.80002 8.08322 8.85612 8.07487 7.88979C8.0613 6.28742 8.57995 4.8614 9.5515 3.5987C10.6509 2.16955 12.0284 1.09312 13.6996 0.40803C14.1337 0.230104 14.5945 0.132531 15.0625 0.0772229C15.1382 0.0683527 15.2425 0.120008 15.2822 0.000521491C15.852 -2.86646e-07 16.4212 0 16.9905 0Z"
                                fill="white" />
                        </svg>
                        Become a Agent
                    </button>

                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#BecomeCustomer">
                        <svg width="38" height="33" viewBox="0 0 38 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 19.5321C0.139045 19.4673 0.107157 19.3225 0.132771 19.2148C0.660723 17.0309 2.5556 15.4548 4.79862 15.3864C5.87804 15.3534 6.96531 15.2834 8.03271 15.5416C8.65058 15.6916 9.20467 15.9708 9.71485 16.3482C9.85494 16.4522 9.92132 16.5144 9.76241 16.6764C7.68824 18.7924 6.8592 21.405 6.72277 24.2988C6.6292 26.281 6.73113 28.2616 6.73374 30.2422C6.73374 30.5334 6.6339 30.6018 6.38561 30.6013C4.97007 30.5956 3.55401 30.6196 2.13952 30.5825C1.14425 30.5569 0.461565 30.0284 0.104543 29.0917C0.0804981 29.029 0.098272 28.9364 0.000522438 28.9161C-2.87166e-07 25.7875 0 22.6601 0 19.5321Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M37.8276 28.8412C37.8031 28.8647 37.767 28.8835 37.7555 28.9123C37.2809 30.1198 36.6112 30.5882 35.3233 30.5955C34.0556 30.6023 32.7886 30.5934 31.5215 30.6059C31.1984 30.6091 31.0928 30.5186 31.0949 30.1674C31.1059 28.261 31.1833 26.3536 31.1085 24.4467C31.0134 21.9909 30.4818 19.6773 28.9371 17.6899C28.681 17.3601 28.4186 17.0302 28.1211 16.7396C27.9131 16.5363 27.9722 16.4463 28.1671 16.3057C28.8922 15.7809 29.6998 15.4584 30.5879 15.4103C31.7154 15.3502 32.8628 15.2263 33.9684 15.5143C36.0666 16.0606 37.3405 17.427 37.7581 19.5686C37.768 19.6177 37.7701 19.6648 37.8282 19.681C37.8276 22.7337 37.8276 25.7874 37.8276 28.8412Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.4794 32.9599C16.2516 32.9599 14.0243 32.9567 11.7959 32.962C11.0447 32.9635 10.3579 32.7989 9.79122 32.2746C9.27059 31.7926 8.95225 31.1967 8.95121 30.489C8.94755 28.373 8.80902 26.258 8.93918 24.1399C9.15925 20.5708 10.7536 17.8981 13.9845 16.2703C15.2014 15.6577 16.514 15.3921 17.8616 15.3372C19.3116 15.2792 20.7904 15.2097 22.1908 15.6169C25.7814 16.6618 27.9324 19.093 28.74 22.7296C28.7986 22.9931 28.8388 23.2644 28.8477 23.5331C28.923 25.9078 28.9899 28.2888 28.8367 30.6562C28.7416 32.1272 27.9361 32.675 26.7066 32.8349C24.9659 33.0618 23.2169 32.9787 21.4705 32.9954C20.4736 33.0048 19.4768 32.997 18.4794 32.997C18.4794 32.985 18.4794 32.9724 18.4794 32.9599Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.7141 12.8543C15.0399 12.6791 12.2904 9.68968 12.4995 6.0442C12.7054 2.45882 15.801 -0.205505 19.3717 0.0124716C22.7924 0.221562 25.4928 3.24134 25.335 6.77601C25.1818 10.2155 22.1301 13.0168 18.7141 12.8543Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.89377 4.73735C8.13574 4.72638 9.96057 6.52769 9.97364 8.76547C9.98619 11.0153 8.15508 12.8589 5.9105 12.8579C3.67951 12.8574 1.85206 11.031 1.8484 8.79997C1.84369 6.56167 3.64971 4.74833 5.89377 4.73735Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M31.9274 4.73738C34.173 4.74418 35.9811 6.55386 35.9801 8.79321C35.979 11.0273 34.1631 12.8475 31.9258 12.8579C29.6875 12.8689 27.8439 11.019 27.8538 8.77282C27.8637 6.5366 29.687 4.73059 31.9274 4.73738Z"
                                fill="white" />
                        </svg>
                        Participate Now
                    </button>
                </div>

                <!-- Social Media Icons -->
                <!-- <div class="social-icons">
                    <img src="./social-icons.png" alt="Social media links">
                </div> -->
            </div>
        </main>
        <!-- Social Media Icons -->
        <div class="social-icons">
            <div class="social-icons-box">
                <a href="#" class="social-link">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#000">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1200 1227"
                        fill="#000">
                        <path
                            d="M714.163 519.284L1160.89 0H1053.21L671.81 442.451L381.912 0H0L468.104 681.726L0 1226.99H107.676L511.215 757.281L818.088 1226.99H1200L714.137 519.284H714.163ZM565.629 691.033L516.268 620.749L145.808 79.694H337.431L626.66 495.145L676.02 565.43L1076.2 1147.3H884.574L565.629 691.055V691.033Z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Wooden Floor -->
        <div class="wooden-floor">
            <img src="{{ asset('images/wooden-floor.png') }}"  alt="Wooden stage floor">            
        </div>

        <!-- Contest Banner -->
        <div class="contest-banner">
            <p>#ThankYouPadosi Contest – Top 3 win ₹1 Lakh vouchers | Ends 31 Mar 2026</p>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/padosiagent_js.js') }}"></script>
    <script>
        // Generate celebration elements
        document.addEventListener('DOMContentLoaded', function () {
            // Create confetti
            for (let i = 0; i < 40; i++) {
                createConfetti();
            }

            // Create sparkles
            for (let i = 0; i < 15; i++) {
                createSparkle();
            }

            function createConfetti() {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animationDelay = Math.random() * 5 + 's';
                 // Remove confetti after animation completes
                confetti.addEventListener('animationend', function() {
                    confetti.remove();
                });
                document.querySelector('.container').appendChild(confetti);
            }

            function createSparkle() {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.style.left = Math.random() * 100 + 'vw';
                sparkle.style.top = Math.random() * 100 + 'vh';
                sparkle.style.animationDelay = Math.random() * 2 + 's';
                document.querySelector('.container').appendChild(sparkle);
            }
        });
    </script>

    <!-- Agent Registration Modal -->
    <div class="modal fade" id="AgentRegistration" tabindex="-1" aria-labelledby="AgentRegistrationLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content agent-registration-popup">

                <div class="popup-outer-header">
                    <h2 class="modal-title" id="AgentRegistrationLabel">Agent Registration</h3>
                        <p>Join our network of professional agents</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="popup-outer-content">

                    <div class="container">
                        <div class="form-container">
                            <div id="successAlert" class="alert alert-success"></div>
                            <div id="errorAlert" class="alert alert-error"></div>

                            <!-- Step 1: Basic Information -->
                            <div class="modal-step active" data-step="1">
                                <h2>Basic Information</h2>
                                <p class="text-muted">Tell us about yourself</p>

                                <div class="step-indicator">
                                    <div class="step active">1</div>
                                    <div class="step-line"></div>
                                    <div class="step">2</div>
                                    <div class="step-line"></div>
                                    <div class="step">3</div>
                                </div>

                                <form id="agentForm1">
                                    <div class="form-group">
                                        <label>Full Name *</label>
                                        <input type="text" name="fullname" placeholder="Enter your full name" required>
                                    </div>

                                    <div class="flex-box">
                                        <div class="form-group">
                                            <label>Email Address *</label>
                                            <input type="email" name="email" placeholder="your.email@example.com" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Mobile Number *</label>
                                            <input type="tel" name="mobile" placeholder="10-digit mobile number"           oninput="this.value = this.value.replace(/[^0-9]/g,'')" 
 maxlength="10" pattern="[0-9]{10}" required>
                                        </div>
                                    </div>

                                    <div class="or-text">
                                        <span>OR</span>
                                    </div>

                                    <div class="google-btn">
                                        <button type="button" class="btn gmail" id="googleAuthBtn">

                                            <svg width="20" height="20" viewBox="0 0 18 19" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9 7.844v3.463h4.844a4.107 4.107 0 0 1-1.795 2.7v2.246h2.907c1.704-1.558 2.685-3.85 2.685-6.575 0-.633-.056-1.246-.162-1.83H9v-.004Z"
                                                    fill="#3E82F1"></path>
                                                <path
                                                    d="M9 14.861c-2.346 0-4.328-1.573-5.036-3.69H.956v2.323A9.008 9.008 0 0 0 9 18.42c2.432 0 4.47-.8 5.956-2.167l-2.907-2.247c-.804.538-1.835.855-3.049.855Z"
                                                    fill="#32A753"></path>
                                                <path
                                                    d="M3.964 5.456H.956a8.928 8.928 0 0 0 0 8.033l3.008-2.318a5.3 5.3 0 0 1-.283-1.699 5.3 5.3 0 0 1 .283-1.699V5.456Z"
                                                    fill="#F9BB00"></path>
                                                <path
                                                    d="m.956 5.456 3.008 2.317c.708-2.116 2.69-3.69 5.036-3.69 1.32 0 2.508.453 3.438 1.338l2.584-2.569C13.465 1.41 11.427.525 9 .525A9.003 9.003 0 0 0 .956 5.456Z"
                                                    fill="#E74133"></path>
                                            </svg>
                                            Continue with Google
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label>I am a * (Select all that apply)</label>
                                        <div class="checkbox-group">
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="user_types[]" value="insurance_agent">
                                                <span>Insurance Agent</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="user_types[]" value="mutual_fund_agent">
                                                <span>Mutual Fund Agent</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="user_types[]" value="ca">
                                                <span>Chartered Accountant</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="user_types[]" value="lawyer">
                                                <span>Lawyer</span>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="submit-btn">Continue</button>
                                </form>
                            </div>

                            <!-- Step 2: Professional Details (Only for Insurance Agents) -->
                            <div class="modal-step " data-step="2">
                                <h2>Professional Details</h2>
                                <p class="text-muted">Tell us about your professional experience</p>

                                <div class="step-indicator">
                                    <div class="step completed">✓</div>
                                    <div class="step-line completed"></div>
                                    <div class="step active">2</div>
                                    <div class="step-line"></div>
                                    <div class="step">3</div>
                                </div>

                                <form id="agentForm2">
                                    @csrf
                                    <div class="flex-box">
                                        <div class="form-group">
                                            <label>PAN / IRDAI License Number *</label>
                                            <input type="text" name="pan_number" placeholder="PAN: ABCDE1234F"
                                                >
                                        </div>

                                        <div class="or-text step-two">
                                            <span>OR</span>
                                        </div>

                                        <div class="form-group">
                                            <label>IRDAI License</label>
                                            <input type="text" name="license_number" placeholder="IRDAI license"
                                                >
                                        </div>
                                        <small>PAN format: 5 letters + 4 digits + 1 letter (e.g., ABCDE1234F)</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Insurance Companies * (India only)</label>
                                        <div class="company-input-container">
                                            <input type="text" id="companyInput"
                                                placeholder="Type company name and press Enter">
                                            <button type="button" class="btn-add" onclick="addCompany()">Add</button>
                                        </div>
                                        <div id="selectedCompanies" class="selected-items"></div>
                                        <input type="hidden" name="insurance_companies" id="insuranceCompaniesInput">
                                    </div>

                                    <div class="flex-box">
                                        <div class="form-group">
                                            <label>Years of Experience</label>
                                            <input type="number" placeholder="" name="experience_range">
                                            <!-- <select name="experience_range" required>
                                                <option value="">Select experience</option>
                                                <option value="0-2">0-2 years</option>
                                                <option value="2-5">2-5 years</option>
                                                <option value="5-10">5-10 years</option>
                                                <option value="10+">10+ years</option>
                                            </select> -->
                                            <small>Between 0-50 years</small>
                                        </div>

                                        <div class="form-group">
                                            <label>Approximate Client Base</label>
                                            <input type="number" name="client_base" placeholder="">
                                            <!-- <select name="client_base" required>
                                                <option value="">Select client base</option>
                                                <option value="0-50">0-50 clients</option>
                                                <option value="50-200">50-200 clients</option>
                                                <option value="200-500">200-500 clients</option>
                                                <option value="500+">500+ clients</option>
                                            </select> -->
                                            <small>Maximum 10,000 clients</small>
                                        </div>
                                    </div>

                                    <!-- Portfolio Distribution Section - Moved above Desired Services -->
                                    <h3 style="margin: 0 0 1.5rem 0;">Portfolio % (Total should be 100%)</h3>
                                    <div class="form-group">
                                        <label style="color: #14b8a6;">Insurance Company</label>
                                        <div class="portfolio-section">
                                            <div class="portfolio-inputs">
                                                <div class="form-group">
                                                    <label>Life</label>
                                                    <input type="number" name="life_insurance"
                                                        placeholder="Life Insurance %" min="0" max="100" value="25">
                                                </div>
                                                <div class="form-group">
                                                    <label>Health</label>
                                                    <input type="number" name="health_insurance"
                                                        placeholder="Health Insurance %" min="0" max="100" value="15">
                                                </div>
                                                <div class="form-group">
                                                    <label>Motor</label>
                                                    <input type="number" name="mutual_funds" placeholder="Motor %"
                                                        min="0" max="100" value="10">
                                                </div>
                                                <div class="form-group">
                                                    <label>General</label>
                                                    <input type="number" name="general_insurance"
                                                        placeholder="General Insurance %" min="0" max="100" value="40">
                                                </div>

                                                <div class="form-group">
                                                    <label>Others</label>
                                                    <input type="number" name="others" placeholder="Others %" min="0"
                                                        max="100" value="10">
                                                </div>
                                            </div>
                                            <h4 style="margin: 2rem 0; text-align: center; font-size: 1.8rem;">Portfolio
                                                Distribution</h4>
                                            <div class="chart-container">
                                                <canvas id="portfolioChart"></canvas>
                                            </div>
                                            <div class="total-display total-ok" id="totalDisplay">
                                                Total: 100%
                                            </div>
                                            <div class="legend" id="chartLegend"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Looking for Customers *</label>
                                        <div class="checkbox-group">
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="desired_services[]" value="New_Port_Renew">
                                                <span>New/Port/Renew</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="desired_services[]"
                                                    value="Claim_Assistance">
                                                <span>Claim Assistance</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="desired_services[]"
                                                    value="Insurance_Portfolio_Management">
                                                <span>Insurance Portfolio Management</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="desired_services[]" value="All_of_Above">
                                                <span>All of Above</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Do you use any Software for Managing Insurance Business?</label>
                                        <div class="checkbox-group">
                                            <label class="checkbox-label">
                                                <input type="radio" name="software_services[]" value="Yes">
                                                <span>Yes</span>
                                            </label>
                                            <label class="checkbox-label">
                                                <input type="radio" name="software_services[]" value="No">
                                                <span>No</span>
                                            </label>
                                            <input type="text" id="software_name" name="software_name"
                                                placeholder="Please share the name">

                                        </div>
                                    </div>

                                    <div class="modal-actions">
                                        <button type="button" class="btn-secondary"
                                            onclick="previousStep()">Back</button>
                                        <button type="submit" class="btn-primary">Continue</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Step 3: Payment -->
                            <div class="modal-step " data-step="3">
                                <h2>🎉 Early Bird Special!</h2>
                                <p class="text-muted">Join now and save big on your registration</p>

                                <div class="step-indicator">
                                    <div class="step completed">✓</div>
                                    <div class="step-line completed"></div>
                                    <div class="step completed">✓</div>
                                    <div class="step-line completed"></div>
                                    <div class="step active">3</div>
                                </div>

                               
                                <div class="early-bird-outer">
                                    <div class="early-bird-box-1">
                                        <div class="early-bird-box-limited-time">⚡ LIMITED TIME: Pre-Launch Offer ⚡
                                        </div>
                                        <div class="early-bird-special-text">Early Bird Special</div>
                                        <p class="be-among-the-first">🚀 Be among the <span class="text-accent">First
                                                500</span> Agents to join PadosiAgent and lock in this
                                            <span class="text-destructive">exclusive lifetime discount!</span>
                                        </p>
                                        <div class="spots-left">
                                            <span class="rounded-full"></span>
                                            <span>Only <span class="text-destructive font-bold">127 spots left</span> at
                                                this price</span>
                                            <span class="rounded-full"></span>
                                        </div>
                                    </div>


                                    <div class="early-bird-box-2">
                                        <div class="one-time-investment">
                                            <p class="text-accent">💎 One-Time Investment • Lifetime Benefits 💎</p>
                                        </div>

                                        <div class="registration-fee">
                                            <span class="text-foreground font-semibold">Registration Fee</span>
                                            <div class="text-right">
                                                <div class="bg-destructive">
                                                    <span class="text-muted-foreground">₹2,999</span>
                                                    <span class="text-destructive">33% OFF</span>
                                                </div>
                                                <div class="bg-destructive-right">₹1,999</div>
                                            </div>
                                        </div>

                                        <div class="gst-text-muted-foreground">
                                            <span>GST (18%)</span>
                                            <span class="font-bold">₹359</span>
                                        </div>

                                        <div class="from-transparent via-primary to-transparent"></div>
                                        <div class="total-amount">
                                            <span class="text-foreground">Total Amount</span>
                                            <span class="text-accent text-4xl">₹2,358</span>
                                        </div>

                                        <div class="secure-payment-razorpay">
                                            <p class="text-sm font-semibold text-foreground">✅ 100% Secure Payment via
                                                Razorpay</p>
                                            <p class="text-xs text-muted-foreground">Your investment is protected. Join
                                                thousands of trusted agents.</p>
                                        </div>
                                    </div>

                                    <div class="early-bird-box-3">
                                        <h3 class="text-center text-2xl font-extrabold text-gradient-primary">🎁
                                            Everything You Get 🎁</h3>
                                        <p class="text-center text-sm text-muted-foreground">Premium tools worth
                                            ₹50,000/year — yours for life!</p>

                                        <div class="grid grid-cols-3 gap-4">
                                            <div
                                                class="bg-gradient-to-br from-primary/10 to-primary/5 rounded-lg p-4 border border-primary/20 flex flex-col items-center justify-center space-y-2 hover:scale-105 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user w-8 h-8 text-primary">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="text-xs text-center font-medium text-foreground">Permanent
                                                    Webpage</span>
                                            </div>

                                            <div
                                                class="bg-gradient-to-br from-primary/10 to-primary/5 rounded-lg p-4 border border-primary/20 flex flex-col items-center justify-center space-y-2 hover:scale-105 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-eye w-8 h-8 text-primary">
                                                    <path
                                                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0">
                                                    </path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <span class="text-xs text-center font-medium text-foreground">Nearby
                                                    Lead</span>
                                            </div>

                                            <div
                                                class="bg-gradient-to-br from-primary/10 to-primary/5 rounded-lg p-4 border border-primary/20 flex flex-col items-center justify-center space-y-2 hover:scale-105 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-palette w-8 h-8 text-primary">
                                                    <circle cx="13.5" cy="6.5" r=".5" fill="currentColor"></circle>
                                                    <circle cx="17.5" cy="10.5" r=".5" fill="currentColor"></circle>
                                                    <circle cx="8.5" cy="7.5" r=".5" fill="currentColor"></circle>
                                                    <circle cx="6.5" cy="12.5" r=".5" fill="currentColor"></circle>
                                                    <path
                                                        d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z">
                                                    </path>
                                                </svg>
                                                <span class="text-xs text-center font-medium text-foreground">Brand
                                                    Builder Tools</span>
                                            </div>

                                            <div
                                                class="bg-gradient-to-br from-primary/10 to-primary/5 rounded-lg p-4 border border-primary/20 flex flex-col items-center justify-center space-y-2 hover:scale-105 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-link2 w-8 h-8 text-primary">
                                                    <path d="M9 17H7A5 5 0 0 1 7 7h2"></path>
                                                    <path d="M15 7h2a5 5 0 1 1 0 10h-2"></path>
                                                    <line x1="8" x2="16" y1="12" y2="12"></line>
                                                </svg>
                                                <span class="text-xs text-center font-medium text-foreground">SEO
                                                    Optimized</span>
                                            </div>
                                            <div
                                                class="bg-gradient-to-br from-primary/10 to-primary/5 rounded-lg p-4 border border-primary/20 flex flex-col items-center justify-center space-y-2 hover:scale-105 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-share2 w-8 h-8 text-primary">
                                                    <circle cx="18" cy="5" r="3"></circle>
                                                    <circle cx="6" cy="12" r="3"></circle>
                                                    <circle cx="18" cy="19" r="3"></circle>
                                                    <line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line>
                                                    <line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line>
                                                </svg>
                                                <span class="text-xs text-center font-medium text-foreground">Referral
                                                    System</span>
                                            </div>

                                            <div
                                                class="bg-gradient-to-br from-primary/10 to-primary/5 rounded-lg p-4 border border-primary/20 flex flex-col items-center justify-center space-y-2 hover:scale-105 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-external-link w-8 h-8 text-primary">
                                                    <path d="M15 3h6v6"></path>
                                                    <path d="M10 14 21 3"></path>
                                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                                    </path>
                                                </svg>
                                                <span class="text-xs text-center font-medium text-foreground">Marketing
                                                    Tools</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="early-bird-box-4">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="I_agree_to_the" value="I_agree_to_the" id="terms">
                                            <span for="terms">
                                                I agree to the
                                            <a href="/terms" target="_blank"
                                                class="text-primary hover:underline font-bold">Terms and Conditions</a>
                                            and <a href="/privacy" target="_blank"
                                                class="text-primary hover:underline font-bold">Privacy Policy</a>. I
                                            understand that this is a <span class="font-bold text-accent">one-time,
                                                non-refundable</span> registration fee that grants <span
                                                class="font-bold text-accent">lifetime access</span> to the PadosiAgent
                                            platform and all its premium features.
                                            </span>
                                        </label>
                                        <!-- <button type="button" role="checkbox" aria-checked="false" aria-required="true"
                                            data-state="unchecked" value="on"
                                            class="peer h-4 w-4 shrink-0 rounded-sm border ring-offset-background data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-1 border-primary"
                                            id="terms"></button>
                                        <label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm cursor-pointer leading-relaxed text-foreground"
                                            for="terms">I agree to the
                                            <a href="/terms" target="_blank"
                                                class="text-primary hover:underline font-bold">Terms and Conditions</a>
                                            and <a href="/privacy" target="_blank"
                                                class="text-primary hover:underline font-bold">Privacy Policy</a>. I
                                            understand that this is a <span class="font-bold text-accent">one-time,
                                                non-refundable</span> registration fee that grants <span
                                                class="font-bold text-accent">lifetime access</span> to the PadosiAgent
                                            platform and all its premium features.</label> -->
                                    </div>

                                    <div class="early-bird-box-5">
                                        <button class="secure-payment"  onclick="handlePayment()">
                                            🔒 Secure Payment via Razorpay → ₹2,358</button>
                                        
                                        <p class="text-muted-foreground">💳 We accept all major
                                            credit/debit cards, UPI, Net Banking &amp; Wallets</p>

                                        <div class="price-increases">
                                            <p class="text-sm font-bold text-foreground">⏰ <span
                                                    class="text-destructive">Price increases to ₹4,999</span> after
                                                first 500 registrations</p>
                                        </div>
                                        <button class="back-previous" onclick="previousStep()">
                                            ← Back to Previous Step
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <!-- <div class="popup-outer-footer">
                    
                </div> -->


            </div>
        </div>
    </div>

    <!--  Become Customer Modal -->
    <div class="modal fade" id="BecomeCustomer" tabindex="-1" aria-labelledby="BecomeCustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content agent-registration-popup">

                <div class="popup-outer-header">
                    <h2 class="modal-title" id="BecomeCustomerLabel">Participate and Get a chance to win 1 Lakh</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="popup-outer-content">
                    <div id="successAlert" class="alert alert-success"></div>
                    <div id="errorAlert_p" class="alert alert-error"></div>
    <form id="participantForm" data-no-google-auth="true">
        @csrf
        <div class="form-group full-width">
            <label>Full Name *</label>
            <input type="text" name="full_name" required>
            <span class="error-message" id="full_name_error"></span>
        </div>
        
        <div class="flex-box">
            <div class="form-group">
                <label>Email Address *</label>
                <input type="email" id="email_address" name="email" required>
                <span class="error-message" id="email_error"></span>
            </div>
            
            <div class="form-group">
                <label>Phone Number *</label>
                <input type="tel" name="phone_number" maxlength="10"oninput="this.value = this.value.replace(/[^0-9]/g,'')" pattern="[0-9]{10}" required>
                <span class="error-message" id="phone_number_error" required></span>
            </div>
        </div>
        

        <div class="form-group">
            <button type="submit" class="submit-btn">Submit</button>
            {{-- <button type="button" class="share-with">👨‍👩‍👧 Share with Family</button> --}}
        </div>
    </form>
</div>

<!-- Success Message -->
<div id="successMessage" style="display: none;" class="alert alert-success">
    Registration successful!
</div>

            </div>
        </div>
    </div>

    <!-- Success Popup (initially hidden) -->
<div id="successPopup" class="success-popup" style="display: none;">
    <div class="popup-content">
        <!-- Confetti Animation -->
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        
        <!-- Success Icon -->
        <div class="success-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" 
                      fill="#10B981"/>
            </svg>
        </div>

        <!-- Success Message -->
        <div class="success-message">
            <h2>🎉 You’re Now Registered Participant!</h2>
            <p>Welcome to our community! You're now officially a participant.</p>
        </div>

        <!-- Share Section -->
        <div class="share-section">
            <h3>Share the excitement with friends! 🚀</h3>
            <p>Invite your friends to join this amazing experience</p>
            
            <div class="share-buttons">
                <!-- Facebook Share Button -->
                <button onclick="shareOnFacebook()" class="facebook-share-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Share on Facebook
                </button>

                <!-- Copy Link Button -->
                {{-- <button onclick="copyShareLink()" class="copy-link-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z" 
                              fill="#6B7280"/>
                    </svg>
                    Copy Link
                </button> --}}
            </div>

            <!-- Share Stats -->
            {{-- <div class="share-stats">
                <div class="stat-item">
                    <span class="stat-number" id="shareCount">0</span>
                    <span class="stat-label">Shares</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="friendCount">0</span>
                    <span class="stat-label">Friends Joined</span>
                </div>
            </div> --}}
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button onclick="closeSuccessPopup()" class="close-btn">
                Close
            </button>
            {{-- <button onclick="viewDashboard()" class="dashboard-btn">
                View Dashboard
            </button> --}}
        </div>
    </div>
</div>
    <!--  Thank you -->
    <div class="modal fade" id="ThankYou" tabindex="-1" aria-labelledby="ThankYouLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content agent-registration-popup">

                <div class="popup-outer-content thankyou-popup">
                    <h1>Thank you</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    <div class="thankyou-bitton">
                        <button type="button" class="btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- New Thank you Popup-->
    <div class="modal fade" id="NewThankYou" tabindex="-1" aria-labelledby="ThankYouLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content agent-registration-popup">

                <div class="popup-outer-content thankyou-popup">
                    <h1>Thank you for sharing your information</h1>
                    <p class="eligible-text">You're eligible for Early Access to PadosiAgent.</p>
                    <p>We'll connect with you soon as we expand our ecosystem.</p>
                    <div class="thankyou-bitton">
                        <button type="button" class="btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let selectedCompanies = [];
        const indianInsuranceCompanies = [
            'LIC', 'HDFC Life', 'ICICI Prudential', 'SBI Life', 'Max Life',
            'Bajaj Allianz', 'Kotak Life', 'Aditya Birla Sun Life', 'TATA AIG',
            'Reliance Nippon', 'PNB MetLife', 'Aviva Life', 'Shriram Life',
            'Sahara Life', 'Star Health', 'HDFC ERGO', 'ICICI Lombard',
            'Bajaj Allianz General', 'New India Assurance', 'United India',
            'National Insurance', 'Oriental Insurance'
        ];

        function showAlert(message, type = 'success') {
            const alertDiv = type === 'success' ? document.getElementById('successAlert') : document.getElementById('errorAlert');
            const otherAlert = type === 'success' ? document.getElementById('errorAlert') : document.getElementById('successAlert');

            alertDiv.textContent = message;
            alertDiv.style.display = 'block';
            otherAlert.style.display = 'none';

            if (type === 'success' || type === 'error') {
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 5000);
            }
            
        }

        function showStep(step) {
            document.querySelectorAll('.modal-step').forEach(el => {
                el.classList.remove('active');
            });
            document.querySelector(`[data-step="${step}"]`).classList.add('active');
            currentStep = step;
        }

        function previousStep() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        // function addCompany() {
        //     const companyInput = document.getElementById('companyInput');
        //     const companyName = companyInput.value.trim();

        //     if (companyName && !selectedCompanies.includes(companyName)) {
        //         selectedCompanies.push(companyName);
        //         updateSelectedCompanies();
        //         companyInput.value = '';
        //     }
        // }

        // Update your existing addCompany function (just add the validation)
function addCompany() {
    const companyInput = document.getElementById('companyInput');
    const companyName = companyInput.value.trim();

    if (companyName === '') return;

    // ADD THIS VALIDATION ONLY:
    if (!indianInsuranceCompanies.includes(companyName)) {
        // Show error in your existing alert system
        showAlert('"' + companyName + '" is not an approved insurance company. Please select from the list.', 'error');
        companyInput.value = '';
        return;
    }

    // YOUR EXISTING CODE BELOW - KEEP AS IS
    if (selectedCompanies.includes(companyName)) {
        // Your existing duplicate check
        return;
    }

    selectedCompanies.push(companyName);
    updateSelectedCompanies();
    companyInput.value = '';
}

        function updateSelectedCompanies() {
            const container = document.getElementById('selectedCompanies');
            const hiddenInput = document.getElementById('insuranceCompaniesInput');

            container.innerHTML = '';
            selectedCompanies.forEach((company, index) => {
                const item = document.createElement('div');
                item.className = 'selected-item';
                item.innerHTML = `
                    ${company}
                    <button type="button" class="remove-item" onclick="removeCompany(${index})">×</button>
                `;
                container.appendChild(item);
            });

            hiddenInput.value = JSON.stringify(selectedCompanies);
        }

        function removeCompany(index) {
            selectedCompanies.splice(index, 1);
            updateSelectedCompanies();
        }

        // In your Blade file, update ALL fetch calls:

   


        // ==================== GOOGLE AUTHENTICATION ====================

// Open Google auth in popup
function openGoogleAuth() {
    const width = 500;
    const height = 600;
    const left = (screen.width - width) / 2;
    const top = (screen.height - height) / 2;
    
    // Open popup and store reference
    const popup = window.open(
        '/auth/google',
        'GoogleAuth',
        `width=${width},height=${height},left=${left},top=${top},toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes`
    );
    
    if (!popup) {
        showAlert('Popup blocked! Please allow popups for this site.', 'error');
        return;
    }
    
    // Focus on popup
    popup.focus();
    
    // Check when popup closes
    const checkPopup = setInterval(() => {
        if (!popup || popup.closed) {
            clearInterval(checkPopup);
            checkForGoogleData();
        }
    }, 1000);
}

// Check for Google data after popup closes
function checkForGoogleData() {
    fetch('/auth/google/get-session-data')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.user) {
                fillFormWithGoogleData(data.user);
            }
        })
        .catch(error => console.log('No Google data available'));
}

// Fill form with Google data
function fillFormWithGoogleData(user) {
    const emailInput = document.querySelector('input[name="email"]');
    const nameInput = document.querySelector('input[name="fullname"]');
    
    if (emailInput) emailInput.value = user.email;
    if (nameInput) nameInput.value = user.fullname;
    
    // Make email read-only
    if (emailInput) emailInput.readOnly = true;
    
    // Store Google ID in a hidden field (optional)
    if (user.google_id) {
        let googleIdField = document.querySelector('input[name="google_id"]');
        if (!googleIdField) {
            googleIdField = document.createElement('input');
            googleIdField.type = 'hidden';
            googleIdField.name = 'google_id';
            document.getElementById('agentForm1').appendChild(googleIdField);
        }
        googleIdField.value = user.google_id;
    }
    
    showAlert('Google authentication successful! Email and name filled automatically.', 'success');
    
    setTimeout(() => {
        const mobileInput = document.querySelector('input[name="mobile"]');
        if (mobileInput) mobileInput.focus();
    }, 500);
}

// Initialize Google Auth
document.addEventListener('DOMContentLoaded', function() {
    const googleBtn = document.querySelector('.btn.gmail');
    if (googleBtn) {
        googleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openGoogleAuth();
        });
    }
});



// Check for Google user data on page load
document.addEventListener('DOMContentLoaded', function() {
    checkGoogleUserData();
});

// Function to check and pre-fill Google user data
async function checkGoogleUserData() {
    try {
        const response = await fetch('/auth/google/user-data');
        const data = await response.json();
        
        if (data.success && data.user) {
            // Pre-fill form with Google data
            const emailInput = document.querySelector('input[name="email"]');
            const nameInput = document.querySelector('input[name="fullname"]');
            
            if (emailInput) emailInput.value = data.user.email;
            if (nameInput) nameInput.value = data.user.fullname;
            
            // Disable email field for Google users
            if (emailInput) emailInput.readOnly = true;
            
            showAlert('Google authentication successful! Please complete your mobile number and professional details.', 'success');
        }
    } catch (error) {
        console.log('No Google user data found');
    }
}

// Clear Google session if user wants to change email
function clearGoogleSession() {
    fetch('/auth/google/clear-session', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    }).then(() => {
        const emailInput = document.querySelector('input[name="email"]');
        const nameInput = document.querySelector('input[name="fullname"]');
        
        if (emailInput) {
            emailInput.readOnly = false;
            emailInput.value = '';
        }
        if (nameInput) nameInput.value = '';
    });
}
        // Step 1 Form Submission THIS IS WORKIN CODE
   // Step 1 Form Submission - Updated to handle 422 errors properly

   // Step 1 Form Submission - Updated to handle user types validation and conditional flow
// Step 1 Form Submission - Updated to close the specific modal
document.getElementById('agentForm1').addEventListener('submit', async function (e) {
    e.preventDefault();

    // Validate at least one user type is selected
    const userTypes = document.querySelectorAll('input[name="user_types[]"]:checked');
    if (userTypes.length === 0) {
        showAlert('Please select at least one user type.', 'error');
        return;
    }

        // Email validation
    const email = document.querySelector('input[name="email"]').value.trim();
    if (!email) {
        showAlert('Email address is required.', 'error');
        //highlightInvalidField('input[name="email"]');
        return; // Stop form submission
    }

    if (!isValidEmail(email)) {
        showAlert('Please provide a valid email address.', 'error');
        //highlightInvalidField('input[name="email"]');
        return; // Stop form submission
    }

    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Processing...';

    try {
        const response = await fetch('{{ url("/agent-register-step1") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        const data = await response.json();

        if (!response.ok) {
            // Handle 422 validation errors (email already exists, validation errors)
            if (response.status === 422 && data.message) {
                showAlert(data.message, 'error');
            } else {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
        } else if (data.success) {
            // Check if user selected insurance_agent
            const hasInsuranceAgent = Array.from(userTypes).some(checkbox => 
                checkbox.value === 'insurance_agent'
            );
            
            if (hasInsuranceAgent) {
                // Show step 2 for insurance agents
                showStep(data.next_step);
                showAlert('Basic information saved successfully!', 'success');
            } else {
                // Find and close the modal that contains modal-dialog modal-lg
                const modals = document.querySelectorAll('.modal');
                let targetModal = null;

                // Find the modal that is currently open and contains modal-dialog modal-lg
                modals.forEach(modal => {
                    if (modal.classList.contains('show')) {
                        const modalDialog = modal.querySelector('.modal-dialog.modal-lg');
                        if (modalDialog) {
                            targetModal = modal;
                        }
                    }
                });

                // Close the found modal
                if (targetModal) {
                    const bootstrapModal = bootstrap.Modal.getInstance(targetModal);
                    if (bootstrapModal) {
                        bootstrapModal.hide();
                    } else {
                        // Fallback: create new instance and hide
                        const modal = new bootstrap.Modal(targetModal);
                        modal.hide();
                    }
                }

                // Wait for modal to fully hide before showing thank you modal
                setTimeout(() => {
                    // Show thank you modal
                    const thankYouModal = new bootstrap.Modal(document.getElementById('NewThankYou'));
                    thankYouModal.show();
                    
                    // Reset form
                    this.reset();
                    
                    showAlert('Registration completed successfully!', 'success');
                }, 300);
            }
        } else {
            showAlert(data.message || 'Error saving information.', 'error');
        }
    } catch (error) {
        // Only show network errors, not 422 errors (they're handled above)
        if (!error.message.includes('HTTP error! status: 422')) {
            showAlert('Network Error: ' + error.message, 'error');
        }
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Continue';
    }
});
// Real-time validation for checkboxes to hide error when at least one is selected
document.addEventListener('DOMContentLoaded', function() {
    const userTypesGroup = document.getElementById('userTypesGroup');
    if (userTypesGroup) {
        userTypesGroup.addEventListener('change', function() {
            const userTypes = document.querySelectorAll('input[name="user_types[]"]:checked');
            // Error message will be handled in form submission
        });
    }
});

// document.getElementById('agentForm1').addEventListener('submit', async function (e) {
//     e.preventDefault();

//     const formData = new FormData(this);
//     const submitBtn = this.querySelector('button[type="submit"]');
//     submitBtn.disabled = true;
//     submitBtn.textContent = 'Processing...';

//     try {
//         const response = await fetch('{{ url("/agent-register-step1") }}', {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
//             }
//         });

//         const data = await response.json();

//         if (!response.ok) {
//             // Handle 422 validation errors (email already exists)
//             if (response.status === 422 && data.message) {
//                 showAlert(data.message, 'error');
//             } else {
//                 throw new Error(`HTTP error! status: ${response.status}`);
//             }
//         } else if (data.success) {
//             showStep(data.next_step);
//             showAlert('Basic information saved successfully!', 'success');
//         } else {
//             showAlert(data.message || 'Error saving information.', 'error');
//         }
//     } catch (error) {
//         // Only show network errors, not 422 errors (they're handled above)
//         if (!error.message.includes('HTTP error! status: 422')) {
//             showAlert('Network Error: ' + error.message, 'error');
//         }
//     } finally {
//         submitBtn.disabled = false;
//         submitBtn.textContent = 'Continue';
//     }
// });
        // document.getElementById('agentForm1').addEventListener('submit', async function (e) {
        //     e.preventDefault();

        //     const formData = new FormData(this);
        //     const submitBtn = this.querySelector('button[type="submit"]');
        //     submitBtn.disabled = true;
        //     submitBtn.textContent = 'Processing...';

        //     try {
        //         const response = await fetch('{{ url("/agent-register-step1") }}', {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        //             }
        //         });

        //         if (!response.ok) {
        //             throw new Error(`HTTP error! status: ${response.status}`);
        //         }

        //         const data = await response.json();

        //         if (data.success) {
        //             showStep(data.next_step);
        //             showAlert('Basic information saved successfully!', 'success');
        //         } else {
        //             showAlert('Error: ' + data.message, 'error');
        //         }
        //     } catch (error) {
        //         showAlert('Network Error: ' + error.message, 'error');
        //     } finally {
        //         submitBtn.disabled = false;
        //         submitBtn.textContent = 'Continue';
        //     }
        // });

        // Step 2 Form Submission THIS IS WORKING CODE
        // Simpler approach for "All of Above" logic
document.addEventListener('DOMContentLoaded', function() {
    const allOfAboveCheckbox = document.querySelector('input[name="desired_services[]"][value="All_of_Above"]');
    const otherCheckboxes = document.querySelectorAll('input[name="desired_services[]"]:not([value="All_of_Above"])');
    
    // When "All of Above" is clicked
    allOfAboveCheckbox.addEventListener('change', function() {
        if (this.checked) {
            // Check all other checkboxes
            otherCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        }
    });
    
    // When any individual checkbox is changed
    otherCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // If any individual checkbox is unchecked, uncheck "All of Above"
            if (!this.checked && allOfAboveCheckbox.checked) {
                allOfAboveCheckbox.checked = false;
            }
            
            // If all individual checkboxes are checked, check "All of Above"
            const allChecked = Array.from(otherCheckboxes).every(cb => cb.checked);
            if (allChecked) {
                allOfAboveCheckbox.checked = true;
            }
        });
    });

    // PAN number validation
    const panInput = document.querySelector('input[name="pan_number"]');
    if (panInput) {
        panInput.addEventListener('input', function() {
            validatePANFormat(this);
        });
        
        panInput.addEventListener('blur', function() {
            validatePANFormat(this, true);
        });
    }
});

// PAN Card validation function
function validatePANFormat(input, showError = false) {
    const value = input.value.trim().toUpperCase();
    const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
    
    if (value === '') {
        return true; // Empty is okay since it's not required if license is provided
    }
    
    if (panRegex.test(value)) {
        input.style.borderColor = '#10b981'; // Green border for valid
        return true;
    } else {
        input.style.borderColor = '#ef4444'; // Red border for invalid
        
        if (showError && value.length > 0) {
            // Show error message
            let errorElement = input.parentNode.querySelector('.pan-error');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.className = 'pan-error';
                errorElement.style.color = '#ef4444';
                errorElement.style.fontSize = '0.875rem';
                errorElement.style.marginTop = '0.25rem';
                input.parentNode.appendChild(errorElement);
            }
            errorElement.textContent = 'Invalid PAN format. Format: 5 letters + 4 digits + 1 letter (e.g., ABCDE1234F)';
        }
        return false;
    }
}

// Form submission with PAN validation
document.getElementById('agentForm2').addEventListener('submit', async function (e) {
    e.preventDefault();

    // Validate PAN format if provided
    const panInput = document.querySelector('input[name="pan_number"]');
    const panValue = panInput.value.trim();
    
    if (panValue && !validatePANFormat(panInput, true)) {
        showAlert('Please enter a valid PAN number format (e.g., ABCDE1234F)', 'error');
        return;
    }

    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Processing...';

    try {
        const response = await fetch('{{ url("/agent-register-step2") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            showStep(data.next_step);
            showAlert('Professional details saved successfully!', 'success');
        } else {
            showAlert('Error: ' + data.message, 'error');
        }
    } catch (error) {
        showAlert('Network Error: ' + error.message, 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Continue';
    }
});
        // document.getElementById('agentForm2').addEventListener('submit', async function (e) {
        //     e.preventDefault();

        //     const formData = new FormData(this);
        //     const submitBtn = this.querySelector('button[type="submit"]');
        //     submitBtn.disabled = true;
        //     submitBtn.textContent = 'Processing...';

        //     try {
        //         const response = await fetch('{{ url("/agent-register-step2") }}', {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        //             }
        //         });

        //         if (!response.ok) {
        //             throw new Error(`HTTP error! status: ${response.status}`);
        //         }

        //         const data = await response.json();

        //         if (data.success) {
        //             showStep(data.next_step);
        //             showAlert('Professional details saved successfully!', 'success');
        //         } else {
        //             showAlert('Error: ' + data.message, 'error');
        //         }
        //     } catch (error) {
        //         showAlert('Network Error: ' + error.message, 'error');
        //     } finally {
        //         submitBtn.disabled = false;
        //         submitBtn.textContent = 'Continue';
        //     }
        // });

function showAlert1(message, type = 'success') {
            const alertDiv = type === 'success' ? document.getElementById('successAlert') : document.getElementById('errorAlert');
            const otherAlert = type === 'success' ? document.getElementById('errorAlert') : document.getElementById('successAlert');

            alertDiv.textContent = message;
            alertDiv.style.display = 'block';
            otherAlert.style.display = 'none';

            if (type === 'success' || type === 'error') {
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 5000);
            }
            
        }

document.getElementById('participantForm').addEventListener('submit', async function (e) {
    e.preventDefault();

            // Email validation
    const email = document.getElementById('email_address').value.trim();

    if (!isValidEmail(email)) {
        const alertDiv =document.getElementById('errorAlert_p');
        
        document.getElementById('errorAlert_p').textContent = 'Please provide a valid email address.';
        alertDiv.style.display = 'block';
        setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 5000);
        //showAlert('Please provide a valid email address.', 'error');
        //highlightInvalidField('input[name="email"]');
        return; // Stop form submission
    }
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Processing...';

    try {
        const response = await fetch('/participants', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
        console.log('Full response data:', data); // Add this line to see what's returned

        if (!response.ok) {
            if (response.status === 422 && data.message) {
                showAlert('Please fix the validation errors below.', 'error');
            } else if (data.message) {
                showAlert(data.message, 'error');
            } else {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
        } else if (data.success) {
            console.log('Success! Calling showSuccessPopup...'); // Debug log
            showSuccessPopup(data.share_url, data.participant);
            showAlert('Registration completed successfully!', 'success');
            this.reset();

            // Close the BecomeCustomer modal specifically
const becomeCustomerModal = document.getElementById('BecomeCustomer');

// Close the BecomeCustomer modal
if (becomeCustomerModal) {
    const bootstrapModal = bootstrap.Modal.getInstance(becomeCustomerModal);
    if (bootstrapModal) {
        bootstrapModal.hide();
    } else {
        // Fallback: create new instance and hide
        const modal = new bootstrap.Modal(becomeCustomerModal);
        modal.hide();
    }
}
        } else {
            showAlert(data.message || 'Error saving information.', 'error');
        }
    } catch (error) {
        if (!error.message.includes('HTTP error! status: 422')) {
            showAlert('Network Error: ' + error.message, 'error');
        }
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit';
    }
});

        
        // Complete Registration with Razorpay Payment
        // Complete Registration with Razorpay Payment
async function handlePayment() {
    const termsCheckbox = document.getElementById('terms');
    
    // Check if terms are agreed
    if (!termsCheckbox.checked) {    
        alert('❌ Please agree to the Terms and Conditions and Privacy Policy to proceed with payment.');    
        showAlert('❌ Please agree to the Terms and Conditions and Privacy Policy to proceed with payment.', 'error');
        termsCheckbox.focus();
        return;
    }
    const paymentBtn = document.querySelector('.secure-payment');
    
    if (!paymentBtn) {
        console.error('Payment button not found');
        return;
    }
    
    paymentBtn.disabled = true;
    paymentBtn.textContent = 'Creating Registration...';

    try {
        console.log('Starting payment process...');
        
        const response = await fetch('/agent-register-complete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Response data:', data);

        if (data.success) {
            if (data.test_payment) {
                // Test payment mode - Show success popup
                console.log('Test payment mode activated');
                showPaymentSuccessPopup('🎉 Registration Complete!', 'Your registration has been completed successfully in test mode. Welcome to Padosi!');
            } else {
                paymentBtn.textContent = 'Opening Payment...';
                console.log('Opening Razorpay payment...');

                // Check if Razorpay is available
                if (typeof Razorpay === 'undefined') {
                    throw new Error('Razorpay payment gateway not loaded. Please refresh the page.');
                }

                // Razorpay Payment Options
                const options = {
                    "key": data.razorpay_key || data.key,
                    "amount": data.amount,
                    "currency": data.currency || "INR",
                    "name": "Padosi Agent Registration",
                    "description": "Agent Registration Fee",
                    "image": "{{ asset('images/logo.png') }}", // Make sure you have a logo
                    "order_id": data.order_id,
                    "handler": function (response) {
                        console.log('Payment successful:', response);
                        handlePaymentSuccess(response, data.agent_id);
                    },
                    "prefill": {
                        "name": data.name || "Customer",
                        "email": data.email || "customer@example.com",
                        "contact": data.mobile || "9999999999"
                    },
                    "notes": {
                        "agent_id": data.agent_id
                    },
                    "theme": {
                        "color": "#4f46e5"
                    },
                    "modal": {
                        "ondismiss": function () {
                            console.log('Payment modal dismissed');
                            showPaymentFailedPopup('Payment Cancelled', 'You cancelled the payment. You can complete the payment later from your dashboard.');
                            resetPaymentButton();
                        }
                    }
                };

                console.log('Razorpay options:', options);

                // Create and open Razorpay instance
                const rzp = new Razorpay(options);
                
                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response.error);
                    showPaymentFailedPopup(
                        'Payment Failed',
                        `Payment failed: ${response.error.description}. Please try again or use a different payment method.`
                    );
                    resetPaymentButton();
                });

                // Open payment modal
                rzp.open();
                
            }
        } else {
            console.error('Registration failed:', data);
            showPaymentFailedPopup('Registration Failed', data.message || 'Unable to process registration. Please try again.');
            resetPaymentButton();
        }
    } catch (error) {
        console.error('Payment error:', error);
        showPaymentFailedPopup('Payment Error', 'Unable to process payment. Please check your internet connection and try again. Error: ' + error.message);
        resetPaymentButton();
    }
}
        // async function handlePayment() {
        //     const paymentBtn = document.querySelector('.secure-payment');
        //     paymentBtn.disabled = true;
        //     paymentBtn.textContent = 'Creating Registration...';

        //     try {
        //         const response = await fetch('{{ url("/agent-register-complete") }}', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        //             }
        //         });

        //         if (!response.ok) {
        //             throw new Error(`HTTP error! status: ${response.status}`);
        //         }

        //         const data = await response.json();

        //         if (data.success) {
        //             if (data.test_payment) {
        //                 // Test payment mode - Show success popup
        //                 showPaymentSuccessPopup('🎉 Registration Complete!', 'Your registration has been completed successfully in test mode. Welcome to Padosi!');
        //             } else {
        //                 paymentBtn.textContent = 'Opening Payment...';

        //                 // Razorpay Payment
        //                 const options = {
        //                     "key": data.key,
        //                     "amount": data.amount,
        //                     "currency": data.currency,
        //                     "name": "Padosi Agent Registration",
        //                     "description": "Agent Registration Fee - ₹2358",
        //                     "image": "/favicon.ico",
        //                     "order_id": data.order_id,
        //                     "handler": function (response) {
        //                         handlePaymentSuccess(response, data.agent_id);
        //                     },
        //                     "prefill": {
        //                         "name": data.name,
        //                         "email": data.email,
        //                         "contact": data.mobile
        //                     },
        //                     "notes": {
        //                         "agent_id": data.agent_id
        //                     },
        //                     "theme": {
        //                         "color": "#4f46e5"
        //                     },
        //                     "modal": {
        //                         "ondismiss": function () {
        //                             showPaymentFailedPopup('Payment Cancelled', 'You cancelled the payment. You can complete the payment later from your dashboard.');
        //                             resetPaymentButton();
        //                         }
        //                     }
        //                 };

        //                 const rzp = new Razorpay(options);
        //                 rzp.on('payment.failed', function (response) {
        //                     console.error('Payment failed:', response.error);
        //                     showPaymentFailedPopup(
        //                         'Payment Failed',
        //                         `Payment failed: ${response.error.description}. Please try again or use a different payment method.`
        //                     );
        //                     resetPaymentButton();
        //                 });

        //                 rzp.open();
        //             }
        //         } else {
        //             showPaymentFailedPopup('Registration Failed', data.message || 'Unable to process registration. Please try again.');
        //             resetPaymentButton();
        //         }
        //     } catch (error) {
        //         showPaymentFailedPopup('Network Error', 'Unable to connect to server. Please check your internet connection and try again.');
        //         resetPaymentButton();
        //     }
        // }

        // Handle Razorpay Payment Success
        async function handlePaymentSuccess(paymentResponse, agentId) {
            try {
                const response = await fetch('{{ url("/payment-success") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: paymentResponse.razorpay_payment_id,
                        razorpay_order_id: paymentResponse.razorpay_order_id,
                        razorpay_signature: paymentResponse.razorpay_signature,
                        agent_id: agentId
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    showPaymentSuccessPopup(
                        '🎉 Payment Successful!',
                        'Your payment has been processed successfully and your registration is now complete. Welcome to Padosi!'
                    );
                } else {
                    showPaymentFailedPopup('Payment Verification Failed', data.message || 'Unable to verify payment. Please contact support.');
                }
            } catch (error) {
                showPaymentFailedPopup('Payment Verification Failed', 'Unable to verify payment. Please contact our support team.');
            }
        }

        // Payment Popup Functions
        function showPaymentSuccessPopup(title, message) {
            showCustomPopup('success', title, message);
            setTimeout(() => {
                window.location.reload();
            }, 5000);
        }

        function showPaymentFailedPopup(title, message) {
            showCustomPopup('error', title, message);
        }

        function showCustomPopup(type, title, message) {
            // Create popup overlay
            const popupOverlay = document.createElement('div');
            popupOverlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    `;

            // Create popup content
            const popupContent = document.createElement('div');
            popupContent.style.cssText = `
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    `;

            // Create icon based on type
            const icon = type === 'success' ? '✅' : '❌';
            const titleColor = type === 'success' ? '#10b981' : '#ef4444';
            const buttonColor = type === 'success' ? '#10b981' : '#ef4444';

            popupContent.innerHTML = `
        <div style="font-size: 48px; margin-bottom: 15px;">${icon}</div>
        <h2 style="color: ${titleColor}; margin-bottom: 15px; font-size: 24px;">${title}</h2>
        <p style="color: #6b7280; margin-bottom: 25px; line-height: 1.5;">${message}</p>
        <button onclick="this.closest('div').remove()" 
                style="background: ${buttonColor}; color: white; border: none; padding: 12px 30px; 
                       border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600;">
            ${type === 'success' ? 'Continue' : 'Try Again'}
        </button>
        ${type === 'success' ? '<p style="color: #9ca3af; font-size: 14px; margin-top: 15px;">Redirecting in 5 seconds...</p>' : ''}
    `;

            popupOverlay.appendChild(popupContent);
            document.body.appendChild(popupOverlay);

            // Close on overlay click
            popupOverlay.addEventListener('click', function (e) {
                if (e.target === popupOverlay) {
                    popupOverlay.remove();
                }
            });
        }

        function resetPaymentButton() {
            const paymentBtn = document.querySelector('.btn-payment');
            if (paymentBtn) {
                paymentBtn.disabled = false;
                paymentBtn.textContent = 'Pay ₹2358 & Register';
            }
        }

        // Test route check (optional)

    document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[name="software_services[]"]');
    const softwareNameInput = document.getElementById('software_name');
    
    // Hide software name input by default
    softwareNameInput.style.display = 'none';
    
    // Add event listeners to radio buttons
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'Yes') {
                softwareNameInput.style.display = 'block';
                softwareNameInput.focus();
            } else {
                softwareNameInput.style.display = 'none';
                softwareNameInput.value = '';
            }
        });
    });
});

        // document.addEventListener('DOMContentLoaded', function () {
        //     // Initialize company datalist
        //     const companyInput = document.getElementById('companyInput');
        //     const datalist = document.createElement('datalist');
        //     datalist.id = 'companyList';

        //     indianInsuranceCompanies.forEach(company => {
        //         const option = document.createElement('option');
        //         option.value = company;
        //         datalist.appendChild(option);
        //     });

        //     companyInput.setAttribute('list', 'companyList');
        //     document.body.appendChild(datalist);
        // });

        // Add datalist to restrict input
document.addEventListener('DOMContentLoaded', function() {
    const companyInput = document.getElementById('companyInput');
    
    // Create datalist
    const datalist = document.createElement('datalist');
    datalist.id = 'companyOptions';
    
    // Add options
    indianInsuranceCompanies.forEach(company => {
        const option = document.createElement('option');
        option.value = company;
        datalist.appendChild(option);
    });
    
    document.body.appendChild(datalist);
    companyInput.setAttribute('list', 'companyOptions');
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // DOM Elements
        const lifeInput = document.querySelector('input[name="life_insurance"]');
        const healthInput = document.querySelector('input[name="health_insurance"]');
        const generalInput = document.querySelector('input[name="general_insurance"]');
        const mutualInput = document.querySelector('input[name="mutual_funds"]');
        const othersInput = document.querySelector('input[name="others"]');
        const totalDisplay = document.getElementById('totalDisplay');
        const companyInput = document.getElementById('companyInput');
        const selectedCompaniesDiv = document.getElementById('selectedCompanies');
        const insuranceCompaniesInput = document.getElementById('insuranceCompaniesInput');

        // Portfolio data
        let portfolioData = {
            labels: ['Life Insurance', 'Health Insurance', 'General Insurance', 'Mutual Funds', 'Others'],
            values: [25, 15, 40, 10, 10],
            colors: [
                '#3498db', // Life Insurance - Blue
                '#2ecc71', // Health Insurance - Green
                '#e74c3c', // General Insurance - Red
                '#f39c12', // Mutual Funds - Orange
                '#9b59b6'  // Others - Purple
            ]
        };

        // Initialize Chart
        let portfolioChart;

        function initChart() {
            const ctx = document.getElementById('portfolioChart').getContext('2d');
            portfolioChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: portfolioData.labels,
                    datasets: [{
                        data: portfolioData.values,
                        backgroundColor: portfolioData.colors,
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    return `${label}: ${value}%`;
                                }
                            }
                        }
                    }
                }
            });

            updateLegend();
        }

        // Update the custom legend
        function updateLegend() {
            const legendContainer = document.getElementById('chartLegend');
            legendContainer.innerHTML = '';

            portfolioData.labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.className = 'legend-item';

                const colorBox = document.createElement('div');
                colorBox.className = 'legend-color';
                colorBox.style.backgroundColor = portfolioData.colors[index];

                const labelText = document.createElement('span');
                labelText.textContent = `${label}: ${portfolioData.values[index]}%`;

                legendItem.appendChild(colorBox);
                legendItem.appendChild(labelText);
                legendContainer.appendChild(legendItem);
            });
        }

        // Calculate percentages and update display
        function updatePercentages() {
            // Get current values
            const lifeValue = parseFloat(lifeInput.value) || 0;
            const healthValue = parseFloat(healthInput.value) || 0;
            const generalValue = parseFloat(generalInput.value) || 0;
            const mutualValue = parseFloat(mutualInput.value) || 0;
            const othersValue = parseFloat(othersInput.value) || 0;

            // Calculate total
            let total = lifeValue + healthValue + generalValue + mutualValue + othersValue;

            // Update portfolio data
            portfolioData.values = [lifeValue, healthValue, generalValue, mutualValue, othersValue];

            // Update total display
            totalDisplay.textContent = `Total: ${total}%`;
            if (total === 100) {
                totalDisplay.className = 'total-display total-ok';
            } else if (total > 100) {
                totalDisplay.className = 'total-display total-error';
            } else {
                totalDisplay.className = 'total-display total-warning';
            }

            // Update chart
            portfolioChart.data.datasets[0].data = portfolioData.values;
            portfolioChart.update();

            // Update legend
            updateLegend();
        }

        // Completely block invalid entries
function addCompany() {
    const companyInput = document.getElementById('companyInput');
    const companyName = companyInput.value.trim();

    if (companyName === '') return;

    // STRICT VALIDATION - Only allow exact matches
    if (!indianInsuranceCompanies.includes(companyName)) {
        // Show error and clear input
        showAlert('❌ "' + companyName + '" is not an approved insurance company. Please select from the dropdown suggestions.', 'error');
        companyInput.value = '';
        companyInput.focus();
        return;
    }

    // Rest of your existing code...
    if (selectedCompanies.includes(companyName)) {
        showAlert('ℹ️ "' + companyName + '" is already selected', 'info');
        companyInput.value = '';
        return;
    }

    selectedCompanies.push(companyName);
    updateSelectedCompanies();
    companyInput.value = '';
}

        // Remove company from selected list
        function removeCompany(companyId) {
            const companyElement = document.getElementById(companyId);
            if (companyElement) {
                companyElement.remove();
                updateCompaniesInput();
            }
        }

        // Update hidden input with selected companies
        function updateCompaniesInput() {
            const companies = [];
            const companyElements = selectedCompaniesDiv.querySelectorAll('.selected-item span');
            companyElements.forEach(span => {
                companies.push(span.textContent);
            });
            insuranceCompaniesInput.value = JSON.stringify(companies);
        }

        // Form submission handler
        document.getElementById('agentForm2').addEventListener('submit', function (e) {
            e.preventDefault();

            // Validate portfolio total
            const lifeValue = parseFloat(lifeInput.value) || 0;
            const healthValue = parseFloat(healthInput.value) || 0;
            const generalValue = parseFloat(generalInput.value) || 0;
            const mutualValue = parseFloat(mutualInput.value) || 0;
            const othersValue = parseFloat(othersInput.value) || 0;

            const total = lifeValue + healthValue + generalValue + mutualValue + othersValue;

            if (total !== 100) {
                alert('Portfolio breakdown must total exactly 100%. Current total: ' + total + '%');
                return;
            }

            // Validate companies
            const companies = JSON.parse(insuranceCompaniesInput.value || '[]');
            if (companies.length === 0) {
                alert('Please add at least one insurance company');
                return;
            }

            // If all validations pass
            //alert('Form submitted successfully!');
            // In a real application, you would submit the form data to the server here
        });

        // Previous step function
        function previousStep() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
            //alert('Going back to previous step...');
            // In a real application, you would navigate to the previous step
        }

        // Event Listeners for portfolio inputs
        lifeInput.addEventListener('input', updatePercentages);
        healthInput.addEventListener('input', updatePercentages);
        generalInput.addEventListener('input', updatePercentages);
        mutualInput.addEventListener('input', updatePercentages);
        othersInput.addEventListener('input', updatePercentages);

        // Allow adding company with Enter key
        companyInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addCompany();
            }
        });

        // Initialize the application
        window.onload = function () {
            initChart();
            updatePercentages();
        };
    </script>
     <script>
        // Sequential Language Spinner
        const languages = [
            { text: "पड़ोसी", lang: "Hindi" },
            { text: "પડોશી", lang: "Gujarati" },
            { text: "ಪಡೋಸಿ", lang: "Kannada" },
            // { text: "പഡോസി", lang: "Malayalam" },
            // { text: "పొరుగువాడు", lang: "Telugu" },
            //{ text: "அண்டை வீட்டுக்காரர்", lang: "Tamil" },
            { text: "পড়শি", lang: "Bengali" },
            { text: "ਪੜੋਸੀ", lang: "Punjabi" },
            { text: "پڑوسی", lang: "Urdu" },
            { text: "ପଡୋଶୀ", lang: "Odia" },
            { text: "همسایه", lang: "Persian" },
            { text: "جارت", lang: "Arabic" }
        ];
        
        const currentLanguageElement = document.getElementById('currentLanguage');
        let currentIndex = 0;
        
        // Function to change language with animation
        
        function changeLanguage() {
            // Fade out current language
            currentLanguageElement.classList.remove('active');
            currentLanguageElement.classList.add('fading');
            
            setTimeout(() => {
                // Update to next language
                currentIndex = (currentIndex + 1) % languages.length;
                currentLanguageElement.textContent = languages[currentIndex].text;
                currentLanguageElement.title = `${languages[currentIndex].lang}: ${languages[currentIndex].text}`;
                
                // Fade in new language
                currentLanguageElement.classList.remove('fading');
                currentLanguageElement.classList.add('active');
            }, 800);
        }
        
        // Start language rotation
        setInterval(changeLanguage, 2000);        
    </script>
    <script>
        function showSuccessPopup(shareUrl, participant) {
    console.log('showSuccessPopup called with:', { shareUrl, participant }); // Debug log
    
    const popup = document.getElementById('successPopup');
    
    if (!popup) {
        console.error('Success popup element not found!');
        showAlert('Registration successful!', 'success');
        return;
    }
    
    console.log('Popup element found:', popup); // Debug log
    
    // Store share URL for later use
    popup.setAttribute('data-share-url', shareUrl);
    
    // Show the popup
    popup.style.display = 'flex';
    console.log('Popup should be visible now'); // Debug log
    
    // Start counter animations
    if (document.getElementById('shareCount')) {
        animateCounter('shareCount', 0, Math.floor(Math.random() * 50) + 10, 2000);
    }
    if (document.getElementById('friendCount')) {
        animateCounter('friendCount', 0, Math.floor(Math.random() * 20) + 5, 2500);
    }
}

// Simple fallback if animateCounter doesn't exist
function animateCounter(elementId, start, end, duration) {
    const element = document.getElementById(elementId);
    if (!element) {
        console.warn('Counter element not found:', elementId);
        return;
    }
    
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value;
        
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

function shareOnFacebook() {
    const popup = document.getElementById('successPopup');
    if (!popup) return;
    
    //let shareUrl = popup.getAttribute('data-share-url');
    let shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=https://www.facebook.com/profile.php?id=61570016781365';
    
    if (!shareUrl || shareUrl === 'undefined') {
        shareUrl = window.location.origin;
    }
    
    // Create draft message
    const draftMessage = `Just joined PadosiAgent! 🎉 Connect with Insurance Agents, Mutual Fund Agents, CAs, Lawyers and find trusted professionals near you! #agent #insurance #insuranceagent #InsuranceAwareness #insuranceindustry #lifeinsurance #GeneralInsurance #HealthInsurance #insurancebroker #advisor #insuranceadvisor #FinancialAdvisor @padosiagent\n\n${shareUrl}`;
    
    // Show custom modal with draft
    showDraftModal(draftMessage, shareUrl);
    incrementCounter('shareCount');
}



function showDraftModal(draftMessage, shareUrl) {
    // Remove existing modal if any
    const existingModal = document.getElementById('draftModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Enhanced professional draft message with formatting
    const formattedDraftMessage = `🎉 **Join Me in the Padosi Agent Referral Contest!** 🎉

*Exciting News!* I'm participating in the amazing **Padosi Agent Referral Contest** and you can too! 

🌟 **What is Padosi Agent?**
Padosi Agent is revolutionizing how we connect with local services and trusted providers in our neighborhood! 

🏆 **Contest Benefits:**
✅ Win Exclusive Prizes & Rewards
✅ Get Special Discounts on Services  
✅ Join a Trusted Community Network
✅ Earn While You Refer Friends

💫 **My Personal Referral Code:**
📱 Use Code: ****

🔗 **Join Now:**
Visit: https://padosiagent.com

Don't miss this opportunity to be part of something amazing! Let's grow together with Padosi Agent! 🚀

#PadosiAgent #ReferralContest #WinBig #CommunityFirst #LocalServices`;

    const modalHtml = `
        <div class="modal fade" id="draftModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary text-white">
                        <div class="d-flex align-items-center w-100">
                            <div class="me-3">
                                <div class="brand-logo">
                                    <i class="fas fa-handshake fa-2x"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="modal-title mb-0">🚀 Ready to Share & Win Big!</h5>
                                <small class="opacity-75">🧡 Say Thank You to Your Padosi</small>
                            </div>
                            <div class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>VIP CONTEST
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <div class="modal-body">
                        <!-- Success Header -->
                        <div class="text-center mb-4">
                            <div class="success-animation mb-3">
                                <div class="trophy-icon">
                                    <i class="fas fa-trophy text-warning fa-4x"></i>
                                </div>
                            </div>
                            <h4 class="text-success fw-bold">📸 Share Your 'Thank You PadosiMoment' 📸</h4>
                            <p class="text-muted">Top 3 participants with the Maximum Likes & Comments on their shared 'PadosiMoment' posts will win!</p>
                        </div>

                        <div class="row">
                            <!-- Left: Brand Highlight Section -->
                            <div class="col-md-5">
                                <div class="card border-primary brand-highlight-card h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0"><i class="fas fa-crown me-2"></i>🎊 Win Big Rewards! 🎊</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="brand-features">
                                            <div class="feature-item d-flex align-items-start mb-3">
                                                <div class="feature-icon me-3">
                                                    <i class="fas fa-shield-alt text-success fa-lg"></i>
                                                </div>
                                                <div>
                                                    <strong>💡 Boost your chances to WIN!</strong>
                                                    <p class="mb-0 small text-muted">Share your 'Thank You PadosiMoment' on Social Media to maximize your winning potential!</p>
                                                </div>
                                            </div>
                                            
                                            <div class="feature-item d-flex align-items-start mb-3">
                                                <div class="feature-icon me-3">
                                                    <i class="fas fa-bolt text-warning fa-lg"></i>
                                                </div>
                                                <div>
                                                    <strong>🏆 How Winners Are Selected:</strong>
                                                    <p class="mb-0 small text-muted">Top 3 participants with the Maximum Likes & Comments on their shared 'PadosiMoment' posts will win!</p>
                                                    <p class="mb-0 small text-muted">📱 Eligible platforms: Instagram, Facebook, Twitter</p>
                                                </div>
                                            </div>
                                            
                                            <div class="feature-item d-flex align-items-start mb-3">
                                                <div class="feature-icon me-3">
                                                    <i class="fas fa-gift text-danger fa-lg"></i>
                                                </div>
                                                <div>
                                                    <strong>🗓️ Winners Announcement: 1st December 2025</strong>                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="feature-item d-flex align-items-start">
                                                <div class="feature-icon me-3">
                                                    <i class="fas fa-users text-info fa-lg"></i>
                                                </div>
                                                <div>
                                                    <strong>Growing Network</strong>
                                                    <p class="mb-0 small text-muted">Join thousands of happy users</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="contest-highlights mt-4 p-3 bg-light rounded">
                                            <h6 class="mb-2"><i class="fas fa-award me-2 text-warning"></i>🎯 Pre-Launch Contest Prizes:</h6>
                                            <ul class="list-unstyled small mb-0">
                                                <li class="mb-1">🥇 <strong>Grand Prize:</strong> ₹1,00,000 of Shopping Voucher</li>
                                                <li class="mb-1">🥈 <strong>Runner-up:</strong> 50,000 of Shopping Voucher</li>
                                                <li>🥉 <strong>3rd-Prizes:</strong> 25,000 of Shopping Voucher </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Message Preview Section -->
                            <div class="col-md-7">
                                <div class="card border-warning preview-card h-100">
                                    <div class="card-header bg-warning text-dark">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="fas fa-eye me-2"></i>Post Preview</h6>
                                            <span class="badge bg-dark">SOCIAL MEDIA OPTIMIZED</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Professional Facebook-style Preview -->
                                        <div class="facebook-post-preview professional">
                                            <div class="post-header d-flex align-items-center mb-3">
                                                <div class="user-avatar me-3">
                                                    <div class="avatar-circle bg-primary">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="user-info">
                                                    <strong>Your Facebook Profile</strong>
                                                    <div class="text-muted small">
                                                        <span>Just now • </span>
                                                        <i class="fas fa-globe-americas text-muted"></i>
                                                        <span> Public</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="post-content">
                                                <p class="mb-2">🎉 <strong>Join Me in the Padosi Agent Referral Contest!</strong> 🎉</p>
                                                
                                                <p class="mb-2"><em>Exciting News!</em> I'm participating in the amazing <strong>Padosi Agent Referral Contest</strong> and you can too!</p>
                                                
                                                <div class="brand-section mb-3 p-2 bg-light rounded">
                                                    <p class="mb-1"><strong>🌟 What is Padosi Agent?</strong></p>
                                                    <p class="mb-0 small">Padosi Agent is revolutionizing how we connect with local services and trusted providers in our neighborhood!</p>
                                                </div>
                                                
                                                <div class="benefits-section mb-3">
                                                    <p class="mb-1"><strong>🏆 Contest Benefits:</strong></p>
                                                    <ul class="small mb-2">
                                                        <li>✅ <strong>Win Exclusive Prizes & Rewards</strong></li>
                                                        <li>✅ <strong>Get Special Discounts on Services</strong></li>
                                                        <li>✅ <strong>Join a Trusted Community Network</strong></li>
                                                        <li>✅ <strong>Earn While You Refer Friends</strong></li>
                                                    </ul>
                                                </div>
                                                
                                                <div class="referral-section mb-3 p-3 bg-success bg-opacity-10 rounded">
                                                    <p class="mb-1"><strong>💫 My Personal Referral Code:</strong></p>
                                                    <p class="mb-1">📱 Use Code: <strong class="text-primary">$referral_code</strong></p>
                                                </div>
                                                
                                                <p class="mb-2"><strong>🔗 Join Now:</strong></p>
                                                <p class="mb-2">Visit: <strong>https://padosiagent.com</strong></p>
                                                
                                                <p class="mb-2"><em>Don't miss this opportunity to be part of something amazing! Let's grow together with Padosi Agent!</em> 🚀</p>
                                                
                                                <div class="hashtags mt-2">
                                                    <span class="badge bg-primary me-1">#PadosiAgent</span>
                                                    <span class="badge bg-success me-1">#ReferralContest</span>
                                                    <span class="badge bg-warning me-1">#WinBig</span>
                                                    <span class="badge bg-info me-1">#CommunityFirst</span>
                                                    <span class="badge bg-danger">#LocalServices</span>
                                                </div>
                                            </div>
                                            
                                            <div class="post-engagement mt-3 pt-3 border-top">
                                                <div class="engagement-stats d-flex justify-content-between text-muted small mb-2">
                                                    <span>👍 1.2K</span>
                                                    <span>💬 248</span>
                                                    <span>🔄 567</span>
                                                </div>
                                                <div class="engagement-actions d-flex text-muted small">
                                                    <div class="flex-fill text-center">
                                                        <i class="fas fa-thumbs-up me-1"></i> Like
                                                    </div>
                                                    <div class="flex-fill text-center">
                                                        <i class="fas fa-comment me-1"></i> Comment
                                                    </div>
                                                    <div class="flex-fill text-center">
                                                        <i class="fas fa-share me-1"></i> Share
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Copy Section -->
                        <div class="mt-4">
                            <div class="section-header d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label mb-0">
                                    <strong><i class="fas fa-edit me-2 text-primary"></i>⚠️ Important: You must follow our official pages on Facebook and Instagram to participate. Twitter and LinkedIn are optional.</strong>
                                </label>
                                <span class="badge bg-success">
                                    <i class="fas fa-magic me-1"></i>Ready To Win</span>
                            </div>
                            
                            <div class="copy-container">
                                <div class="input-group input-group-lg">
                                    <textarea id="draftText" class="form-control professional-textarea" rows="5" readonly>${formattedDraftMessage}</textarea>
                                    <button class="btn btn-primary" type="button" id="manualCopyBtn">
                                        <i class="fas fa-copy me-2"></i>Copy Text
                                    </button>
                                </div>
                                <div class="form-text mt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-info-circle text-primary me-1"></i>
                                            <span id="copyStatus">Click "Copy & Open Facebook" below - we'll auto-copy this professional message!</span>
                                        </div>
                                        <div class="text-muted small">
                                            <i class="fas fa-chart-line me-1"></i>
                                            High Engagement Format
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Maybe Later
                        </button>
                        <button type="button" class="btn btn-success btn-lg px-4 shadow" id="openFacebookBtn">
                            <i class="fas fa-rocket me-2"></i>🚀 Copy & Open Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            .bg-gradient-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            }
            
            .brand-highlight-card {
                border-left: 4px solid #007bff;
            }
            
            .preview-card {
                border-left: 4px solid #ffc107;
            }
            
            .professional-textarea {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.6;
                font-size: 14px;
                border: 2px solid #e9ecef;
                border-radius: 8px;
            }
            
            .professional-textarea:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }
            
            .facebook-post-preview.professional {
                background: #fff;
                border: 1px solid #dddfe2;
                border-radius: 12px;
                padding: 16px;
                font-family: system-ui, -apple-system, sans-serif;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            .avatar-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .feature-icon {
                width: 24px;
                text-align: center;
            }
            
            .brand-features .feature-item {
                padding: 8px 0;
                border-bottom: 1px solid #f8f9fa;
            }
            
            .brand-features .feature-item:last-child {
                border-bottom: none;
            }
            
            .contest-highlights {
                border-left: 3px solid #ffc107;
            }
            
            .referral-section {
                border-left: 3px solid #28a745;
            }
            
            .brand-section {
                border-left: 3px solid #007bff;
            }
            
            .hashtags .badge {
                font-size: 0.7em;
                margin-bottom: 2px;
            }
            
            .post-engagement {
                background: #f8f9fa;
                margin: 0 -16px -16px -16px;
                padding: 12px 16px;
                border-bottom-left-radius: 12px;
                border-bottom-right-radius: 12px;
            }
            
            .trophy-icon {
                position: relative;
                display: inline-block;
            }
            
            .trophy-icon:before {
                content: '';
                position: absolute;
                top: -5px;
                left: -5px;
                right: -5px;
                bottom: -5px;
                background: radial-gradient(circle, rgba(255,215,0,0.3) 0%, rgba(255,215,0,0) 70%);
                border-radius: 50%;
                animation: pulse-gold 2s infinite;
            }
            
            @keyframes pulse-gold {
                0% { transform: scale(1); opacity: 0.5; }
                50% { transform: scale(1.1); opacity: 0.8; }
                100% { transform: scale(1); opacity: 0.5; }
            }
            
            .success-animation {
                animation: bounceIn 0.6s ease-in-out;
            }
            
            @keyframes bounceIn {
                0% { transform: scale(0.3); opacity: 0; }
                50% { transform: scale(1.05); opacity: 1; }
                100% { transform: scale(1); opacity: 1; }
            }
            
            .section-header {
                padding-bottom: 8px;
                border-bottom: 2px solid #f8f9fa;
            }
            
            .copy-container {
                position: relative;
            }
            
            .professional-textarea {
                background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            }
        </style>
    `;
    
    // Add modal to page
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Add event listeners after modal is created
    setTimeout(() => {
        const manualCopyBtn = document.getElementById('manualCopyBtn');
        const openFacebookBtn = document.getElementById('openFacebookBtn');
        
        if (manualCopyBtn) {
            manualCopyBtn.addEventListener('click', function() {
                copyToClipboard(formattedDraftMessage, true);
            });
        }
        
        if (openFacebookBtn) {
            openFacebookBtn.addEventListener('click', function() {
                // First copy the text, then open Facebook
                copyToClipboard(formattedDraftMessage, false).then(() => {
                    openFacebook(shareUrl);
                }).catch(() => {
                    // If copy fails, still open Facebook but show manual instructions
                    openFacebook(shareUrl);
                });
            });
        }
        
    }, 100);
    
    // Show modal
    const modalElement = document.getElementById('draftModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
    
    // Clean up modal when hidden
    modalElement.addEventListener('hidden.bs.modal', function () {
        modalElement.remove();
    });
}

// function showDraftModal(draftMessage, shareUrl) {
//     // Remove existing modal if any
//     const existingModal = document.getElementById('draftModal');
//     if (existingModal) {
//         existingModal.remove();
//     }
    
//     const modalHtml = `
//         <div class="modal fade" id="draftModal" tabindex="-1">
//             <div class="modal-dialog modal-lg">
//                 <div class="modal-content">
//                     <div class="modal-header bg-primary text-white">
//                         <div class="d-flex align-items-center">
//                             <div class="me-3">
//                                 <i class="fas fa-share-alt fa-2x"></i>
//                             </div>
//                             <div>
//                                 <h5 class="modal-title mb-0">🎯 Ready to Share & Win!</h5>
//                                 <small class="opacity-75">Your contest post is ready to go viral</small>
//                             </div>
//                         </div>
//                         <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
//                     </div>
                    
//                     <div class="modal-body">
//                         <!-- Success Header -->
//                         <div class="text-center mb-4">
//                             <div class="success-animation mb-3">
//                                 <i class="fas fa-check-circle text-success fa-4x"></i>
//                             </div>
//                             <h4 class="text-success">✅ Your Draft is Ready!</h4>
//                             <p class="text-muted">We've prepared the perfect post for maximum engagement</p>
//                         </div>

//                         <div class="row">
//                             <!-- Left: Preview Section -->
//                             <div class="col-md-6">
//                                 <div class="card border-primary">
//                                     <div class="card-header bg-light">
//                                         <h6 class="mb-0">📝 Your Post Preview</h6>
//                                     </div>
//                                     <div class="card-body">
//                                         <!-- Facebook-style Post Preview -->
//                                         <div class="facebook-post-preview">
//                                             <div class="d-flex align-items-center mb-3">
//                                                 <div class="user-avatar me-3">
//                                                     <i class="fas fa-user-circle text-primary fa-2x"></i>
//                                                 </div>
//                                                 <div>
//                                                     <strong>Your Facebook Post</strong>
//                                                     <div class="text-muted small">Just now • 🌍</div>
//                                                 </div>
//                                             </div>
//                                             <div class="post-content">
//                                                 <p class="mb-2">${draftMessage.split('\n')[0]}</p>
//                                                 <p class="mb-2 text-muted">${draftMessage.split('\n').slice(1).join('<br>')}</p>
//                                             </div>
//                                             <div class="post-image mt-2">
//                                                 <div class="contest-banner-preview">
//                                                     <i class="fas fa-image text-center text-muted d-block mb-1 fa-2x"></i>
//                                                     <small class="text-center d-block text-muted">Contest Banner Image</small>
//                                                 </div>
//                                             </div>
//                                             <div class="post-actions mt-3 pt-2 border-top">
//                                                 <div class="d-flex text-muted small">
//                                                     <div class="me-3">
//                                                         <i class="fas fa-thumbs-up"></i> Like
//                                                     </div>
//                                                     <div class="me-3">
//                                                         <i class="fas fa-comment"></i> Comment
//                                                     </div>
//                                                     <div>
//                                                         <i class="fas fa-share"></i> Share
//                                                     </div>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>

//                             <!-- Right: Instructions Section -->
//                             <div class="col-md-6">
//                                 <div class="card border-warning">
//                                     <div class="card-header bg-warning text-dark">
//                                         <h6 class="mb-0">🚀 One-Click Sharing</h6>
//                                     </div>
//                                     <div class="card-body">
//                                         <div class="step-by-step-guide">
//                                             <div class="step-item d-flex align-items-start mb-3">
//                                                 <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">
//                                                     1
//                                                 </div>
//                                                 <div>
//                                                     <strong>Click "Open Facebook"</strong>
//                                                     <p class="mb-0 text-muted small">We'll automatically copy your text</p>
//                                                 </div>
//                                             </div>
                                            
//                                             <div class="step-item d-flex align-items-start mb-3">
//                                                 <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">
//                                                     2
//                                                 </div>
//                                                 <div>
//                                                     <strong>Paste in Facebook</strong>
//                                                     <p class="mb-0 text-muted small">Just paste (Ctrl+V) in the post box</p>
//                                                 </div>
//                                             </div>
                                            
//                                             <div class="step-item d-flex align-items-start mb-3">
//                                                 <div class="step-number bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">
//                                                     3
//                                                 </div>
//                                                 <div>
//                                                     <strong>Post & Win!</strong>
//                                                     <p class="mb-0 text-muted small">Share and you're in the contest!</p>
//                                                 </div>
//                                             </div>
//                                         </div>

//                                         <!-- Benefits Section -->
//                                         <div class="benefits-section mt-3 p-3 bg-light rounded">
//                                             <h6 class="mb-2">🎁 What You Get:</h6>
//                                             <ul class="list-unstyled small mb-0">
//                                                 <li class="mb-1">✅ <strong>Contest Entry</strong> - You're officially participating</li>
//                                                 <li class="mb-1">✅ <strong>Referral Rewards</strong> - Earn when friends join</li>
//                                                 <li class="mb-1">✅ <strong>Viral Reach</strong> - More shares = more chances to win</li>
//                                                 <li>✅ <strong>Exclusive Offers</strong> - Special prizes for active participants</li>
//                                             </ul>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>

//                         <!-- Copy Section -->
//                         <div class="mt-4">
//                             <label class="form-label"><strong>📋 Your Contest Message:</strong></label>
//                             <div class="input-group">
//                                 <textarea id="draftText" class="form-control" rows="4" readonly>${draftMessage}</textarea>
//                                 <button class="btn btn-outline-primary" type="button" id="manualCopyBtn">
//                                     <i class="fas fa-copy me-2"></i>Copy Text
//                                 </button>
//                             </div>
//                             <div class="form-text">
//                                 <i class="fas fa-info-circle text-primary me-1"></i>
//                                 <span id="copyStatus">Click "Open Facebook" below - we'll auto-copy the text!</span>
//                             </div>
//                         </div>
//                     </div>
                    
//                     <div class="modal-footer bg-light">
//                         <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
//                             <i class="fas fa-times me-2"></i>Maybe Later
//                         </button>
//                         <button type="button" class="btn btn-success btn-lg px-4" id="openFacebookBtn">
//                             <i class="fas fa-rocket me-2"></i>🚀 Copy & Open Facebook
//                         </button>
//                     </div>
//                 </div>
//             </div>
//         </div>
        
//         <style>
//             .facebook-post-preview {
//                 background: #fff;
//                 border: 1px solid #dddfe2;
//                 border-radius: 8px;
//                 padding: 12px;
//                 font-family: system-ui, -apple-system, sans-serif;
//             }
//             .contest-banner-preview {
//                 background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
//                 border-radius: 8px;
//                 padding: 20px;
//                 text-align: center;
//                 color: white;
//             }
//             .step-number {
//                 font-weight: bold;
//                 font-size: 14px;
//             }
//             .success-animation {
//                 animation: bounceIn 0.6s ease-in-out;
//             }
//             @keyframes bounceIn {
//                 0% { transform: scale(0.3); opacity: 0; }
//                 50% { transform: scale(1.05); opacity: 1; }
//                 100% { transform: scale(1); opacity: 1; }
//             }
//             .benefits-section {
//                 border-left: 4px solid #28a745;
//             }
//             #draftText {
//                 font-family: system-ui, -apple-system, sans-serif;
//                 line-height: 1.4;
//             }
//             .copy-pulse {
//                 animation: pulse 0.5s ease-in-out;
//             }
//             @keyframes pulse {
//                 0% { transform: scale(1); }
//                 50% { transform: scale(1.02); }
//                 100% { transform: scale(1); }
//             }
//         </style>
//     `;
    
//     // Add modal to page
//     document.body.insertAdjacentHTML('beforeend', modalHtml);
    
//     // Add event listeners after modal is created
//     setTimeout(() => {
//         const manualCopyBtn = document.getElementById('manualCopyBtn');
//         const openFacebookBtn = document.getElementById('openFacebookBtn');
        
//         if (manualCopyBtn) {
//             manualCopyBtn.addEventListener('click', function() {
//                 copyToClipboard(draftMessage, true);
//             });
//         }
        
//         if (openFacebookBtn) {
//             openFacebookBtn.addEventListener('click', function() {
//                 // First copy the text, then open Facebook
//                 copyToClipboard(draftMessage, false).then(() => {
//                     openFacebook(shareUrl);
//                 }).catch(() => {
//                     // If copy fails, still open Facebook but show manual instructions
//                     openFacebook(shareUrl);
//                 });
//             });
//         }
        
//     }, 100);
    
//     // Show modal
//     const modalElement = document.getElementById('draftModal');
//     const modal = new bootstrap.Modal(modalElement);
//     modal.show();
    
//     // Clean up modal when hidden
//     modalElement.addEventListener('hidden.bs.modal', function () {
//         modalElement.remove();
//     });
// }

// ENHANCED COPY FUNCTION THAT RETURNS PROMISE
function copyToClipboard(text, isManualCopy = false) {
    return new Promise((resolve, reject) => {
        const textarea = document.getElementById('draftText');
        const copyStatus = document.getElementById('copyStatus');
        const copyBtn = isManualCopy ? document.getElementById('manualCopyBtn') : document.getElementById('openFacebookBtn');
        
        // Store original button state
        const originalHtml = copyBtn.innerHTML;
        
        // Add visual feedback
        textarea.classList.add('copy-pulse');
        
        // Method 1: Modern Clipboard API (works in HTTPS and localhost)
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                showCopySuccess(copyBtn, copyStatus, textarea, isManualCopy);
                resolve(true);
                
                // Remove pulse animation
                setTimeout(() => {
                    textarea.classList.remove('copy-pulse');
                }, 500);
                
            }).catch(function(err) {
                // Fallback to method 2 if modern API fails
                console.log('Modern API failed, trying fallback:', err);
                const success = fallbackCopyText(text, copyBtn, copyStatus, textarea, isManualCopy);
                if (success) {
                    resolve(true);
                } else {
                    reject(false);
                }
            });
        } else {
            // Use fallback for HTTP or older browsers
            const success = fallbackCopyText(text, copyBtn, copyStatus, textarea, isManualCopy);
            if (success) {
                resolve(true);
            } else {
                reject(false);
            }
        }
    });
}

// FALLBACK COPY METHODS
function fallbackCopyText(text, copyBtn, copyStatus, textarea, isManualCopy) {
    // Method 2: Select and copy using execCommand
    textarea.select();
    textarea.setSelectionRange(0, 99999); // For mobile devices
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showCopySuccess(copyBtn, copyStatus, textarea, isManualCopy);
            return true;
        } else {
            showCopyManual(text, copyBtn, copyStatus, isManualCopy);
            return false;
        }
    } catch (err) {
        // Method 3: Show text for manual copy
        console.log('execCommand failed:', err);
        showCopyManual(text, copyBtn, copyStatus, isManualCopy);
        return false;
    }
}

// SHOW SUCCESS STATE
function showCopySuccess(copyBtn, copyStatus, textarea, isManualCopy) {
    if (isManualCopy) {
        // Update manual copy button
        copyBtn.innerHTML = '<i class="fas fa-check me-2"></i>✅ Copied!';
        copyBtn.classList.remove('btn-outline-primary');
        copyBtn.classList.add('btn-success');
        
        // Update status text
        copyStatus.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i>Text copied to clipboard! Ready to share on Facebook.';
        copyStatus.classList.add('text-success');
        
        // Revert button after 3 seconds
        setTimeout(() => {
            copyBtn.innerHTML = '<i class="fas fa-copy me-2"></i>Copy Text';
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-outline-primary');
        }, 3000);
    } else {
        // Update main Facebook button temporarily
        const originalHtml = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check me-2"></i>✅ Copied! Opening...';
        
        // Update status text
        copyStatus.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i>Text automatically copied! Opening Facebook...';
        copyStatus.classList.add('text-success');
        
        // Revert button text after 2 seconds (Facebook will be opening)
        setTimeout(() => {
            copyBtn.innerHTML = originalHtml;
        }, 2000);
    }
    
    // Highlight textarea
    textarea.classList.add('border-success', 'bg-success', 'bg-opacity-10');
    
    // Remove highlight after 5 seconds
    setTimeout(() => {
        textarea.classList.remove('border-success', 'bg-success', 'bg-opacity-10');
    }, 5000);
}

// SHOW MANUAL COPY INSTRUCTIONS
function showCopyManual(text, copyBtn, copyStatus, isManualCopy) {
    // Select the text for manual copying
    const textarea = document.getElementById('draftText');
    textarea.select();
    textarea.setSelectionRange(0, 99999);
    
    if (isManualCopy) {
        // Update instructions for manual copy
        copyStatus.innerHTML = `
            <div class="alert alert-warning p-2 mb-0">
                <i class="fas fa-mouse-pointer me-2"></i>
                <strong>Manual Copy Required:</strong> Text is selected. Press 
                <kbd>Ctrl+C</kbd> (Windows) or <kbd>Cmd+C</kbd> (Mac) to copy
            </div>
        `;
        
        // Update button
        copyBtn.innerHTML = '<i class="fas fa-mouse-pointer me-2"></i>Text Selected';
        copyBtn.classList.remove('btn-outline-primary');
        copyBtn.classList.add('btn-warning');
        
        // Revert after 5 seconds
        setTimeout(() => {
            copyBtn.innerHTML = '<i class="fas fa-copy me-2"></i>Copy Text';
            copyBtn.classList.remove('btn-warning');
            copyBtn.classList.add('btn-outline-primary');
        }, 5000);
    } else {
        // For main button, show different message but still proceed
        copyStatus.innerHTML = `
            <div class="alert alert-info p-2 mb-0">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Text Selected:</strong> Opening Facebook. Press <kbd>Ctrl+V</kbd> to paste in Facebook.
            </div>
        `;
    }
    
    // Show temporary highlight
    textarea.classList.add('border-warning', 'bg-warning', 'bg-opacity-10');
    
    // Remove highlight after 5 seconds
    setTimeout(() => {
        textarea.classList.remove('border-warning', 'bg-warning', 'bg-opacity-10');
    }, 5000);
}

// OPEN FACEBOOK FUNCTION WITH AUTO-CLOSE DETECTION
function openFacebook(shareUrl) {
    const copyStatus = document.getElementById('copyStatus');
    const openBtn = document.getElementById('openFacebookBtn');
    
    // Store original state
    const originalHtml = openBtn.innerHTML;
    
    // Update button to show loading state
    openBtn.innerHTML = '<i class="fas fa-external-link-alt me-2"></i>🌐 Opening Facebook...';
    openBtn.disabled = true;
    
    // Generate unique session ID for this sharing attempt
    const sessionId = 'fb_share_' + Date.now();
    localStorage.setItem('facebook_share_session', sessionId);
    localStorage.setItem('facebook_share_start', Date.now().toString());
    
    // Open Facebook in new tab
    const facebookWindow = window.open(shareUrl, 'facebook_share_window', 'width=600,height=700,scrollbars=yes');
    
    // Start monitoring for post completion
    startPostMonitoring(sessionId, facebookWindow);
    
    // Show next steps modal
    setTimeout(() => {
        showNextStepsModal(sessionId);
    }, 1000);
    
    // Revert button after 3 seconds
    setTimeout(() => {
        openBtn.innerHTML = originalHtml;
        openBtn.disabled = false;
    }, 3000);
}

// MONITOR FOR POST COMPLETION
function startPostMonitoring(sessionId, facebookWindow) {
    let checkCount = 0;
    const maxChecks = 60; // Check for 5 minutes (60 * 5 seconds)
    
    const checkInterval = setInterval(() => {
        checkCount++;
        
        // Check if user confirmed they posted
        const userConfirmed = localStorage.getItem('facebook_post_confirmed');
        const shareCompleted = localStorage.getItem('facebook_share_completed');
        
        if (userConfirmed === 'true' || shareCompleted === 'true') {
            // User has posted!
            clearInterval(checkInterval);
            closeAllModals();
            showSuccessCelebration();
            localStorage.removeItem('facebook_post_confirmed');
            localStorage.removeItem('facebook_share_completed');
            return;
        }
        
        // Check if Facebook window was closed (user might have posted)
        if (facebookWindow && facebookWindow.closed) {
            clearInterval(checkInterval);
            
            // If window closed and enough time passed, assume they posted
            const shareStart = parseInt(localStorage.getItem('facebook_share_start'));
            const timeElapsed = Date.now() - shareStart;
            
            if (timeElapsed > 30000) { // If window was open for more than 30 seconds
                showPostCompletionModal();
            }
            return;
        }
        
        // Stop checking after max attempts
        if (checkCount >= maxChecks) {
            clearInterval(checkInterval);
            showReminderModal();
        }
    }, 5000); // Check every 5 seconds
}

// CLOSE ALL MODALS FUNCTION
function closeAllModals() {
    // Close all Bootstrap modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) {
            bsModal.hide();
        }
        modal.remove();
    });
    
    // Remove modal backdrops
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => {
        backdrop.remove();
    });
    
    // Reset body classes
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
}

// UPDATED NEXT STEPS MODAL WITH POST CONFIRMATION
function showNextStepsModal(sessionId) {
    const nextStepsHtml = `
        <div class="modal fade" id="nextStepsModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">📋 Almost Done!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-paste fa-3x text-info mb-2"></i>
                            <h5 class="text-success">✅ Text Copied Successfully!</h5>
                        </div>
                        
                        <div class="steps-container">
                            <div class="step-card p-3 mb-3 border-start border-4 border-primary bg-light">
                                <h6 class="mb-2">1. <strong>PASTE</strong> in Facebook</h6>
                                <p class="mb-0 small text-muted">Press <kbd>Ctrl+V</kbd> in the Facebook post box</p>
                            </div>
                            
                            <div class="step-card p-3 mb-3 border-start border-4 border-success bg-light">
                                <h6 class="mb-2">2. <strong>POST</strong> to Your Timeline</h6>
                                <p class="mb-0 small text-muted">Click POST to share with friends</p>
                            </div>
                            
                            <div class="step-card p-3 border-start border-4 border-warning bg-light">
                                <h6 class="mb-2">3. <strong>CONFIRM</strong> You Posted</h6>
                                <p class="mb-0 small text-muted">Return here and click the button below</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-success mt-3">
                            <i class="fas fa-clipboard-check me-2"></i>
                            <strong>Your text is ready to paste!</strong> The contest message has been copied.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="button" class="btn btn-success" id="confirmPostBtn">
                            <i class="fas fa-check me-2"></i>I've Posted on Facebook!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', nextStepsHtml);
    const modal = new bootstrap.Modal(document.getElementById('nextStepsModal'));
    modal.show();
    
    // Add event listener for confirmation button
    setTimeout(() => {
        const confirmBtn = document.getElementById('confirmPostBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                localStorage.setItem('facebook_post_confirmed', 'true');
                closeAllModals();
                showSuccessCelebration();
            });
        }
    }, 100);
    
    // Auto-close after 2 minutes
    setTimeout(() => {
        if (document.getElementById('nextStepsModal')) {
            modal.hide();
            showReminderModal();
        }
    }, 120000);
}

// SUCCESS CELEBRATION
function showSuccessCelebration() {
    const successHtml = `
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center py-5">
                        <div class="success-animation mb-3">
                            <i class="fas fa-trophy text-warning fa-4x"></i>
                        </div>
                        <h4 class="text-success mb-3">🎉 Congratulations!</h4>
                        <p class="mb-3">You've successfully entered the contest!</p>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Your entry is now under verification
                        </div>
                        <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal">
                            Continue
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes confettiRain {
                0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
                100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
            }
            .confetti {
                position: fixed;
                width: 10px;
                height: 10px;
                background: #ff0000;
                animation: confettiRain 5s linear infinite;
                z-index: 9999;
            }
        </style>
    `;
    
    document.body.insertAdjacentHTML('beforeend', successHtml);
    const modal = new bootstrap.Modal(document.getElementById('successModal'));
    modal.show();
    
    // Add confetti effect
    createConfetti();
    
    // Auto-close after 5 seconds
    setTimeout(() => {
        modal.hide();
    }, 5000);
}

// REMINDER MODAL
function showReminderModal() {
    const reminderHtml = `
        <div class="modal fade" id="reminderModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">🤔 Still Sharing?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Haven't finished sharing on Facebook yet?</p>
                        <div class="alert alert-info">
                            <strong>Don't forget:</strong> You need to post on Facebook to enter the contest!
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success" id="yesPostedBtn">
                                ✅ Yes, I Posted Successfully!
                            </button>
                            <button type="button" class="btn btn-primary" id="retryShareBtn">
                                🔄 Reopen Facebook
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                ⏰ I'll Do It Later
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', reminderHtml);
    const modal = new bootstrap.Modal(document.getElementById('reminderModal'));
    modal.show();
    
    // Add event listeners
    setTimeout(() => {
        const yesPostedBtn = document.getElementById('yesPostedBtn');
        const retryShareBtn = document.getElementById('retryShareBtn');
        
        if (yesPostedBtn) {
            yesPostedBtn.addEventListener('click', function() {
                localStorage.setItem('facebook_post_confirmed', 'true');
                closeAllModals();
                showSuccessCelebration();
            });
        }
        
        if (retryShareBtn) {
            retryShareBtn.addEventListener('click', function() {
                closeAllModals();
                // Reopen Facebook
                window.open('https://facebook.com', 'facebook_share_window', 'width=600,height=700,scrollbars=yes');
                showNextStepsModal();
            });
        }
    }, 100);
}

// POST COMPLETION DETECTION MODAL
function showPostCompletionModal() {
    const completionHtml = `
        <div class="modal fade" id="completionModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">✅ Post Complete?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                        <h5>Did you successfully post on Facebook?</h5>
                        <p class="text-muted">We noticed you spent some time on Facebook. Was your post successful?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="postSuccessBtn">
                            👍 Yes, I Posted Successfully!
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            👎 No, I'll Try Again
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', completionHtml);
    const modal = new bootstrap.Modal(document.getElementById('completionModal'));
    modal.show();
    
    setTimeout(() => {
        const successBtn = document.getElementById('postSuccessBtn');
        if (successBtn) {
            successBtn.addEventListener('click', function() {
                localStorage.setItem('facebook_post_confirmed', 'true');
                closeAllModals();
                showSuccessCelebration();
            });
        }
    }, 100);
}

// CONFETTI EFFECT
function createConfetti() {
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
    for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.animationDelay = Math.random() * 5 + 's';
        document.body.appendChild(confetti);
        
        // Remove confetti after animation
        setTimeout(() => {
            confetti.remove();
        }, 5000);
    }
}

// UPDATE THE MAIN DRAFT MODAL CLOSE BUTTON
// Add this to your existing showDraftModal function:
function updateDraftModalClose() {
    const closeBtn = document.querySelector('[data-bs-dismiss="modal"]');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            // Set a flag that user might come back later
            localStorage.setItem('facebook_share_pending', 'true');
        });
    }
}





//Used in FB POST
// function showDraftModal(draftMessage, shareUrl) {
//     // Remove existing modal if any
//     const existingModal = document.getElementById('draftModal');
//     if (existingModal) {
//         existingModal.remove();
//     }
    
//     const modalHtml = `
//         <div class="modal fade" id="draftModal" tabindex="-1">
//             <div class="modal-dialog">
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h5 class="modal-title">Share on Facebook</h5>
//                         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
//                     </div>
//                     <div class="modal-body">
//                         <p class="text-success">✅ Draft ready! Here's how to share:</p>
//                         <div class="mb-3">
//                             <label class="form-label">Your message (will be copied to clipboard):</label>
//                             <textarea id="draftText" class="form-control" rows="4" readonly>${draftMessage}</textarea>
//                         </div>
//                         <ol>
//                             <li>Click "Copy & Open Facebook"</li>
//                             <li>We'll open Facebook in a new tab</li>
//                             <li>Paste the message in the post composer</li>
//                             <li>Click Post to share!</li>
//                         </ol>
//                     </div>
//                     <div class="modal-footer">
//                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
//                         <button type="button" class="btn btn-primary" id="copyAndOpenBtn">
//                             📋 Copy & Open Facebook
//                         </button>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `;
    
//     // Add modal to page
//     document.body.insertAdjacentHTML('beforeend', modalHtml);
    
//     // Add event listener after modal is created
//     setTimeout(() => {
//         const copyBtn = document.getElementById('copyAndOpenBtn');
//         if (copyBtn) {
//             copyBtn.addEventListener('click', function() {
//                 copyAndOpenFacebook(draftMessage);
//             });
//         }
//     }, 100);
    
//     // Show modal
//     const modalElement = document.getElementById('draftModal');
//     const modal = new bootstrap.Modal(modalElement);
//     modal.show();
    
//     // Clean up modal when hidden
//     modalElement.addEventListener('hidden.bs.modal', function () {
//         modalElement.remove();
//     });
// }

// function copyAndOpenFacebook(draftMessage) {
//     navigator.clipboard.writeText(draftMessage).then(() => {
//         // Close modal
//         const modalElement = document.getElementById('draftModal');
//         if (modalElement) {
//             const modal = bootstrap.Modal.getInstance(modalElement);
//             if (modal) {
//                 modal.hide();
//             }
//             modalElement.remove();
//         }
        
//         // Show success message
//         showAlert('✅ Draft copied to clipboard! Opening Facebook...', 'success');
        
//         // Open Facebook - this will take users to their Facebook homepage
//         // They need to manually click "Create Post" and paste the content
//         setTimeout(() => {
//             window.open('https://www.facebook.com/sharer/sharer.php?u=https://www.facebook.com/profile.php?id=61570016781365', '_blank', 'width=800,height=600');
//         }, 500);
        
//     }).catch(err => {
//         console.error('Clipboard error:', err);
//         showAlert('❌ Failed to copy draft. Please copy manually from the text area.', 'error');
//     });
// }
// Used------FB







// function shareOnFacebook() {
//     const popup = document.getElementById('successPopup');
//     if (!popup) return;
    
//     // Get share URL from data attribute or use fallback
//     let shareUrl = popup.getAttribute('data-share-url');
    
//     // If shareUrl is undefined, use a default URL
//     if (!shareUrl || shareUrl === 'undefined') {
//         shareUrl = window.location.origin + '/participants'; // Fallback URL
//         console.warn('Share URL was undefined, using fallback:', shareUrl);
//     }
    
//     console.log('Sharing URL:', shareUrl); // Debug log
    
//     const shareText = "Just joined PadosiAgent! 🎉 Connect with Insurance Agents, Mutual Fund Agents, CAs, Lawyers and find trusted professionals near you! #PadosiAgent #InsuranceAgent #MutualFundAgent #CA #Lawyer #FindNearBy @padosiagent";
    
//     const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}&quote=${encodeURIComponent(shareText)}`;
    
//     window.open(facebookShareUrl, 'facebook-share', 'width=600,height=400');
//     incrementCounter('shareCount');
// }

// Update showSuccessPopup to ensure share URL is set
function showSuccessPopup(shareUrl, participant) {
    const popup = document.getElementById('successPopup');
    if (!popup) return;
    
    console.log('Received shareUrl:', shareUrl); // Debug log
    
    // Validate and set share URL
    if (!shareUrl || shareUrl === 'undefined') {
        shareUrl = window.location.origin + '/participants/welcome'; // Fallback
    }
    
    popup.setAttribute('data-share-url', shareUrl);
    popup.setAttribute('data-participant-id', participant.id);
    
    popup.style.display = 'flex';
    
    // Update counters
    if (document.getElementById('shareCount')) {
        animateCounter('shareCount', 0, Math.floor(Math.random() * 50) + 10, 2000);
    }
    if (document.getElementById('friendCount')) {
        animateCounter('friendCount', 0, Math.floor(Math.random() * 20) + 5, 2500);
    }
}

function copyShareLink() {
    const popup = document.getElementById('successPopup');
    if (!popup) return;
    
    const shareUrl = popup.getAttribute('data-share-url') || window.location.href;
    
    navigator.clipboard.writeText(shareUrl).then(() => {
        const copyBtn = document.querySelector('.copy-link-btn');
        if (copyBtn) {
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '✓ Link Copied!';
            copyBtn.style.borderColor = '#10B981';
            copyBtn.style.color = '#10B981';
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.style.borderColor = '#E5E7EB';
                copyBtn.style.color = '#374151';
            }, 2000);
        }
    }).catch(err => {
        console.error('Failed to copy link:', err);
    });
}

function incrementCounter(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        const current = parseInt(element.textContent) || 0;
        element.textContent = current + 1;
    }
}

function closeSuccessPopup() {
    const popup = document.getElementById('successPopup');
    if (popup) {
        popup.style.display = 'none';
    }
}

function viewDashboard() {
    window.location.href = '/dashboard';
}

// Email validation function
function isValidEmail(email) {
    //alert(email);
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// // Real-time email validation
// document.querySelector('input[name="email"]').addEventListener('blur', function() {
//     const email = this.value.trim();
//     if (email && !isValidEmail(email)) {
//         showAlert('Please provide a valid email address.', 'error');
//         highlightInvalidField('input[name="email"]');
//     }
// });
</script>
</body>

</html>