@extends('layouts.app')

@section('content')
<div class="family_banner_outer home-page-banner position-relative">
    @include('layouts.header')

    <section class="top-text-section position-relative">
            <h2 class="banner-top-title">Find <span class="trusted">Trusted & Verified</span> Insurance Experts in your  <span class="padosi">Neighbourhood</span></h2>         
        </section>

        <!-- Banner -->
        <section class="banner-con position-relative">
            
            <div class="banner-top-text-block">
                <div class="banner-top-text-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big h-3 w-3 sm:h-3.5 sm:w-3.5 md:h-4 md:w-4 text-secondary flex-shrink-0" aria-hidden="true" data-lov-id="src/components/HeroCarousel.tsx:162:14" data-lov-name="CheckCircle" data-component-path="src/components/HeroCarousel.tsx" data-component-line="162" data-component-file="HeroCarousel.tsx" data-component-name="CheckCircle" data-component-content="%7B%22className%22%3A%22h-3%20w-3%20sm%3Ah-3.5%20sm%3Aw-3.5%20md%3Ah-4%20md%3Aw-4%20text-secondary%20flex-shrink-0%22%7D"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                    IRDAI Verified
                </div>
                <div class="banner-top-text-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-3 w-3 sm:h-3.5 sm:w-3.5 md:h-4 md:w-4 text-secondary flex-shrink-0" aria-hidden="true" data-lov-id="src/components/HeroCarousel.tsx:166:14" data-lov-name="Shield" data-component-path="src/components/HeroCarousel.tsx" data-component-line="166" data-component-file="HeroCarousel.tsx" data-component-name="Shield" data-component-content="%7B%22className%22%3A%22h-3%20w-3%20sm%3Ah-3.5%20sm%3Aw-3.5%20md%3Ah-4%20md%3Aw-4%20text-secondary%20flex-shrink-0%22%7D"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                    No Spam Calls
                </div>
                <div class="banner-top-text-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-3 w-3 sm:h-3.5 sm:w-3.5 md:h-4 md:w-4 text-secondary flex-shrink-0" aria-hidden="true" data-lov-id="src/components/HeroCarousel.tsx:166:14" data-lov-name="Shield" data-component-path="src/components/HeroCarousel.tsx" data-component-line="166" data-component-file="HeroCarousel.tsx" data-component-name="Shield" data-component-content="%7B%22className%22%3A%22h-3%20w-3%20sm%3Ah-3.5%20sm%3Aw-3.5%20md%3Ah-4%20md%3Aw-4%20text-secondary%20flex-shrink-0%22%7D"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                    100% Free
                </div>
            </div>


            <div id="homebanner" class="carousel slide" data-aos="fade-up">
                <div class="text-center position-relative owl-carousel banner-slider">
                    <!-- <div class="carousel-inner"> -->
                    <div class="item active">
                        <!-- <div class="container"> -->
                        <div class="row new-policies-banner-outer">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-left-img responive-banner-img1">
                                <div class="banner_content" data-aos="fade-up">
                                    <h1 class="text-white">Buy/Port/Renew Insurance</h1>
                                    <h1 class="text-white text-size-16">Connect with your local PadosiAgent</h1> 
                                    {{-- <p class="text-white text-size-18">Buy, port, or renew your Health, Life, Motor & SME insurance</p> --}}
                                    <div class="button_wrapper">
                                        <a href="{{ url('/find-agents?ServiceType=New%20Policy') }}" class="text-decoration-none all_button get_started">Find My PadosiAgent</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-right-img banner-new-policy">
                                <div class="banner_wrapper position-relative">
                                    <!-- <figure class="icon banner-icon1 mb-0">
                                            <img src="./img/banner-icon1.png" alt="image" class="img-fluid">
                                        </figure> -->
                                    <figure class="icon banner-icon2 mb-0">
                                        <img src="./img/banner-icon2.png" alt="image" class="img-fluid">
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
                                    <h1 class="text-white">Get My Claim Assisted</h1>
                                    <h1 class="text-white text-size-16">Struggling with your claim? </h1>
                                    {{-- <p class="text-white text-size-18">Get expert help with filing, follow-ups, settlements & disputes</p> --}}
                                    <div class="button_wrapper">
                                        
                                        <a href="{{ url('/find-agents?ServiceType=Claim%20Assistance') }}" class="text-decoration-none all_button get_started">Find Claims Expert</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-right-img banner-claim-assistance">
                                <div class="banner_wrapper position-relative">
                                   
                                    <figure class="icon banner-icon2 mb-0">
                                        <img src="./img/banner-icon2.png" alt="image" class="img-fluid">
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
                                    <h1 class="text-white">Review My Policy</h1>
                                    <h1 class="text-white text-size-16">Unsure if you're covered?</h1>
                                    {{-- <p class="text-white text-size-18"> Get your free policies audit to find gaps & optimize your coverage</p> --}}
                                    <div class="button_wrapper">
                                       
                                        <a href="{{ url('/find-agents?ServiceType=Policy%20Review') }}" class="text-decoration-none all_button get_started">Find Insurance Expert</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 h-banner-right-img banner-policy-review">
                                <div class="banner_wrapper position-relative">
                                   
                                    <figure class="icon banner-icon2 mb-0">
                                        <img src="./img/banner-icon2.png" alt="image" class="img-fluid">
                                    </figure>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>

        </section>
    </div>  

    <!-- New Policies We Cover -->
    <section class="benefit-con new-policies-section position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="benefit_content text-center" data-aos="fade-up">
                        <!-- <h6>What We Provide</h6> -->
                        <h2>Buy/Port/Renew Insurance with PadosiAgent</h2>
                        <p class="text text-size-18 mb-0">Click on the Icon to search for PadosiAgent</p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-12 mt-4">
                    <div class="benefit_wrapper position-relative" data-aos="fade-up">
                        <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <a href="{{ url('/find-agents?ServiceType=New%20Policy&InsuranceType=Health%20Insurance&openFilter=1') }}">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-heart w-8 h-8 md:w-10 md:h-10 text-rose-500 drop-shadow-lg transition-transform duration-300"
                                            aria-hidden="true" data-lov-id="src/components/PolicyIconGrid.tsx:124:18"
                                            data-lov-name="Icon" data-component-path="src/components/PolicyIconGrid.tsx"
                                            data-component-line="124" data-component-file="PolicyIconGrid.tsx"
                                            data-component-name="Icon" data-component-content="%7B%7D">
                                            <path
                                                d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5">
                                            </path>
                                        </svg>
                                    </figure>
                                    <h5>Health Insurance</h5>
                                    <!-- <p class="text-size-16 mb-0">Buy, Port or Renew your insurance policy with trusted
                                    agents</p> -->
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="{{ url('/find-agents?ServiceType=New%20Policy&InsuranceType=Life%20Insurance&openFilter=1') }}">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-shield w-8 h-8 md:w-10 md:h-10 text-primary drop-shadow-lg transition-transform duration-300 animate-bounce"
                                            aria-hidden="true" data-lov-id="src/components/PolicyIconGrid.tsx:124:18"
                                            data-lov-name="Icon" data-component-path="src/components/PolicyIconGrid.tsx"
                                            data-component-line="124" data-component-file="PolicyIconGrid.tsx"
                                            data-component-name="Icon" data-component-content="%7B%7D">
                                            <path
                                                d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                            </path>
                                        </svg>
                                    </figure>
                                    <h5>Life Insurance</h5>
                                    <!-- <p class="text-size-16 mb-0">Optimize your portfolio and maximize your coverage benefits
                                </p> -->
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="{{ url('/find-agents?ServiceType=New%20Policy&InsuranceType=Motor%20Insurance&openFilter=1') }}">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-car w-8 h-8 md:w-10 md:h-10 text-blue-500 drop-shadow-lg transition-transform duration-300"
                                            aria-hidden="true" data-lov-id="src/components/PolicyIconGrid.tsx:124:18"
                                            data-lov-name="Icon" data-component-path="src/components/PolicyIconGrid.tsx"
                                            data-component-line="124" data-component-file="PolicyIconGrid.tsx"
                                            data-component-name="Icon" data-component-content="%7B%7D">
                                            <path
                                                d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2">
                                            </path>
                                            <circle cx="7" cy="17" r="2"></circle>
                                            <path d="M9 17h6"></path>
                                            <circle cx="17" cy="17" r="2"></circle>
                                        </svg>
                                    </figure>
                                    <h5>Motor Insurance</h5>
                                    <!-- <p class="text-size-16 mb-0">Expert help with claim processing, settlements and disputes
                                </p> -->
                                </a>
                            </li>
                            <li class="beneft-box">
                                <a href="{{ url('/find-agents?ServiceType=New%20Policy&InsuranceType=SME%20Insurance&openFilter=1') }}">
                                    <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-building2 lucide-building-2 w-8 h-8 md:w-10 md:h-10 text-amber-500 drop-shadow-lg transition-transform duration-300 animate-bounce"
                                            aria-hidden="true" data-lov-id="src/components/PolicyIconGrid.tsx:124:18"
                                            data-lov-name="Icon" data-component-path="src/components/PolicyIconGrid.tsx"
                                            data-component-line="124" data-component-file="PolicyIconGrid.tsx"
                                            data-component-name="Icon" data-component-content="%7B%7D">
                                            <path d="M10 12h4"></path>
                                            <path d="M10 8h4"></path>
                                            <path d="M14 21v-3a2 2 0 0 0-4 0v3"></path>
                                            <path
                                                d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2">
                                            </path>
                                            <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path>
                                        </svg>
                                    </figure>
                                    <h5>SME Insurance</h5>
                                    <!-- <p class="text-size-16 mb-0">Expert help with claim processing, settlements and disputes
                                </p> -->
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
                        <h2>Stuck with your Claim?</h2>
                        <h2 class="text-size-18"><b>Get assisted with PadosiAgent Claim Experts</b></h2>
                        <p class="text text-size-16">Select your insurance type below to find your claim assistance PadosiAgent</p>
                        <!-- <a href="./about.html" class="text-decoration-none all_button">Read More<i
                                class="fa-solid fa-arrow-right"></i></a> -->
                    </div>

                    <div id="needhelp-slider" class="policieslider" data-aos="fade-up">
                        <div class="benefit_wrapper position-relative" data-aos="fade-up">
                            <ul class="list-unstyled mb-0">
                                <li class="beneft-box">
                                    <a href="{{ url('/find-agents?ServiceType=Claim%20Assistance&InsuranceType=Health%20Insurance&openFilter=1') }}">
                                        <figure class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-heart h-7 w-7 text-orange-500 drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
                                                <path
                                                    d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5">
                                                </path>
                                            </svg>
                                        </figure>
                                        <h5>Health Insurance</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="{{ url('/find-agents?ServiceType=Claim%20Assistance&InsuranceType=Life%20Insurance&openFilter=1') }}">
                                        <figure class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield h-7 w-7 text-orange-500 drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
                                                <path
                                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                                </path>
                                            </svg>
                                        </figure>
                                        <h5>Life Insurance</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="{{ url('/find-agents?ServiceType=Claim%20Assistance&InsuranceType=Motor%20Insurance&openFilter=1') }}">
                                        <figure class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-car h-7 w-7 text-orange-500 drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
                                                <path
                                                    d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2">
                                                </path>
                                                <circle cx="7" cy="17" r="2"></circle>
                                                <path d="M9 17h6"></path>
                                                <circle cx="17" cy="17" r="2"></circle>
                                            </svg>
                                        </figure>
                                        <h5>Motor Insurance</h5>
                                    </a>
                                </li>
                                
                                <li class="beneft-box">
                                    <a href="{{ url('/find-agents?ServiceType=Claim%20Assistance&InsuranceType=SME%20Insurance&openFilter=1') }}">
                                         <figure class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-building2 lucide-building-2 w-8 h-8 md:w-10 md:h-10 text-amber-500 drop-shadow-lg transition-transform duration-300 animate-bounce"
                                            aria-hidden="true" data-lov-id="src/components/PolicyIconGrid.tsx:124:18"
                                            data-lov-name="Icon" data-component-path="src/components/PolicyIconGrid.tsx"
                                            data-component-line="124" data-component-file="PolicyIconGrid.tsx"
                                            data-component-name="Icon" data-component-content="%7B%7D">
                                            <path d="M10 12h4"></path>
                                            <path d="M10 8h4"></path>
                                            <path d="M14 21v-3a2 2 0 0 0-4 0v3"></path>
                                            <path
                                                d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2">
                                            </path>
                                            <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path>
                                        </svg>
                                    </figure>
                                        <h5>SME Insurance</h5>
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
                        <h2>Do you have multiple Insurance Policies?</h2>
                        <h2 class="text-size-18"><strong>Get your Portfolio Audited by Expert PadosiAgents</strong></h2>
                        <p class="text text-size-16">PadosiAgent will analyse and identify gaps in your coverage</p>                       
                    </div>

                    <div id="policyreview-slider" class="policieslider" data-aos="fade-up">

                        <div class="benefit_wrapper position-relative" data-aos="fade-up">
                            <ul class="list-unstyled mb-0">
                                <li class="beneft-box">
                                        <a href="javascript:void(0);">
                                        <figure class="icon" data-toggle="tooltip" data-placement="top" title="Identify potential gaps and risks in your current insurance coverage.">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check h-5 w-5 sm:h-6 sm:w-6 md:h-8 md:w-8 transition-colors duration-300 text-review group-hover:text-primary" aria-hidden="true" data-lov-id="src/pages/Index.tsx:181:20" data-lov-name="Icon" data-component-path="src/pages/Index.tsx" data-component-line="181" data-component-file="Index.tsx" data-component-name="Icon" data-component-content="%7B%7D"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>
                                        </figure>
                                        <h5>Risk Analysis</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="javascript:void(0);">
                                        <figure class="icon" data-toggle="tooltip" data-placement="top" title="A comprehensive review of all your active insurance policies in one place.">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-pie h-5 w-5 sm:h-6 sm:w-6 md:h-8 md:w-8 transition-colors duration-300 text-review group-hover:text-primary" aria-hidden="true" data-lov-id="src/pages/Index.tsx:181:20" data-lov-name="Icon" data-component-path="src/pages/Index.tsx" data-component-line="181" data-component-file="Index.tsx" data-component-name="Icon" data-component-content="%7B%7D"><path d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z"></path><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path></svg>
                                        </figure>
                                        <h5>Portfolio Analysis</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="javascript:void(0);">
                                        <figure class="icon" data-toggle="tooltip" data-placement="top" title="Evaluate your premiums to ensure you're getting the best value for your money.">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-check h-5 w-5 sm:h-6 sm:w-6 md:h-8 md:w-8 transition-colors duration-300 text-review group-hover:text-primary" aria-hidden="true" data-lov-id="src/pages/Index.tsx:181:20" data-lov-name="Icon" data-component-path="src/pages/Index.tsx" data-component-line="181" data-component-file="Index.tsx" data-component-name="Icon" data-component-content="%7B%7D"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="m9 14 2 2 4-4"></path></svg>
                                        </figure>
                                        <h5>Premium Audit</h5>
                                    </a>
                                </li>
                                <li class="beneft-box">
                                    <a href="javascript:void(0);">
                                        <figure class="icon" data-toggle="tooltip" data-placement="top" title="Professional guidance to optimize your insurance strategy.">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lightbulb h-5 w-5 sm:h-6 sm:w-6 md:h-8 md:w-8 transition-colors duration-300 text-review group-hover:text-primary" aria-hidden="true" data-lov-id="src/pages/Index.tsx:181:20" data-lov-name="Icon" data-component-path="src/pages/Index.tsx" data-component-line="181" data-component-file="Index.tsx" data-component-name="Icon" data-component-content="%7B%7D"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"></path><path d="M9 18h6"></path><path d="M10 22h4"></path></svg>
                                        </figure>
                                        <h5>Expert Advise</h5>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="get-free-policy-review text-center mt-4" data-aos="fade-up">
                            <a href="{{ url('/find-agents?ServiceType=Policy%20Review') }}" class="text-decoration-none all_button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up h-5 w-5 group-hover:scale-110 transition-transform" aria-hidden="true" data-lov-id="src/pages/Index.tsx:170:20" data-lov-name="TrendingUp" data-component-path="src/pages/Index.tsx" data-component-line="170" data-component-file="Index.tsx" data-component-name="TrendingUp" data-component-content="%7B%22className%22%3A%22h-5%20w-5%20group-hover%3Ascale-110%20transition-transform%22%7D"><path d="M16 7h6v6"></path><path d="m22 7-8.5 8.5-5-5L2 17"></path></svg>
                                Find Insurance Expert
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
                        <h2>Why Users Trust their PadosiAgent</h2>
                        <p class="text text-size-16">The safest way to find your insurance PadosiAgent: No Spam, No Fees, just trusted service for you</p>                        
                    </div>

                    <div class="benefit_wrapper position-relative" data-aos="fade-up">
                          <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Only you can contact agents. They can't call you first.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield-check h-7 w-7 text-emerald-500 drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
                                                <path
                                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                                </path>
                                                <path d="m9 12 2 2 4-4"></path>
                                            </svg>
                                    </figure>
                                    <h5>No Spam</h5>                                     
                                </a>
                                <p>Your privacy protected</p>
                            </li><li class="beneft-box">
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Your personal information is encrypted and never shared without your consent.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-lock-keyhole h-7 w-7 text-indigo-500 drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
                                                <circle cx="12" cy="16" r="1"></circle>
                                                <rect x="3" y="10" width="18" height="12" rx="2"></rect>
                                                <path d="M7 10V7a5 5 0 0 1 10 0v3"></path>
                                            </svg>
                                    </figure>
                                    <h5>Data Safe</h5>                                     
                                </a>
                                <p>Encrypted & Secure</p>
                            </li>
                            <li class="beneft-box">
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Connect with trusted insurance experts right in your neighborhood.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 text-secondary" aria-hidden="true" data-lov-id="src/components/WhyChooseUs.tsx:69:20" data-lov-name="Icon" data-component-path="src/components/WhyChooseUs.tsx" data-component-line="69" data-component-file="WhyChooseUs.tsx" data-component-name="Icon" data-component-content="%7B%7D"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    </figure>
                                <h5>Nearby</h5>                                     
                                </a>
                               <p>In your neighbourhood</p>
                            </li> 
                            <li class="beneft-box">
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Our platform is completely free to use. No hidden fees or charges.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-indian-rupee h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 text-secondary" aria-hidden="true" data-lov-id="src/components/WhyChooseUs.tsx:69:20" data-lov-name="Icon" data-component-path="src/components/WhyChooseUs.tsx" data-component-line="69" data-component-file="WhyChooseUs.tsx" data-component-name="Icon" data-component-content="%7B%7D"><path d="M6 3h12"></path><path d="M6 8h12"></path><path d="m6 13 8.5 8"></path><path d="M6 13h3"></path><path d="M9 13c6.667 0 6.667-10 0-10"></path></svg>
                                    </figure>
                                    <h5>100% Free</h5>                                     
                                </a>
                                <p>No charges for you</p>
                            </li>
                                                      
                        </ul>
                    </div>

                    <div class="get-free-policy-review text-center mt-4" data-aos="fade-up">
                            <a href="{{ url('/find-agents') }}" class="text-decoration-none all_button">
                                Find My PadosiAgent Now
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4" aria-hidden="true" data-lov-id="src/components/WhyChooseUs.tsx:104:12" data-lov-name="ArrowRight" data-component-path="src/components/WhyChooseUs.tsx" data-component-line="104" data-component-file="WhyChooseUs.tsx" data-component-name="ArrowRight" data-component-content="%7B%22className%22%3A%22ml-2%20h-4%20w-4%22%7D"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                            </a>
                        </div>

                   

                </div>
            </div>
        </div>
    </section>

    <!-- New Policies We Cover -->
    <section class="benefit-con how-padosi-agent-works-con position-relative">

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                    <div class="about_content text-center" data-aos="fade-up">
                        <!-- <h6>About Us</h6> -->
                        <h2>Find My PadosiAgent in 4 Simple Steps</h2>
                        <p class="text text-size-16">From search to service - it takes just minutes for you</p>
                    </div>

                    <div class="benefit_wrapper position-relative" data-aos="fade-up">
                        <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Find verified insurance experts by area or service.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-search h-7 w-7 text-primary drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
                                                <path d="m21 21-4.34-4.34"></path>
                                                <circle cx="11" cy="11" r="8"></circle>
                                            </svg>
                                    </figure>
                                    <h5>Search</h5>                                     
                                </a>
                               <p>Find verified agents</p>
                            </li>
                            <li class="beneft-box">
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Review ratings and profiles to find your perfect match.">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-git-compare h-7 w-7 text-secondary drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
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
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Get in touch via Call or WhatsApp instantly.">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-message-square h-7 w-7 text-accent drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
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
                                <a href="javascript:void(0);">
                                    <figure class="icon" data-toggle="tooltip" data-placement="top" title="Get professional support for policies, claims, and more.">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-hand-heart h-7 w-7 text-primary drop-shadow-lg"
                                                aria-hidden="true" data-lov-id="src/components/Icon3D.tsx:86:8"
                                                data-lov-name="Icon" data-component-path="src/components/Icon3D.tsx"
                                                data-component-line="86" data-component-file="Icon3D.tsx"
                                                data-component-name="Icon" data-component-content="%7B%7D">
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
                                    <h5>Assist Me</h5>                                     
                                </a>
                              <p>Personalized service</p>
                            </li>
                        </ul>
                    </div>

                    <div class="get-free-policy-review text-center mt-4" data-aos="fade-up">
                            <a href="{{ url('/find-agents') }}" class="text-decoration-none all_button">
                                Find My PadosiAgent
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4" aria-hidden="true" data-lov-id="src/components/WhyChooseUs.tsx:104:12" data-lov-name="ArrowRight" data-component-path="src/components/WhyChooseUs.tsx" data-component-line="104" data-component-file="WhyChooseUs.tsx" data-component-name="ArrowRight" data-component-content="%7B%22className%22%3A%22ml-2%20h-4%20w-4%22%7D"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                            </a>
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
                        <h2>What Users like you say about their PadosiAgent</h2>
                         <p class="text text-size-16">Real experiences from users who found their PadosiAgent for policies, claims & reviews</p>  
                    </div>
                </div>
                <div class="col-xl-10 col-12 mx-auto position-relative">
                    {{-- <figure class="testimonial-sideimage mb-0" data-aos="fade-up">
                        <img src="./img/testimonial-sideimage.png" alt="image" class="img-fluid">
                    </figure> --}}
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
                        {{-- <ul class="carousel-indicators">
                            <li data-target="#testimonialcarousel" data-slide-to="0" class="active">
                                <figure class="mb-0 image1">
                                    <img src="./img/testimonial-personimage1.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="1">
                                <figure class="mb-0 image2">
                                    <img src="./img/testimonial-personimage2.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="2">
                                <figure class="mb-0 image3">
                                    <img src="./img/testimonial-personimage3.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="3">
                                <figure class="mb-0 image4">
                                    <img src="./img/testimonial-personimage4.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="4">
                                <figure class="mb-0 image5">
                                    <img src="./img/testimonial-personimage4.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="5">
                                <figure class="mb-0 image6">
                                    <img src="./img/testimonial-personimage4.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                            <li data-target="#testimonialcarousel" data-slide-to="6">
                                <figure class="mb-0 image7">
                                    <img src="./img/testimonial-personimage4.jpg" alt="image"
                                        class="img-fluid invert_effect">
                                </figure>
                            </li>
                        </ul> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function initHomeSliders() {
            try {
                console.log('Initializing Home Sliders...');
                if (typeof $ === 'undefined') {
                    console.error('jQuery is not defined during initHomeSliders');
                    return;
                }
                
                if (!$.fn.owlCarousel) {
                    console.error('Owl Carousel plugin is not loaded');
                    return;
                }

                // Destroy existing carousels if they exist to prevent duplication bugs
                $('.owl-carousel').each(function() {
                    if ($(this).data('owl.carousel')) {
                        $(this).owlCarousel('destroy');
                    }
                });

                $('.banner-slider').owlCarousel({
                    items: 1,
                    margin: 0,
                    loop: true,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: 800,
                    animateOut: 'fadeOut',
                    navText: ['<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>']
                });

                // Initialize Bootstrap carousel for testimonial
                if (typeof $ !== 'undefined' && $.fn.carousel) {
                    $('#testimonialcarousel').carousel();
                }

                // Initialize tooltips
                initTooltips();
            } catch (err) {
                console.error('Error in initHomeSliders:', err);
            }
        }

        function initTooltips() {
            if (typeof $ !== 'undefined' && $.fn.tooltip) {
                // Destroy existing tooltips before re-initializing to avoid duplication or stucky behavior
                $('[data-toggle="tooltip"]').tooltip('dispose');
                
                // Initialize tooltips with 'click hover focus' trigger
                $('[data-toggle="tooltip"]').tooltip({
                    trigger: 'click hover focus'
                });

                // Crucial logic: Hide all other tooltips automatically when a new one is opened
                $('[data-toggle="tooltip"]').on('show.bs.tooltip', function () {
                   $('[data-toggle="tooltip"]').not(this).tooltip('hide');
                });

                // Optional but helpful: hide when a user clicks somewhere else entirely
                $('body').on('click', function (e) {
                    if ($(e.target).data('toggle') !== 'tooltip' && $(e.target).parents('[data-toggle="tooltip"]').length === 0) {
                        $('[data-toggle="tooltip"]').tooltip('hide');
                    }
                });
            }
        }
        
        // Remove tooltips completely before navigating away to avoid them sticking on the next page
        window.addEventListener('beforeunload', function() {
            if (typeof $ !== 'undefined') {
                $('.tooltip').remove();
            }
        });

        document.addEventListener('htmx:beforeRequest', function() {
            if (typeof $ !== 'undefined') {
                $('.tooltip').remove();
            }
        });

        document.addEventListener('htmx:beforeSwap', function() {
            if (typeof $ !== 'undefined') {
                $('.tooltip').remove();
            }
        });

        // Run on multiple events to ensure it catches the DOM
        $(document).ready(function() {
            initHomeSliders();
            initTooltips();
        });
        initHomeSliders();
        initTooltips();

        // Also run after a short delay to ensure DOM dimensions are ready
        setTimeout(function() {
            initHomeSliders();
            initTooltips();
        }, 100);
        
        // Re-init on HTMX load event
        document.addEventListener('htmx:afterSettle', function(evt) {
            initHomeSliders();
            initTooltips();
        });
        
        // Also refresh AOS on settle
        document.addEventListener('htmx:afterSettle', function(evt) {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    </script>
@endsection

@push('scripts')
{{-- Scripts moved inside content for HTMX compatibility --}}
@endpush
