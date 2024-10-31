@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <section class="bg-white">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">About OrenCollaboration</h2>
                <div class="prose sm:prose-lg">
                    {!! $aboutContent->main_description !!}
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <!-- Image 1 Container -->
                <div class="relative w-full">
                    <!-- Placeholder/Loader -->
                    <div class="absolute inset-0 animate-pulse rounded-lg"></div>
                    
                    <!-- Image 1 -->
                    <img 
                        class="w-full rounded-lg opacity-0 transition-opacity duration-300" 
                        src="{{ asset('storage/' . $aboutContent->hero_img) }}" 
                        alt="Event planning 1"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                    >
                </div>
    
                <!-- Image 2 Container -->
                <div class="relative w-full">
                    <!-- Placeholder/Loader -->
                    <div class="absolute inset-0 animate-pulse rounded-lg mt-4 lg:mt-10"></div>
                    
                    <!-- Image 2 -->
                    <img 
                        class="mt-4 w-full lg:mt-10 rounded-lg opacity-0 transition-opacity duration-300" 
                        src="{{ asset('storage/' . $aboutContent->hero_img2) }}" 
                        alt="Event planning 2"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section with Flowbite Components -->
    <section class="bg-white">
        <div class="py-16 px-4 mx-auto max-w-screen-xl sm:py-24 lg:px-6">
            <div class="max-w-screen-md mb-12 text-center mx-auto">
                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md mb-4">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    Our Purpose
                </span>
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Vision & Mission</h2>
                <p class="text-gray-500 sm:text-xl">{{ $aboutContent->vision_mission_section_description }}</p>
            </div>

            <!-- Vision Section -->
            <div class="mb-16 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">Our Vision</h3>
                        <p class="text-gray-500 sm:text-lg sm:pr-1">{{ $vision->vision }}</p>
                    </div>
                    <!-- Stats -->
                    <div class="items-center sm:flex">
                        <div class="mb-4 sm:mb-0 sm:mr-6">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 mb-1 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                                <div class="ml-2">
                                    <h4 class="text-xl font-bold text-gray-900">{{ $vision->events_completed }}+</h4>
                                    <p class="text-sm text-gray-500">Events Completed</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <svg class="w-8 h-8 mb-1 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                                <div class="ml-2">
                                    <h4 class="text-xl font-bold text-gray-900">{{ $vision->client_satisfaction }}%</h4>
                                    <p class="text-sm text-gray-500">Client Satisfaction</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission Section -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
                <h3 class="mb-4 text-xl font-bold text-gray-900">Our Mission</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($missionCards as $card)
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="inline-flex items-center justify-center w-12 h-12 mr-3 rounded-full bg-primary-100">
                                <i class="{{ $card->icon }} text-xl text-primary-600"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900">{{ $card->mission_title }}</h4>
                        </div>
                        <p class="text-gray-500">{{ $card->mission }}</p>
                        <div class="mt-4">
                            <button data-modal-target="missionModal{{ $card->id }}" data-modal-toggle="missionModal{{ $card->id }}" class="inline-flex items-center text-primary-600 hover:underline">
                                Learn more
                                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal for each mission card -->
                    <div id="missionModal{{ $card->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                    <div class="flex items-center gap-3">
                                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100">
                                            <i class="{{ $card->icon }} text-lg text-primary-600"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            {{ $card->mission_title }}
                                        </h3>
                                    </div>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="missionModal{{ $card->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-6">
                                    <div class="prose prose-sm max-w-none prose-headings:mb-4 prose-p:mb-4 prose-ul:mb-4 prose-ol:mb-4">
                                        {!! $card->mission_detail !!}
                                    </div>
                                </div>
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                    <button type="button" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Get started</button>
                                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" data-modal-hide="missionModal{{ $card->id }}">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <!-- Header Section -->
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-3xl md:text-4xl tracking-tight font-extrabold text-gray-900">Our Team</h2>
                <p class="font-light text-gray-500 text-base sm:text-lg md:text-xl">{{ $aboutContent->team_section_description }}</p>
            </div>
    
            <!-- Team Grid -->
            <div class="grid gap-8 mb-6 lg:mb-16 grid-cols-1 lg:grid-cols-2">
                @forelse($teamMembers->where('is_active', true)->sortBy('display_order') as $member)
                <div class="bg-gray-50 rounded-lg shadow flex flex-col sm:flex-row">
                    <!-- Image Container -->
                    <div class="w-full sm:w-1/2 md:w-2/5 lg:w-5/12 overflow-hidden relative">
                        <!-- Placeholder/Loader -->
                        <div class="absolute inset-0 animate-pulse rounded-lg bg-gray-200"></div>
                        
                        <!-- Image -->
                        <img 
                            class="w-full h-56 lg:h-full object-cover rounded-lg cursor-pointer hover:scale-110 transition duration-300 opacity-0" 
                            src="{{ asset('storage/' . $member->image) }}" 
                            alt="{{ $member->name }}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()"
                        >
                    </div>
    
                    <!-- Content Container -->
                    <div class="flex flex-col justify-between p-4 sm:p-5 lg:p-6 w-full sm:w-1/2 md:w-3/5 lg:w-7/12">
                        <div>
                            <h3 class="text-xl font-bold tracking-tight text-gray-900 mb-1">
                                {{ $member->name }}
                            </h3>
                            <span class="text-gray-500 text-sm md:text-base">{{ $member->position }}</span>
                            <p class="mt-3 mb-4 font-light text-gray-500 text-sm md:text-base">{{ $member->description }}</p>
                        </div>
    
                        <!-- Social Media Links -->
                        <ul class="flex flex-wrap gap-4">
                            @if($member->facebook_url)
                            <li>
                                <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener noreferrer" 
                                   class="text-gray-500 hover:text-gray-900 transition-colors duration-200 inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Facebook</span>
                                </a>
                            </li>
                            @endif
                            @if($member->twitter_url)
                            <li>
                                <a href="{{ $member->twitter_url }}" target="_blank" rel="noopener noreferrer" 
                                   class="text-gray-500 hover:text-gray-900 transition-colors duration-200 inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                    </svg>
                                    <span class="sr-only">Twitter</span>
                                </a>
                            </li>
                            @endif
                            @if($member->instagram_url)
                            <li>
                                <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener noreferrer" 
                                   class="text-gray-500 hover:text-gray-900 transition-colors duration-200 inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Instagram</span>
                                </a>
                            </li>
                            @endif
                            @if($member->tiktok_url)
                            <li>
                                <a href="{{ $member->tiktok_url }}" target="_blank" rel="noopener noreferrer" 
                                   class="text-gray-500 hover:text-gray-900 transition-colors duration-200 inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
                                    </svg>
                                    <span class="sr-only">TikTok</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">No team members found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection