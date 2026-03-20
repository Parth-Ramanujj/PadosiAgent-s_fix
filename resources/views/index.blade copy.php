@extends('layouts.app')

@section('content')
<div class="family_banner_outer home-page-banner position-relative">
    @include('layouts.header')

    <section class="top-text-section position-relative">
        <h2 class="banner-top-title">Find <span class="trusted">Trusted & Licensed</span> Insurance Agents in your <span class="padosi">"Padosi"</span></h2>         
    </section>

    <!-- Banner -->
    <section class="banner-con position-relative">
        
        <div class="banner-top-text-block">
            <div class="banner-top-text-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big h-3 w-3 sm:h-3.5 sm:w-3.5 md:h-4 md:w-4 text-secondary flex-shrink-0" aria-hidden="true"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                IRDA Verified
            </div>
            <div class="banner-top-text-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-3 w-3 sm:h-3.5 sm:w-3.5 md:h-4 md:w-4 text-secondary flex-shrink-0" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                No Spam Calls
            </div>
            <div class="banner-top-text-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-3 w-3 sm:h-3.5 sm:w-3.5 md:h-4 md:w-4 text-secondary flex-shrink-0" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                100% Free
            </div>
        </div>


        <div id="homebanner" class="carousel" data-ride="carousel" data-aos="fade-up">
            <div class="text-center position-relative fadeOut owl-carousel">
                <!-- <div class="carousel-inner"> -->
                <div class="item active">
                    <!-- <div class="container"> -->
                    <div class="row new-policies-banner-outer">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-left-img responive-banner-img1">
                            <div class="banner_content" data-aos="fade-up">
                                <h1 class="text-white">New Policy</h1>
                                <p class="text-white text-size-18">Buy, Port or Renew your insurance policy with
                                    trusted agents</p>
                                <div class="button_wrapper">
                                    <a href="{{ url('/contact') }}" class="text-decoration-none all_button get_started">Get
                                        Started</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-right-img banner-new-policy">
                            <div class="banner_wrapper position-relative">
                                <!-- <figure class="icon banner-icon1 mb-0">
                                        <img src="{{ asset('img/banner-icon1.png') }}" alt="image" class="img-fluid">
                                    </figure> -->
                                <figure class="icon banner-icon2 mb-0">
                                    <img src="{{ asset('img/banner-icon2.png') }}" alt="image" class="img-fluid">
                                </figure>
                                
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="item">
                    <!-- <div class="container"> -->
                    <div class="row claim-assistance-banner-outer">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-left-img responive-banner-img2">
                            <div class="banner_content" data-aos="fade-up">
                                <!-- <h5 class="text-white">Welcome to the Insurerity</h5> -->
                                <h1 class="text-white">Claim Assistance</h1>
                                <p class="text-white text-size-18">Expert help with claim processing,
                                    settlements and disputes</p>
                                <div class="button_wrapper">
                                    
                                    <a href="#" class="text-decoration-none all_button get_started">Get Help</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-right-img banner-claim-assistance">
                            <div class="banner_wrapper position-relative">
                               
                                <figure class="icon banner-icon2 mb-0">
                                    <img src="{{ asset('img/banner-icon2.png') }}" alt="image" class="img-fluid">
                                </figure>
                               
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="item">
                    <!-- <div class="container"> -->
                    <div class="row policy-review-banner-outer">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-left-img responive-banner-img3">
                            <div class="banner_content" data-aos="fade-up">
                                <!-- <h5 class="text-white">Welcome to the Insurerity</h5> -->
                                <h1 class="text-white">Policy Review</h1>
                                <p class="text-white text-size-18">Optimize your portfolio and maximize your
                                    coverage benefits</p>
                                <div class="button_wrapper">
                                   
                                    <a href="#" class="text-decoration-none all_button get_started">Review
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-right-img banner-policy-review">
                            <div class="banner_wrapper position-relative">
                               
                                <figure class="icon banner-icon2 mb-0">
                                    <img src="{{ asset('img/banner-icon2.png') }}" alt="image" class="img-fluid">
                                </figure>
                                
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <!-- </div> -->
                <!-- <div class="pagination_outer">
                    <button class="carousel-control-prev" type="button" data-target="#homebanner" data-slide="prev">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#homebanner" data-slide="next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div> -->

            </div>
        </div>

    </section>
</div>


