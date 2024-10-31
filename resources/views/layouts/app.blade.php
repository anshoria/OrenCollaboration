<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ $settings->brand_name ?? 'OrenCollaboration' }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->brand_logo) }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 relative z-50">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="{{ route('home') }}" class="flex items-center">
                    @if($settings->brand_logo)
                        <!-- Logo Container -->
                        <div class="relative h-10 w-auto min-w-[100px]"> <!-- min-width untuk area loading -->
                            <!-- Placeholder/Loader -->
                            <div class="absolute inset-0 animate-pulse rounded bg-gray-200"></div>
                            
                            <!-- Logo Image -->
                            <img 
                                src="{{ asset('storage/' . $settings->brand_logo) }}" 
                                class="h-10 w-auto opacity-0 transition-opacity duration-300" 
                                alt="{{ $settings->brand_name }} Logo"
                                onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                            >
                        </div>
                    @endif
                </a>
                <div class="flex items-center lg:order-2">
                    <a href="{{ route('contact') }}" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">Get started</a>
                    <button id="menu-toggle" class="hamburger inline-flex flex-col justify-center items-center p-2 ml-1 w-10 h-10 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="line-1 w-6 h-0.5 bg-gray-500 transition-all duration-300 mb-1.5"></span>
                        <span class="line-2 w-6 h-0.5 bg-gray-500 transition-all duration-300 mb-1.5"></span>
                        <span class="line-3 w-6 h-0.5 bg-gray-500 transition-all duration-300"></span>
                    </button>
                </div>

                <!-- Enhanced Fullscreen Mobile Menu -->
                <div id="mobile-menu-2" class="menu-overlay fixed inset-0 bg-white z-40 lg:hidden flex flex-col">
                    <div class="relative flex flex-col items-center justify-center min-h-screen p-8">
                        <!-- Mobile Navigation -->
                        <ul class="flex flex-col items-center space-y-8 mb-12">
                            <li class="menu-item w-full text-center">
                                <a href="{{ route('home') }}" 
                                   class="group inline-flex items-center justify-center w-full py-3 text-3xl font-medium {{ request()->routeIs('home') ? 'text-orange-600' : '' }} transition-colors duration-200 hover:text-orange-600">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="menu-item w-full text-center">
                                <a href="{{ route('about') }}" 
                                   class="group inline-flex items-center justify-center w-full py-3 text-3xl font-medium {{ request()->routeIs('about') ? 'text-orange-600' : '' }} transition-colors duration-200 hover:text-orange-600">
                                    <span>About</span>
                                </a>
                            </li>
                            <li class="menu-item w-full text-center">
                                <a href="{{ route('services') }}" 
                                   class="group inline-flex items-center justify-center w-full py-3 text-3xl font-medium {{ request()->routeIs('services') ? 'text-orange-600' : '' }} transition-colors duration-200 hover:text-orange-600">
                                    <span>Services</span>
                                </a>
                            </li>
                            <li class="menu-item w-full text-center">
                                <a href="{{ route('projects') }}" 
                                   class="group inline-flex items-center justify-center w-full py-3 text-3xl font-medium {{ request()->routeIs('projects') ? 'text-orange-600' : '' }} transition-colors duration-200 hover:text-orange-600">
                                    <span>Projects</span>
                                </a>
                            </li>
                            <li class="menu-item w-full text-center">
                                <a href="{{ route('contact') }}" 
                                   class="group inline-flex items-center justify-center w-full py-3 text-3xl font-medium {{ request()->routeIs('contact') ? 'text-orange-600' : '' }} transition-colors duration-200 hover:text-orange-600">
                                    <span>Contact</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Mobile Social Links -->
                        <div class="flex justify-center space-x-8">
                            @if($settings->facebook)
                                <a href="{{ $settings->facebook }}" class="social-item text-gray-500 hover:text-orange-600 transform transition-all duration-200 hover:scale-110" target="_blank" rel="noopener">
                                    <i class="fab fa-facebook text-2xl" aria-hidden="true"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                            @endif

                            @if($settings->twiter)
                                <a href="{{ $settings->twiter }}" class="social-item text-gray-500 hover:text-orange-600 transform transition-all duration-200 hover:scale-110" target="_blank" rel="noopener">
                                    <i class="fab fa-twitter text-2xl" aria-hidden="true"></i>
                                    <span class="sr-only">Twitter</span>
                                </a>
                            @endif

                            @if($settings->instagram)
                                <a href="{{ $settings->instagram }}" class="social-item text-gray-500 hover:text-orange-600 transform transition-all duration-200 hover:scale-110" target="_blank" rel="noopener">
                                    <i class="fab fa-instagram text-2xl" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                            @endif

                            @if($settings->youtube)
                                <a href="{{ $settings->youtube }}" class="social-item text-gray-500 hover:text-orange-600 transform transition-all duration-200 hover:scale-110" target="_blank" rel="noopener">
                                    <i class="fab fa-youtube text-2xl" aria-hidden="true"></i>
                                    <span class="sr-only">YouTube</span>
                                </a>
                            @endif

                            @if($settings->tiktok)
                                <a href="{{ $settings->tiktok }}" class="social-item text-gray-500 hover:text-orange-600 transform transition-all duration-200 hover:scale-110" target="_blank" rel="noopener">
                                    <i class="fab fa-tiktok text-2xl" aria-hidden="true"></i>
                                    <span class="sr-only">TikTok</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex lg:w-auto lg:order-1">
                    <ul class="flex flex-row space-x-8 mt-0 font-medium">
                        <li>
                            <a href="{{ route('home') }}" class="block py-2 pr-4 pl-3 {{ request()->routeIs('home') ? 'text-orange-700' : 'text-gray-700' }} hover:text-orange-700 lg:p-0" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="block py-2 pr-4 pl-3 {{ request()->routeIs('about') ? 'text-orange-700' : 'text-gray-700' }} hover:text-orange-700 lg:p-0">About</a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="block py-2 pr-4 pl-3 {{ request()->routeIs('services') ? 'text-orange-700' : 'text-gray-700' }} hover:text-orange-700 lg:p-0">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('projects') }}" class="block py-2 pr-4 pl-3 {{ request()->routeIs('projects') ? 'text-orange-700' : 'text-gray-700' }} hover:text-orange-700 lg:p-0">Projects</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="block py-2 pr-4 pl-3 {{ request()->routeIs('contact') ? 'text-orange-700' : 'text-gray-700' }} hover:text-orange-700 lg:p-0">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="p-4 bg-white sm:p-6">
        <div class="mx-auto max-w-screen-xl">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ $settings->brand_name }}</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-10">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Resources</h2>
                        <ul class="text-gray-600">
                            <li class="mb-4">
                                <a href="{{ route('about') }}" class="hover:underline">About</a>
                            </li>
                            <li>
                                <a href="{{ route('services') }}" class="hover:underline">Services</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Follow us</h2>
                        <ul class="text-gray-600">
                            <li class="mb-4">
                                <a href="#" class="hover:underline ">Instagram</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Facebook</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="{{ route('home') }}" class="hover:underline">{{ $settings->brand_name }}™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0 gap-1">
                    @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" class="text-gray-500 hover:text-gray-900" target="_blank" rel="noopener">
                            <i class="fab fa-facebook text-lg" aria-hidden="true"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                    @endif
                    
                    @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" class="text-gray-500 hover:text-gray-900" target="_blank" rel="noopener">
                            <i class="fab fa-instagram text-lg" aria-hidden="true"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    @endif
                    @if($settings->twiter)
                        <a href="{{ $settings->twiter }}" class="text-gray-500 hover:text-gray-900" target="_blank" rel="noopener">
                            <i class="fab fa-twitter text-lg" aria-hidden="true"></i>
                            <span class="sr-only">Twitter</span>
                        </a>
                    @endif

                    @if($settings->tiktok)
                        <a href="{{ $settings->tiktok }}" class="text-gray-500 hover:text-gray-900" target="_blank" rel="noopener">
                            <i class="fab fa-tiktok text-lg" aria-hidden="true"></i>
                            <span class="sr-only">TikTok</span>
                        </a>
                    @endif
                    @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" class="text-gray-500 hover:text-gray-900" target="_blank" rel="noopener">
                            <i class="fab fa-youtube text-lg" aria-hidden="true"></i>
                            <span class="sr-only">YouTube</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>