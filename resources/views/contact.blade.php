@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="bg-white">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">Contact Us</h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 sm:text-xl">Ready to bring your
                event to life? Get in touch with us today and let's start planning your unforgettable experience.</p>
            <form action="https://formspree.io/f/xkgngzol" method="POST" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your
                        email</label>
                    <input type="email" name="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        placeholder="name@example.com" required>
                </div>
                <div>
                    <label for="subject"
                        class="block mb-2 text-sm font-medium text-gray-900">Subject</label>
                    <input type="text" name="subject" id="subject"
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Let us know how we can help you" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your
                        message</label>
                    <textarea id="message" name="message" rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Leave a comment..."></textarea>
                </div>
                <button type="submit"
                    class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-orange-600 sm:w-fit hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300">Send
                    message</button>
            </form>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Get in Touch</h2>
                <p class="text-gray-500 sm:text-xl">We'd love to hear from you. Here's how you can reach
                    us...</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Address</h3>
                    <p class="text-gray-500">{{ $contact->address }}</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Phone</h3>
                    <p class="text-gray-500">{{ $contact->phone }}</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Email</h3>
                    <p class="text-gray-500">{{ $contact->email }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Find Us</h2>
                <p class="text-gray-500 sm:text-xl">Visit our office or the venue of your choice. We're
                    always ready to meet and discuss your event needs.</p>
            </div>
            <div class="bg-gray-300 h-96 rounded-lg overflow-hidden">
                <!-- Map container with responsive iframe -->
                <div class="relative w-full h-full">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d318175.4385312267!2d117.01071916398166!3d-0.5093405526793147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5d57d33074935%3A0xef64e9b06c7ad3e7!2sSamarinda%20City%2C%20East%20Kalimantan!5e1!3m2!1sen!2sid!4v1730272049224!5m2!1sen!2sid"
                        class="absolute top-0 left-0 w-full h-full object-cover" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