<!-- New Policies We Cover -->
<section class="benefit-con new-policies-section position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                <div class="benefit_content" data-aos="fade-up">
                    <!-- <h6>What We Provide</h6> -->
                    <h2>New Policies We Cover</h2>
                    <p class="text text-size-18 mb-0">Click on a category to explore insurance types</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 col-12">

                <div class="benefit_wrapper position-relative" data-aos="fade-up">
                    <ul class="list-unstyled mb-0">
                        <li class="beneft-box">
                            <a href="#">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-heart w-8 h-8 md:w-10 md:h-10 text-rose-500 drop-shadow-lg transition-transform duration-300"
                                        aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
                                </figure>
                                <h5>Health Insurance</h5>
                            </a>
                        </li>
                        <li class="beneft-box">
                            <a href="#">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-shield w-8 h-8 md:w-10 md:h-10 text-primary drop-shadow-lg transition-transform duration-300 animate-bounce"
                                        aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                                </figure>
                                <h5>Life Insurance</h5>
                            </a>
                        </li>
                        <li class="beneft-box">
                            <a href="#">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-car w-8 h-8 md:w-10 md:h-10 text-blue-500 drop-shadow-lg transition-transform duration-300"
                                        aria-hidden="true"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
                                </figure>
                                <h5>Motor Insurance</h5>
                            </a>
                        </li>
                        <li class="beneft-box">
                            <a href="#">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-building2 lucide-building-2 w-8 h-8 md:w-10 md:h-10 text-amber-500 drop-shadow-lg transition-transform duration-300 animate-bounce"
                                        aria-hidden="true"><path d="M10 12h4"></path><path d="M10 8h4"></path><path d="M14 21v-3a2 2 0 0 0-4 0v3"></path><path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"></path><path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path></svg>
                                </figure>
                                <h5>SME</h5>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Need Help with Claims? -->
