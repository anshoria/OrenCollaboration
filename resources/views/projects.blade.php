@extends('layouts.app')

@section('title', 'Our Projects')

@section('content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Our Projects</h2>
                    <p class="font-light text-gray-500 lg:mb-16 sm:text-xl">
                        {{ $projectContent->main_description }}
                    </p>
                </div>

                <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                    @foreach ($projects as $project)
                        <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden flex flex-col lg:flex-row">
                            <div class="relative lg:w-2/5">
                                <!-- Image container -->
                                <div class="relative h-64 lg:h-full w-full">
                                    <!-- Placeholder/Loader -->
                                    <div class="absolute inset-0 animate-pulse" style="background-color: rgba(229, 231, 235, 0.5)"></div>
                                    <!-- Image -->
                                    <img 
                                        class="w-full h-full object-cover opacity-0 transition-opacity duration-300"
                                        src="{{ asset('storage/' . $project->cover_img) }}"
                                        alt="{{ $project->title }}"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                                    >
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50"></div>
                                    <!-- Category Badge -->
                                    <span class="absolute bottom-3 left-3 bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-full">
                                        <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $project->category }}
                                    </span>
                                </div>
                            </div>
                            <!-- Content section remains the same -->
                            <div class="p-5 flex flex-col justify-between lg:w-3/5">
                                <div>
                                    <h3 class="text-xl font-bold tracking-tight text-gray-900">
                                        <a href="#" class="hover:text-primary-600 transition-colors duration-300">{{ $project->title }}</a>
                                    </h3>
                                    <p class="mb-4 font-light text-gray-500">{{ $project->overview }}</p>
                                </div>
                                <a href="{{ route('projects.show', $project->id) }}"
                                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center focus:outline-none">
                                    View Details
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="bg-white">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
            <figure class="max-w-screen-md mx-auto">
                <svg class="h-12 mx-auto mb-3 text-gray-400" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor" />
                </svg>
                <blockquote>
                    <p class="text-xl sm:text-2xl font-medium text-gray-900">"{{ $projectContent->review }}"</p>
                </blockquote>
                <figcaption class="flex items-center justify-center mt-6 space-x-3">
                    <div class="flex items-center divide-x-2 divide-gray-500">
                        <div class="pr-1 sm:pr-3 font-medium text-gray-900">{{ $projectContent->reviewer }}</div>
                        <div class="pl-1 sm:pr-3 text-sm font-light text-gray-500">{{ $projectContent->company_review }}</div>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>
@endsection