<header class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <a class="navbar-brand" href="{{ url('/') }}">
                <figure class="logo mb-0"><img src="{{ asset('img/logo.png') }}" alt="image" class="img-fluid"></figure>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    @guest
                        {{-- Public menu items - only shown when not logged in --}}
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}"> Home </a>
                        </li>
                        <li class="nav-item {{ Request::is('faq') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/faq') }}">Faqs</a>
                        </li>
                        <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/about') }}">About Us</a>
                        </li>
                        <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                        </li>
                        {{-- Mobile-only menu items for guests --}}
                        <li class="nav-item d-lg-none">
                            <a class="nav-link" href="{{ url('/find-agents') }}">
                                <i class="fa-solid fa-search mr-2"></i>Find Agents
                            </a>
                        </li>
                    @endguest
                    
                    @auth
                        {{-- Role-specific mobile menu items --}}
                        @if(auth()->user()->role === 'agent')
                        <li class="nav-item d-lg-none {{ Request::is('agent/dashboard*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('agent.dashboard') }}">
                                <i class="fas fa-tachometer-alt mr-2"></i>My Dashboard
                            </a>
                        </li>
                        <li class="nav-item d-lg-none {{ Request::is('agent/edit-profile*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('agent.edit-profile') }}">
                                <i class="fas fa-user-edit mr-2"></i>Edit Profile
                            </a>
                        </li>
                        @else
                        <li class="nav-item d-lg-none {{ Request::is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home mr-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item d-lg-none {{ Request::is('find-agents') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('find.agents') }}">
                                <i class="fas fa-search mr-2"></i>Find Agents
                            </a>
                        </li>
                        @endif

                        <li class="nav-item d-lg-none">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form-mobile" class="m-0">
                                @csrf
                                <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-left">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Sign Out
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
                {{-- Desktop-only header buttons --}}
                <div class="header-right-btns d-none d-lg-flex align-items-center">
                    @guest
                        <a class="contact_us text-decoration-none mr-2" href="{{ url('/find-agents') }}">Find Agents<i
                                class="fa-solid fa-arrow-right"></i></a>
                    @endguest

                    @auth
                        <div class="dropdown">
                            <a class="contact_us text-decoration-none dropdown-toggle" href="#" role="button" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user-circle mr-2"></i>{{ auth()->user()->role === 'agent' ? 'Dashboard' : 'My Account' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 mt-2 rounded-lg" aria-labelledby="userMenu">
                                @if(auth()->user()->role === 'agent')
                                <a class="dropdown-item py-2" href="{{ route('agent.dashboard') }}">
                                    <i class="fas fa-tachometer-alt mr-2 text-primary"></i>My Dashboard
                                </a>
                                <a class="dropdown-item py-2" href="{{ route('agent.edit-profile') }}">
                                    <i class="fas fa-user-edit mr-2 text-info"></i>Edit Profile
                                </a>
                                @else
                                <a class="dropdown-item py-2" href="{{ route('home') }}">
                                    <i class="fas fa-home mr-2 text-primary"></i>Home
                                </a>
                                <a class="dropdown-item py-2" href="{{ route('find.agents') }}">
                                    <i class="fas fa-search mr-2 text-info"></i>Find Agents
                                </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>                    
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>
