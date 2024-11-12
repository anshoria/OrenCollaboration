@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <!-- Header Section -->
        <div class="max-w-screen-md mb-8 lg:mb-16" data-aos="zoom-in">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Our Services</h2>
            <p class="text-gray-500 sm:text-xl">{{ $mainDescription }}</p>
        </div>

        <!-- Services Grid -->
        <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
            @foreach($services as $service)
            <div data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                    <i class="{{ $service->icon }} text-xl text-primary-600"></i>
                </div>
                <h3 class="mb-2 text-xl font-bold">{{ $service->service_title }}</h3>
                <p class="text-gray-500">{{ $service->service_description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center" data-aos="zoom-in">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900">Let's Create Your Perfect Event</h2>
            <p class="mb-6 text-gray-500 md:text-lg">Ready to start planning your next event? Contact us today for a consultation.</p>
            <a href="{{ route('contact') }}" 
               class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                Get in Touch
            </a>
        </div>
    </div>
</section>
@endsection