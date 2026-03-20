<section class="footer-con position-relative">
    <div class="container position-relative">
        <div class="middle_portion">
            <div class="row">
                <div class="col-xl-12 col-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="logo-content">
                                <a href="{{ url('/') }}" class="footer-logo">
                                    <figure class="mb-0"><img src="{{ asset('img/logo.png') }}" alt="image"></figure>
                                </a>
                                <p class="text-size-14 mb-0">Connecting clients with the right insurance agents in
                                    their neighborhood.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <div class="links">
                                <h4 class="heading">Useful Links</h4>
                                <ul class="list-unstyled mb-0">
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ url('/') }}"
                                            class="text-decoration-none">Home</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ url('/find-agents') }}"
                                            class="text-decoration-none">Find Agents</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ url('/about') }}"
                                            class="text-decoration-none">About Us</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ url('/contact') }}"
                                            class="text-decoration-none">Contact Us</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ url('/faq') }}"
                                            class="text-decoration-none">FAQs</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="#"
                                            class="text-decoration-none">Insurance Blog</a></li>
                                    <!-- <li><i class="fa-solid fa-circle"></i><a href="#"
                                            class="text-decoration-none">Calculators</a></li> -->
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ route('agent.login') }}"
                                            class="text-decoration-none">Agent Login</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ route('agent.registration') }}"
                                            class="text-decoration-none">Agent Register</a></li>
                                    <li><i class="fa-solid fa-circle"></i><a href="{{ route('client.login') }}"
                                            class="text-decoration-none">Client Login</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <div class="contact">
                                <h4 class="heading">Contact Info</h4>
                                <ul class="list-unstyled mb-0">
                                    {{-- <li class="text">
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="tel:+61383766284" class="text-decoration-none">+91 9601271988</a>
                                    </li> --}}
                                    <li class="text">
                                        <i class="fa-solid fa-envelope"></i>
                                        <a href="mailto:support@padosiagent.com" target="_blank"
                                            class="text-decoration-none">support@padosiagent.com</a>
                                    </li>
                                    <li class="text">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <a href="https://www.google.com/maps/place/23%C2%B001'51.8%22N+72%C2%B033'60.0%22E/@23.0310504,72.5640791,17z/data=!3m1!4b1!4m4!3m3!8m2!3d23.0310504!4d72.566654?hl=en&entry=ttu&g_ep=EgoyMDI2MDIxMS4wIKXMDSoASAFQAw%3D%3D" 
                                           target="_blank" class="text-decoration-none address mb-0">
                                            Ahmedabad - 380009 Gujarat, India
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                            <div class="icon">
                                <h4 class="heading">Social Networks</h4>
                                <ul class="list-unstyled mb-0 social-icons">
                                    <li><a href="https://www.facebook.com/PadosiAgent/" target="_blank" class="text-decoration-none"><i
                                                class="fa-brands fa-facebook-f social-networks"></i></a></li>
                                    <li><a href="https://x.com/PadosiAgent" target="_blank" class="text-decoration-none"><i
                                                class="fa-brands fa-x-twitter social-networks"
                                                aria-hidden="true"></i></a></li>
                                    <li>
                                        <a href="https://www.instagram.com/padosiagent/" target="_blank" class="text-decoration-none">
                                            <i class="fa-brands fa-instagram social-networks"></i>
                                        </a>
                                    </li>
                                    <li><a href="https://www.linkedin.com/company/padosiagent/" target="_blank" class="text-decoration-none"><i
                                                class="fa-brands fa-linkedin-in social-networks"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p class="mb-0">© 2026 PadosiAgent Servtech Pvt Ltd. All rights reserved.</p>
    </div>
</section>
