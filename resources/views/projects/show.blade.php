@extends('layouts.app')

@section('title', 'Project Detail')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative h-96" data-aos="fade">
            <div class="relative h-full w-full overflow-hidden">
                <!-- Placeholder/Loader -->
                <div class="absolute inset-0 animate-pulse bg-gray-200"></div>
                <!-- Image -->
                <img 
                    class="w-full h-full object-cover opacity-0 transition-opacity duration-300"
                    src="{{ $project->banner_img ? asset('storage/' . $project->banner_img) : asset('storage/' . $project->cover_img) }}"
                    alt="{{ $project->title }}"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                >
                <!-- Overlay -->
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <!-- Content -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-4xl font-extrabold text-white mb-4">{{ $project->title }}</h1>
                        <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-full">
                            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $project->category }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Details -->
        <section class="py-16 px-4 mx-auto max-w-screen-xl lg:py-24">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2" data-aos="fade-right">
                    <h2 class="mb-4 text-3xl font-extrabold text-gray-900">Event Overview</h2>
                    <p class="mb-4 text-gray-600">{{ $project->overview }}</p>

                    <h3 class="mb-4 text-3xl font-extrabold text-gray-900">Key Highlights</h3>
                    <div class="mb-4 text-gray-600 prose max-w-none prose-headings:mb-4 prose-p:mb-4 prose-ul:mb-4 prose-ol:mb-4">
                        {!! $project->key_highlights !!}
                    </div>

                    <h3 class="mb-4 text-3xl font-extrabold text-gray-900">Our Approach</h3>
                    <div class="mb-4 text-gray-600 prose max-w-none prose-headings:mb-4 prose-p:mb-4 prose-ul:mb-4 prose-ol:mb-4">
                        {!! $project->approach !!}
                    </div>
                </div>

                <div class="md:col-span-1" data-aos="fade-left">
                    <div class="bg-gray-100 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Event Details</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Date: {{ date('F d, Y', strtotime($project->date)) }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Venue: {{ $project->venue }}</span>
                            </li>
                            @if ($project->attendees)
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-600">Attendees:
                                        {{ $project->attendees }}+</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        @if ($project->gallery)
            <section class="bg-white">
                <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                    <div class="max-w-screen-md mb-8 lg:mb-16" data-aos="zoom-in">
                        <h2 class="mb-4 text-3xl font-extrabold text-gray-900">Event Gallery</h2>
                        <p class="text-gray-500 sm:text-xl">Capturing the moments that made this event truly special.</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($project->gallery as $image)
                            <div class="h-48 md:h-96">
                                <div class="relative h-full w-full overflow-hidden rounded-lg">
                                    <!-- Placeholder/Loader -->
                                    <div class="absolute inset-0 animate-pulse bg-gray-200"></div>
                                    <!-- Image -->
                                    <img class="h-full w-full object-cover opacity-0 cursor-pointer hover:scale-110 transition duration-300"
                                        src="{{ asset('storage/' . $image) }}" alt="Event Image" loading="lazy"
                                        onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Testimonial -->
        @if ($project->review)
            <section class="py-16 px-4 mx-auto max-w-screen-xl">
                <div class="max-w-screen-md mx-auto text-center" data-aos="zoom-in">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                    </svg>
                    <blockquote>
                        <p class="text-xl sm:text-2xl font-medium text-gray-900">"{{ $project->review }}"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <div class="flex items-center divide-x-2 divide-gray-500">
                            <div class="pr-3 font-medium text-gray-900">{{ $project->reviewer }}</div>
                            <div class="pl-3 text-sm text-gray-500">{{ $project->company_review }}</div>
                        </div>
                    </figcaption>
                </div>
            </section>
        @endif
    </div>
@endsection