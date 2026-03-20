@extends('layouts.app')

@section('content')
<div class="sub_banner position-relative">
    @include('layouts.header')
     <section class="sub_banner_con sub-about-banner position-relative">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-xl-8 col-lg-9 col-12 mx-auto">
                        <div class="sub_banner_content" >
                            {{-- <h1 class="text-white">About <span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span></h1> --}}
                            <h1 class="text-white">About Us</h1>

                            <p class="text-white text-size-18">Connecting you with trusted insurance agents in your
                                neighborhood</p>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
        <!-- Who We Are -->
    <section class="aboutpage-con position-relative">
        <figure class="about-rightimage mb-0">
            <img src="{{ asset('img/logo-icon.png') }}" alt="image" class="img-fluid">
        </figure>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 col-12 order-lg-1 order-2 text-lg-left text-center">
                    <div class="about_wrapper position-relative" >
                        <figure class="about-image1 image mb-0">
                            <img src="{{ asset('img/aboutpage-image1.jpg') }}" alt="image" class="img-fluid">
                        </figure>
                        <figure class="about-image2 image mb-0">
                            <img src="{{ asset('img/aboutpage-image2.jpg') }}" alt="image" class="img-fluid">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                    <div class="about_content" >
                        <h2>Who We Are</h2>
                        <p class="text text-size-16"><strong><span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span></strong> is a digital-first platform built to simplify how people <i>connect</i> with trusted insurance professionals in their locality.</p>
                        <p class="text text-size-16">In India, insurance is not just about policies - it’s about <strong>trust, service, and long-term relationships</strong>.</p>
                        <p class="text text-size-16">We believe every customer deserves access to a verified, responsive, and knowledgeable insurance advisor who stands by them not only at the time of purchase, but especially during claims and service.</p>
                        <p class="text text-size-16"><strong><span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span> bridges the gap between Insurance Seekers and Licensed Insurance Agents, making the discovery process transparent, structured, and location-based.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why We Exist -->
    <section class="why-exist-con position-relative py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_content text-center" >
                        <h2>Why We Exist</h2>
                        <p class="text text-size-16">The insurance ecosystem often faces three common challenges:</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box text-center p-4 h-100 shadow-sm bg-white rounded">
                        <i class="fa-solid fa-user-xmark fs-2 mb-3 text-primary"></i>
                        <p class="text-size-16">Customers struggle to find reliable and accessible agents nearby</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box text-center p-4 h-100 shadow-sm bg-white rounded">
                        <i class="fa-solid fa-eye-slash fs-2 mb-3 text-primary"></i>
                        <p class="text-size-16">Good agents lack structured digital visibility</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mx-auto">
                    <div class="service-box text-center p-4 h-100 shadow-sm bg-white rounded">
                        <i class="fa-solid fa-chart-line fs-2 mb-3 text-primary"></i>
                        <p class="text-size-16">Service quality varies and is difficult to evaluate beforehand</p>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 text-center">
                    <p class="text text-size-16"><strong><span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span></strong> is designed to address these challenges by creating a verified, structured, and technology-enabled ecosystem that benefits both customers and agents.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="what-we-do-con position-relative py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about_content" >
                        <h2>What We Do</h2>
                        <p class="text text-size-16">We provide a platform where:</p>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fa-solid fa-check-circle text-success me-2"></i> Customers can discover agents based on location and service segments</li>
                            <li class="mb-3"><i class="fa-solid fa-check-circle text-success me-2"></i> Agents can showcase expertise across life, health, motor, and general insurance</li>
                            <li class="mb-3"><i class="fa-solid fa-check-circle text-success me-2"></i> Profiles reflect transparency through structured information</li>
                            <li class="mb-3"><i class="fa-solid fa-check-circle text-success me-2"></i> Service expectations are clearly defined</li>
                        </ul>
                        <p class="text text-size-16 mt-4">We focus on empowering agents with <strong>digital presence</strong> while helping customers make informed decisions.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('img/aboutpage-image1.jpg') }}" alt="What We Do" class="img-fluid rounded shadow" style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>
    <!-- Vision & Mission -->
    <section class="about-page benefit-con aboutbenefit-con position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="benefit_content" >
                        <h2>Our Vision</h2>
                        <p class="text text-size-18">To build India’s most trusted hyperlocal insurance discovery and service platform - where every policy comes with assurance of responsible guidance and ongoing support.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="benefit_content" >
                        <h2>Our Mission</h2>
                        <ul class="list-unstyled">
                            <li class="mb-2 text-size-18"><i class="fa-solid fa-bullseye text-primary me-2"></i> Digitally empower insurance agents.</li>
                            <li class="mb-2 text-size-18"><i class="fa-solid fa-bullseye text-primary me-2"></i> Promote transparency and accountability.</li>
                            <li class="mb-2 text-size-18"><i class="fa-solid fa-bullseye text-primary me-2"></i> Strengthen trust in insurance advisory.</li>
                            <li class="mb-2 text-size-18"><i class="fa-solid fa-bullseye text-primary me-2"></i> Enable better access to insurance knowledge and service.</li>
                        </ul>
                    </div>
                </div>
                
                {{-- <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="benefit_wrapper position-relative" >
                        <ul class="list-unstyled mb-0">
                            <li class="beneft-box">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-users h-12 w-12 md:h-14 md:w-14 mx-auto mb-4 text-primary"
                                        aria-hidden="true" data-lov-id="src/pages/AboutUs.tsx:40:16"
                                        data-lov-name="Users" data-component-path="src/pages/AboutUs.tsx"
                                        data-component-line="40" data-component-file="AboutUs.tsx"
                                        data-component-name="Users"
                                        data-component-content="%7B%22className%22%3A%22h-12%20w-12%20md%3Ah-14%20md%3Aw-14%20mx-auto%20mb-4%20text-primary%22%7D">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </figure>
                                <h5>10,000+</h5>
                                <p class="text-size-16 mb-0">Verified Agents</p>
                            </li>
                            <li class="beneft-box">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-heart h-12 w-12 md:h-14 md:w-14 mx-auto mb-4 text-primary"
                                        aria-hidden="true" data-lov-id="src/pages/AboutUs.tsx:45:16"
                                        data-lov-name="Heart" data-component-path="src/pages/AboutUs.tsx"
                                        data-component-line="45" data-component-file="AboutUs.tsx"
                                        data-component-name="Heart"
                                        data-component-content="%7B%22className%22%3A%22h-12%20w-12%20md%3Ah-14%20md%3Aw-14%20mx-auto%20mb-4%20text-primary%22%7D">
                                        <path
                                            d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5">
                                        </path>
                                    </svg>
                                </figure>
                                <h5>50,000+</h5>
                                <p class="text-size-16 mb-0">Happy Clients</p>
                            </li>
                            <li class="beneft-box">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-award h-12 w-12 md:h-14 md:w-14 mx-auto mb-4 text-primary"
                                        aria-hidden="true" data-lov-id="src/pages/AboutUs.tsx:50:16"
                                        data-lov-name="Award" data-component-path="src/pages/AboutUs.tsx"
                                        data-component-line="50" data-component-file="AboutUs.tsx"
                                        data-component-name="Award"
                                        data-component-content="%7B%22className%22%3A%22h-12%20w-12%20md%3Ah-14%20md%3Aw-14%20mx-auto%20mb-4%20text-primary%22%7D">
                                        <path
                                            d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                                        </path>
                                        <circle cx="12" cy="8" r="6"></circle>
                                    </svg>
                                </figure>
                                <h5>95%</h5>
                                <p class="text-size-16 mb-0">Claim Success Rate</p>
                            </li>
                            <li class="beneft-box">
                                <figure class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-up h-12 w-12 md:h-14 md:w-14 mx-auto mb-4 text-primary"
                                        aria-hidden="true" data-lov-id="src/pages/AboutUs.tsx:55:16"
                                        data-lov-name="TrendingUp" data-component-path="src/pages/AboutUs.tsx"
                                        data-component-line="55" data-component-file="AboutUs.tsx"
                                        data-component-name="TrendingUp"
                                        data-component-content="%7B%22className%22%3A%22h-12%20w-12%20md%3Ah-14%20md%3Aw-14%20mx-auto%20mb-4%20text-primary%22%7D">
                                        <path d="M16 7h6v6"></path>
                                        <path d="m22 7-8.5 8.5-5-5L2 17"></path>
                                    </svg>
                                </figure>
                                <h5>100+</h5>
                                <p class="text-size-16 mb-0">Cities Covered</p>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="service-con about-service position-relative py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-12 mx-auto">
                    <div class="service_content text-center" >
                        <h2>Our Core Values</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4" >
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-box h-100 shadow-sm border-0">
                        <figure class="icon">
                           <i class="fa-solid fa-handshake text-primary fs-2"></i>
                        </figure>
                        <h4>Trust First</h4>
                        <p class="text-size-16">Insurance is built on credibility. We prioritize ethical practices and transparent representation.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-box h-100 shadow-sm border-0">
                        <figure class="icon">
                           <i class="fa-solid fa-location-dot text-primary fs-2"></i>
                        </figure>
                        <h4>Local Connect</h4>
                        <p class="text-size-16">“Padosi” means neighbour — we believe service is strongest when it’s local and accessible.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-box h-100 shadow-sm border-0">
                        <figure class="icon">
                           <i class="fa-solid fa-microchip text-primary fs-2"></i>
                        </figure>
                        <h4>Empowerment Through Technology</h4>
                        <p class="text-size-16">We use digital tools to help agents grow and customers choose wisely.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-box h-100 shadow-sm border-0">
                        <figure class="icon">
                           <i class="fa-solid fa-headset text-primary fs-2"></i>
                        </figure>
                        <h4>Service Commitment</h4>
                        <p class="text-size-16">Insurance is not just selling; it’s long-term service and support.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- For Seekers & Agents -->
    <section class="seekers-agents-con position-relative py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="about_content p-4 bg-white rounded shadow-sm h-100" >
                        <h3>For Insurance Seekers</h3>
                        <p class="text-size-16">If you are looking to:</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Buy a new insurance policy</li>
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Review your existing coverage</li>
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Seek claim assistance</li>
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Get professional guidance</li>
                        </ul>
                        <p class="text-size-16 mt-3"><strong><span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span></strong> helps you connect with a suitable advisor in your area.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="about_content p-4 bg-white rounded shadow-sm h-100" >
                        <h3>For Insurance Agents</h3>
                        <p class="text-size-16">If you are a licensed insurance professional looking to:</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Increase digital visibility</li>
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Connect with customers actively searching for insurance solutions</li>
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Build structured credibility</li>
                            <li class="mb-2"><i class="fa-solid fa-caret-right text-primary me-2"></i> Strengthen your personal brand</li>
                        </ul>
                        <p class="text-size-16 mt-3"><strong><span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span></strong> provides a platform to showcase your expertise and grow responsibly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Commitment -->
    <section class="commitment-con position-relative py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <div class="about_content" >
                        <h2>Our Commitment</h2>
                        <p class="text text-size-18"><span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span> does not replace insurers, brokers, or regulatory authorities. We operate as a facilitative digital platform connecting users with licensed professionals, promoting responsible engagement within the insurance ecosystem.</p>
                        <div class="mt-5 p-4 bg-white rounded shadow text-center border-top border-primary" style="border-top-width: 4px !important;">
                            <h4 class="text-dark mb-3">If you believe insurance is not just a product but a responsibility</h4>
                            <h3 class="mb-0">Welcome to <span style="color: #18529d;">Padosi</span><span style="color: #0f5634;">Agent</span>.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
