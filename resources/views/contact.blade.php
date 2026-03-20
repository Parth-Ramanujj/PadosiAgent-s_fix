@extends('layouts.app')

@section('content')
<div class="sub_banner position-relative">
    @include('layouts.header')
    <!-- Sub banner -->
    <section class="sub_banner_con sub-contact-banner position-relative">
        <div class="container position-relative">
            <div class="row">
                <div class="col-xl-8 col-lg-9 col-12 mx-auto">
                    <div class="sub_banner_content" data-aos="fade-up">
                        <h1 class="text-white">Contact Us</h1>
                        {{-- <p class="text-white text-size-18">Zuis aute irure dolor in reprehenderit in voluptate velit esse cillum pariatur non proident aute irure.</p> --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Contact Info -->
{{-- <section class="contactinfo-con">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contactinfo_content text-center" data-aos="fade-up">
                    <h6>Reach Us</h6>
                    <h2>Our Contact Information</h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box">
                    <figure class="icon">
                        <img src="{{ asset('img/contact-icon1.png') }}" alt="image" class="img-fluid">
                    </figure>
                    <h4>Our Location</h4>
                    <p class="text-size-16">Ahmedabad - 380009 Gujarat, India</p>
                    <div class="clearfix"></div>
                    <a href="https://www.google.com/maps/place/Ahmedabad,+Gujarat,+India" 
                        class="text-decoration-none button">Get Directions<i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box">
                    <figure class="icon">
                        <img src="{{ asset('img/contact-icon2.png') }}" alt="image" class="img-fluid">
                    </figure>
                    <h4>Phone Number</h4>
                    <a href="tel:+919601271988" class="mb-2 text-decoration-none text-size-16">+91 9601271988</a>
                    <div class="clearfix"></div>
                    <a href="tel:+919601271988" class="text-decoration-none button">Call us Now<i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box mb-0">
                    <figure class="icon">
                        <img src="{{ asset('img/contact-icon3.png') }}" alt="image" class="img-fluid">
                    </figure>
                    <h4>Our Email</h4>
                    <a href="mailto:support@padosiagent.com" class="mb-2 text-decoration-none text-size-16">support@padosiagent.com</a>
                    <div class="clearfix"></div>
                    <a href="mailto:support@padosiagent.com" class="text-decoration-none button">Email us<i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>         
        </div>
    </div>
</section> --}}
<!-- Contact -->
<section class="contact-con">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="contact_content" data-aos="fade-up">
                    <h6>Reach Us</h6>
                    <h2>Secure Your Family Future With us.</h2>
                    <p class="text-size-18 mb-0">Have questions or need assistance? Reach out to us today for expert guidance on securing your family's future.</p>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="contact_form" data-aos="fade-up">
                    <div id="form_result" class="mb-3 contact-message" style="display:none;"></div>
                    <form id="contactpage" method="POST" action="{{ route('contact.submit') }}" hx-boost="false" data-hx-boost="false" hx-disable>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-unstyled mb-0">
                                    <li class="w-100 mb-3">
                                        <div class="form-group mb-0 position-relative">
                                            <label for="name" class="font-weight-bold text-dark mb-1 d-block text-left">Full Name *</label>
                                            <input type="text" class="form_style w-100" placeholder="Enter your full name" name="name" id="name" required> 
                                        </div>
                                    </li>
                                    <li class="w-100 mb-3">
                                        <div class="form-group mb-0 position-relative">
                                            <label for="email" class="font-weight-bold text-dark mb-1 d-block text-left">Email Address *</label>
                                            <input type="email" class="form_style w-100" placeholder="Enter your email address" name="email" id="email" required>
                                        </div>
                                    </li> 
                                    <li class="w-100 mb-3" style="clear: both;">
                                        <div class="form-group mb-0 position-relative">
                                            <label for="mobile" class="font-weight-bold text-dark mb-1 d-block text-left">Phone Number *</label>
                                            <input type="tel" class="form_style w-100" placeholder="Enter your 10-digit phone number" name="mobile" id="mobile"
                                            oninput="this.value = this.value.replace(/[^0-9]/g,'')" maxlength="10"
                                            pattern="[0-9]{10}" required>
                                        </div>
                                    </li>
                                    <li class="w-100 mb-3">
                                        <div class="form-group mb-0 position-relative">
                                            <label for="subject" class="font-weight-bold text-dark mb-1 d-block text-left">Subject *</label>
                                            <input type="text" class="form_style w-100" placeholder="What is this regarding?" name="subject" id="subject" required> 
                                        </div>
                                    </li>
                                    <li class="w-100 mb-4" style="clear: both;">
                                        <div class="form-group message mb-0 position-relative">
                                            <label for="message" class="font-weight-bold text-dark mb-1 d-block text-left">Message *</label>
                                            <textarea class="form_style w-100" placeholder="Tell us how we can help..." rows="4" name="message" id="message" required></textarea>
                                        </div>
                                    </li>
                                    <li class="button w-100" style="clear: both;">
                                        <div class="manage-button">
                                            <button type="submit" id="submit" class="submit_now text-white text-decoration-none w-100 text-center">Submit Now<i class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>            
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