<section class="benefit-con need-help-con-section position-relative">

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                <div class="about_content text-center" data-aos="fade-up">
                    <!-- <h6>About Us</h6> -->
                    <h2>Need Help with Claims?</h2>
                    <p class="text text-size-16">Connect with claim assistance specialists</p>
                    <!-- <a href="./about.html" class="text-decoration-none all_button">Read More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>

                <div id="newpolicies" class="policieslider" data-aos="fade-up">
                    <div class="benefit_wrapper position-relative" data-aos="fade-up">
                        <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-heart h-7 w-7 text-orange-500 drop-shadow-lg"
                                            aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
                                    </figure>
                                    <h5>Health</h5>
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-shield h-7 w-7 text-orange-500 drop-shadow-lg"
                                            aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                                    </figure>
                                    <h5>Life</h5>
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-car h-7 w-7 text-orange-500 drop-shadow-lg"
                                            aria-hidden="true"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
                                    </figure>
                                    <h5>Motor</h5>
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-award h-7 w-7 text-orange-500 drop-shadow-lg"
                                            aria-hidden="true"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>
                                    </figure>
                                    <h5>Fire</h5>
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-file-check h-7 w-7 text-orange-500 drop-shadow-lg"
                                            aria-hidden="true"><path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"></path><path d="M14 2v5a1 1 0 0 0 1 1h5"></path><path d="m9 15 2 2 4-4"></path></svg>
                                    </figure>
                                    <h5>Other</h5>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

    <!-- Policy Review & Optimization -->
    <section class="benefit-con policy-review-con-section position-relative">

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                    <div class="about_content text-center" data-aos="fade-up">
                        <!-- <h6>About Us</h6> -->
                        <h2>Policy Review & Optimization</h2>
                        <p class="text text-size-16">Get expert review to optimize your coverage</p>
                       
                    </div>

                    <div id="newpolicies" class="carousel slide policieslider" data-aos="fade-up">

                        <div class="benefit_wrapper position-relative" data-aos="fade-up">
                            <ul class="list-unstyled mb-0">
                                <li class="beneft-box">
                                    <a href="#">
                                        <figure class="icon">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-search h-7 w-7 text-purple-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <path d="m21 21-4.34-4.34"></path>
                                                <circle cx="11" cy="11" r="8"></circle>
                                            </svg>
                                        </figure>
                                        <h5>Coverage</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="#">
                                        <figure class="icon">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield h-7 w-7 text-purple-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <path
                                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                                </path>
                                            </svg>
                                        </figure>
                                        <h5>Risk Check</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="#">
                                        <figure class="icon">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-clipboard h-7 w-7 text-purple-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                                                <path
                                                    d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                                </path>
                                            </svg>
                                        </figure>
                                        <h5>Audit</h5>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="get-free-policy-review text-center mt-4" data-aos="fade-up">
                            <a href="#" class="text-decoration-none all_button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up h-5 w-5 group-hover:scale-110 transition-transform" aria-hidden="true"><path d="M16 7h6v6"></path><path d="m22 7-8.5 8.5-5-5L2 17"></path></svg>
                                Get Free Policy Review
                            </a>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose PadosiAgent? -->
    <section class="benefit-con why-choose-con-section position-relative">

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                    <div class="about_content text-center" data-aos="fade-up">
                        <!-- <h6>About Us</h6> -->
                        <h2>Why Choose PadosiAgent?</h2>
                        <p class="text text-size-16">Save, Simplify, and Optimize Your Coverage</p>
                        
                    </div>

                    <div class="benefit_wrapper position-relative" data-aos="fade-up">
                        <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield-check h-7 w-7 text-emerald-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <path
                                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                                </path>
                                                <path d="m9 12 2 2 4-4"></path>
                                            </svg>
                                    </figure>
                                    <h5>0 Spam</h5>                                     
                                </a>
                                <p>Your privacy is guaranteed</p>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-dollar-sign h-7 w-7 text-amber-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <line x1="12" x2="12" y1="2" y2="22"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                    </figure>
                                    <h5>0 Fee</h5>                                     
                                </a>
                                <p>Completely free for clients</p>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-lock-keyhole h-7 w-7 text-indigo-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <circle cx="12" cy="16" r="1"></circle>
                                                <rect x="3" y="10" width="18" height="12" rx="2"></rect>
                                                <path d="M7 10V7a5 5 0 0 1 10 0v3"></path>
                                            </svg>
                                    </figure>
                                    <h5>0 Privacy</h5>                                     
                                </a>
                                <p>Your data is secure</p>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user-check h-7 w-7 text-blue-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <path d="m16 11 2 2 4-4"></path>
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                            </svg>
                                    </figure>
                                    <h5>0 Verified</h5>                                     
                                </a>
                               <p>IRDA licensed agents</p>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-zap h-7 w-7 text-rose-500 drop-shadow-lg"
                                                aria-hidden="true">
                                                <path
                                                    d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z">
                                                </path>
                                            </svg>
                                    </figure>
                                    <h5>0 Rapid</h5>                                     
                                </a>
                              <p>Few blocks away</p>
                            </li>
                        </ul>
                    </div>

                    <div class="get-free-policy-review text-center mt-4" data-aos="fade-up">
                            <a href="#" class="text-decoration-none all_button">
                                Find Your Agent Now
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How PadosiAgent Works -->
    <section class="benefit-con how-padosi-agent-works-con position-relative">

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                    <div class="about_content text-center" data-aos="fade-up">
                        <!-- <h6>About Us</h6> -->
                        <h2>How PadosiAgent Works</h2>
                        <p class="text text-size-16">Simple steps to find your perfect agent</p>
                    </div>


                    <div class="benefit_wrapper position-relative" data-aos="fade-up">
                        <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-search h-7 w-7 text-primary drop-shadow-lg"
                                                aria-hidden="true">
                                                <path d="m21 21-4.34-4.34"></path>
                                                <circle cx="11" cy="11" r="8"></circle>
                                            </svg>
                                    </figure>
                                    <h5>Search</h5>                                     
                                </a>
                               <p>Find verified agents</p>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-git-compare h-7 w-7 text-secondary drop-shadow-lg"
                                                aria-hidden="true">
                                                <circle cx="18" cy="18" r="3"></circle>
                                                <circle cx="6" cy="6" r="3"></circle>
                                                <path d="M13 6h3a2 2 0 0 1 2 2v7"></path>
                                                <path d="M11 18H8a2 2 0 0 1-2-2V9"></path>
                                            </svg>
                                    </figure>
                                    <h5>Compare</h5>                                     
                                </a>
                               <p>Review ratings</p>
                            </li>
                            <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-message-square h-7 w-7 text-accent drop-shadow-lg"
                                                aria-hidden="true">
                                                <path
                                                    d="M22 17a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 21.286V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2z">
                                                </path>
                                            </svg>
                                    </figure>
                                    <h5>Connect</h5>                                     
                                </a>
                               <p>Call or WhatsApp</p>
                            </li>
                             <li class="beneft-box">
                                <a href="#">
                                    <figure class="icon">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-hand-heart h-7 w-7 text-primary drop-shadow-lg"
                                                aria-hidden="true">
                                                <path d="M11 14h2a2 2 0 0 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"></path>
                                                <path
                                                    d="m14.45 13.39 5.05-4.694C20.196 8 21 6.85 21 5.75a2.75 2.75 0 0 0-4.797-1.837.276.276 0 0 1-.406 0A2.75 2.75 0 0 0 11 5.75c0 1.2.802 2.248 1.5 2.946L16 11.95">
                                                </path>
                                                <path d="m2 15 6 6"></path>
                                                <path
                                                    d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a1 1 0 0 0-2.75-2.91">
                                                </path>
                                            </svg>
                                    </figure>
                                    <h5>Get Assisted</h5>                                     
                                </a>
                              <p>Personalized service</p>
                            </li>
                        </ul>
                    </div>

                    <div class="get-free-policy-review text-center mt-4" data-aos="fade-up">
                            <a href="#" class="text-decoration-none all_button">
                                Get Started Now
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                            </a>
                        </div>

                </div>
            </div>
        </div>
    </section>


    <!-- About -->
    <section class="about-con position-relative">
        <figure class="about-rightimage mb-0">
            <img src="{{ asset('img/logo-icon.png') }}" alt="image" class="img-fluid">
        </figure>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 col-12 order-lg-1 order-2 text-lg-left text-center">
                    <div class="about_wrapper position-relative" data-aos="zoom-in">
                        <figure class="about-image1 image mb-0">
                            <img src="{{ asset('img/about-image1.jpg') }}" alt="image" class="img-fluid">
                        </figure>
                        <figure class="about-image2 image mb-0">
                            <img src="{{ asset('img/about-image2.jpg') }}" alt="image" class="img-fluid">
                        </figure>
                        <div class="box">
                            <figure class="about-quoteimage">
                                <img src="{{ asset('img/about-quoteimage.png') }}" alt="image" class="img-fluid">
                            </figure>
                            <h6 class="text-white">Insurance was the best investment i ever made.</h6>
                            <span class="text-white">Kevin Doe</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                    <div class="about_content" data-aos="fade-up">
                        <h6>About Us</h6>
                        <h2>We Provide the Best Insurance Policy</h2>
                        <p class="text text-size-16">Reiciendis voluptatibus maiores alias consequatur aut
                            perferendis doloribus asperiores repellat maxime place at facere possimus omnis volutas.
                        </p>
                        <a href="{{ route('about') }}" class="text-decoration-none all_button">Read More<i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Faq -->
    <section class="faq-con position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="faq_wrapper position-relative" data-aos="zoom-in">
                        <figure class="faq-image mb-0">
                            <img src="{{ asset('img/faq-image.jpg') }}" alt="image" class="img-fluid">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="faq_content" data-aos="fade-up">
                        <h6>Faq’s</h6>
                        <h2>Frequently Asked Questions</h2>
                        <p class="text text-size-16">Everything you need to know about PadosiAgent

                        </p>
                        <div class="accordian-section-inner position-relative">
                            <div class="accordian-inner">
                                <div id="faq_accordion">
                                    <div class="accordion-card">
                                        <div class="card-header" id="faqheadingOne">
                                            <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#faqcollapseOne" aria-expanded="false"
                                                aria-controls="faqcollapseOne">
                                                <h5 class="mb-0">Q: How do I find the right insurance agent for my
                                                    needs?</h5>
                                            </a>
                                        </div>
                                        <div id="faqcollapseOne" class="collapse" aria-labelledby="faqheadingOne"
                                            data-parent="#faq_accordion">
                                            <div class="card-body">
                                                <p class="text-size-16 text-left mb-0">Simply select the service you
                                                    need (New Policy, Claim Assistance, or Policy Review) and browse
                                                    through our verified local agents. You can compare their ratings,
                                                    specializations, and experience to find the perfect match.

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-card">
                                        <div class="card-header" id="faqheadingTwo">
                                            <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#faqcollapseTwo" aria-expanded="false"
                                                aria-controls="faqcollapseTwo">
                                                <h5 class="mb-0">Q: Is PadosiAgent really free? How do you make money?
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="faqcollapseTwo" class="collapse show" aria-labelledby="faqheadingTwo"
                                            data-parent="#faq_accordion">
                                            <div class="card-body">
                                                <p class="text-size-16 text-left mb-0">Yes, PadosiAgent is completely
                                                    free for clients. We charge a small commission from insurance
                                                    companies when policies are sold through our platform. There are
                                                    absolutely no hidden fees for you.

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-card">
                                        <div class="card-header" id="faqheadingThree">
                                            <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#faqcollapseThree" aria-expanded="false"
                                                aria-controls="faqcollapseThree">
                                                <h5 class="mb-0">Q: How long does the claim assistance process take?
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="faqcollapseThree" class="collapse" aria-labelledby="faqheadingThree"
                                            data-parent="#faq_accordion">
                                            <div class="card-body">
                                                <p class="text-size-16 text-left mb-0">The timeline varies depending on
                                                    your claim type and insurance company. However, our agents typically
                                                    respond within 2-3 hours and guide you through each step of the
                                                    claim process until it's resolved.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial -->
    <section class="testimonial-con position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonial_content text-center" data-aos="fade-up">
                        <h6>What Our Customers Say
                        </h6>
                        <h2>Real experiences from policy buyers, claim assistance, and review clients

                        </h2>
                    </div>
                </div>
                <div class="col-xl-10 col-12 mx-auto position-relative">
                    <figure class="testimonial-sideimage mb-0" data-aos="fade-up">
                        <img src="{{ asset('img/testimonial-sideimage.png') }}" alt="image" class="img-fluid">
                    </figure>
                    <div id="testimonialcarousel" class="carousel slide" data-ride="carousel" data-aos="fade-up">
                        <div class="testimonial_carousel text-center position-relative">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">"Found the perfect health insurance through
                                            PadosiAgent. The agent was professional and explained everything clearly."
                                        </p>
                                        <div class="lower_content">
                                            <span class="name">Sneha Patel</span>
                                            <span class="review">Policy Purchase</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">“My claim was rejected initially, but the
                                            agent from PadosiAgent helped me get it approved. Highly recommended!"
                                        </p>
                                        <div class="lower_content">
                                            <span class="name">Rahul Verma</span>
                                            <span class="review">Claim Assistance</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">"Got my policy reviewed and discovered I was
                                            overpaying. Saved ₹15,000 annually. Thank you PadosiAgent!"


                                        </p>
                                        <div class="lower_content">
                                            <span class="name">Anjali Desai
                                            </span>
                                            <span class="review">Policy Review

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">"Bought term insurance for my family. The
                                            agent was patient and helped me understand all the terms."


                                        </p>
                                        <div class="lower_content">
                                            <span class="name">Vikram Singh
                                            </span>
                                            <span class="review">Policy Purchase

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">"Medical claim process was smooth thanks to my
                                            PadosiAgent. They handled all the documentation."</p>
                                        <div class="lower_content">
                                            <span class="name">Priya Iyer</span>
                                            <span class="review">Claim Assistance</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">"Professional service. The agent reviewed all
                                            my policies and suggested better coverage options."

                                        </p>
                                        <div class="lower_content">
                                            <span class="name">Amit Kapoor</span>
                                            <span class="review">Policy Review</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="testimonial-box">
                                        <ul class="list-unstyled">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <p class="paragarph text-size-18">"First time buying insurance and the agent
                                            made it so easy. No spam calls, just genuine help."



                                        </p>
                                        <div class="lower_content">
                                            <span class="name">Neha Gupta
                                            </span>
                                            <span class="review">Policy Review</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#testimonialcarousel" data-slide-to="0" class="active">
                                <figure class="mb-0 image1">
                                    <img src="{{ asset('img/testimonial-personimage1.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="1">
                                <figure class="mb-0 image2">
                                    <img src="{{ asset('img/testimonial-personimage2.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="2">
                                <figure class="mb-0 image3">
                                    <img src="{{ asset('img/testimonial-personimage3.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="3">
                                <figure class="mb-0 image4">
                                    <img src="{{ asset('img/testimonial-personimage4.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="4">
                                <figure class="mb-0 image5">
                                    <img src="{{ asset('img/testimonial-personimage4.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="5">
                                <figure class="mb-0 image6">
                                    <img src="{{ asset('img/testimonial-personimage4.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="6">
                                <figure class="mb-0 image7">
                                    <img src="{{ asset('img/testimonial-personimage4.jpg') }}" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    function initHomeSliders() {
        // Destroy existing carousels if they exist to prevent duplication bugs
        $('.owl-carousel').trigger('destroy.owl.carousel'); 

        $('.banner-con .owl-carousel').owlCarousel({
            items: 1,
            margin: 15,
            stagePadding: 0,
            smartSpeed: 450,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,
            animateOut: 'fadeOut'
        })
        $('.policieslider-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.need-help-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.policy-review-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.why-choose-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.how-padosi-agent-works-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })
    }
    
    // Init on load
    $(document).ready(function(){
        initHomeSliders();
    });

    // Init on HTMX swap (if this page is loaded via AJAX)
    document.addEventListener('htmx:afterSwap', function(evt) {
        // Only init if the sliders are present in the new content
        if(document.querySelector('.banner-con .owl-carousel')) {
            initHomeSliders();
        }
    });
</script>
@endpush
