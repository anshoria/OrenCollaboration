@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero section with carousel -->
    <section class="bg-white overflow-hidden" data-aos="fade">
        <div class="hero-swiper swiper relative w-full h-[300px] sm:h-[450px]">
            <div class="swiper-wrapper">
                @foreach ($carousels as $carousel)
                    <div class="hero-slide swiper-slide pb-1">
                        <div class="relative h-full w-full rounded-2xl overflow-hidden shadow-lg">
                            <div class="relative h-full w-full">
                                <div class="absolute inset-0 animate-pulse rounded-2xl bg-gray-200"></div>
                                
                                <img 
                                    src="{{ asset('storage/' . $carousel->image) }}"
                                    class="hero-image w-full h-full object-cover opacity-0 transition-opacity duration-300"
                                    alt="{{ $carousel->title ?? 'Carousel Image' }}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                                >
            
                                @if ($carousel->title || $carousel->description)
                                    <div class="hero-content absolute inset-0 flex items-end justify-center bg-gradient-to-t from-black/80 via-black/40 to-transparent rounded-2xl">
                                        <div class="hero-text text-center text-white p-8 md:p-12 w-full max-w-4xl">
                                            @if ($carousel->title)
                                                <h2 class="hero-title text-2xl sm:text-3xl lg:text-4xl font-bold mb-4">
                                                    {{ $carousel->title }}
                                                </h2>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Arrows -->
            <div class="hero-navigation absolute inset-x-4 top-1/2 z-50 flex items-center justify-between -translate-y-1/2 pointer-events-none">
                <button class="hero-prev swiper-button-prev !static !w-12 !h-12 rounded-full bg-black/20 backdrop-blur-lg pointer-events-auto hover:bg-black/40 transition-colors duration-300 group">
                    <svg class="w-6 h-6 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="hero-next swiper-button-next !static !w-12 !h-12 rounded-full bg-black/20 backdrop-blur-lg pointer-events-auto hover:bg-black/40 transition-colors duration-300 group">
                    <svg class="w-6 h-6 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Custom Bullets -->
            <div class="hero-pagination-container absolute bottom-5 sm:bottom-6 left-1/2 -translate-x-1/2 z-50">
                <div class="hero-pagination swiper-pagination !relative !bottom-0 !flex gap-2 bg-black/20 backdrop-blur-lg px-3 py-2 rounded-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Features section -->
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16" data-aos="zoom-in">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Why Choose OrenCollaboration?</h2>
                <p class="text-gray-500 sm:text-xl">{{ $home->main_subheading }}</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                @foreach ($features as $feature)
                    <div data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                            <i class="{{ $feature->icon }} text-xl text-primary-600"></i>
                        </div>
                        <h3 class="mb-2 text-xl font-bold">{{ $feature->title }}</h3>
                        <p class="text-gray-500">{{ $feature->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonial section -->
    <section class="bg-white py-8 sm:py-12 md:py-16 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div data-aos="zoom-in">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-900 mb-4">
                    Apa Kata Klien Kami</h2>
                <p class="text-lg sm:text-xl text-center text-gray-600 mb-8 sm:mb-10 md:mb-12">
                    {{ $home->review_subheading }}
                </p>
            </div>

            <div class="relative testimonial-container px-4" data-aos="zoom-in">
                <div class="swiper testimonialSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide p-4">
                                <div class="bg-white rounded-xl shadow-lg p-6 relative transform transition-transform duration-300 h-full">
                                    <div class="absolute -top-4 -right-4 bg-primary-500 w-8 h-8 rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11.42 9.87c-.5 1.17-2 2.13-3.42 2.13-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4c0 .73-.2 1.41-.54 2l.96 4.89L9.5 14l1.92-4.13zM20.42 9.87c-.5 1.17-2 2.13-3.42 2.13-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4c0 .73-.2 1.41-.54 2l.96 4.89L18.5 14l1.92-4.13z" />
                                        </svg>
                                    </div>

                                    <div class="flex flex-col h-full">
                                        <p class="text-gray-700 mb-6 italic text-sm sm:text-base leading-relaxed">
                                            "{{ $testimonial->description }}"
                                        </p>

                                        <div class="mt-auto">
                                            <div class="flex items-center mb-4">
                                                @if ($testimonial->profile_img)
                                                    <img class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-100"
                                                        src="{{ asset('storage/' . $testimonial->profile_img) }}"
                                                        alt="{{ $testimonial->name }}">
                                                @endif
                                                <div class="ml-4">
                                                    <h3 class="font-bold text-gray-900">{{ $testimonial->name }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $testimonial->position }}</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $testimonial->star)
                                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev !w-10 !h-10 !bg-white !shadow-md !rounded-full"></div>
                    <div class="swiper-button-next !w-10 !h-10 !bg-white !shadow-md !rounded-full"></div>

                    <!-- Pagination -->
                    <div class="swiper-pagination !static mt-8"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center" data-aos="zoom-in">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900">
                    {{ $home->cta_title }}
                </h2>
                <p class="mb-6 text-gray-500 md:text-lg">
                    {{ $home->cta_description }}
                </p>
                <a href="{{ route('contact') }}"
                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
