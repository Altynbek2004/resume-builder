@extends('layouts.app')

@section('title', $resume->title)

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-indigo-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-indigo-700 mb-4 md:mb-0">Resume Preview</h1>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('resume.pdf', $resume) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Generate PDF
                    </a>
                    <a href="{{ route('resume.edit', $resume) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Resume
                    </a>
                    <a href="{{ route('resume.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Resumes
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-8 text-white">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                        <!-- Фото -->
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $resume->photo_path) }}" alt="Photo" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                        </div>

                        <!-- Информация -->
                        <div>
                            <h2 class="text-3xl font-bold">{{ $resume->title }}</h2>
                            <h4 class="text-xl mt-2 text-indigo-100">Job position: {{ $resume->position }}</h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-sm">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $resume->email }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span>{{ $resume->phone }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $resume->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="p-6">

                    {{-- Summary --}}
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5.121 17.804A8 8 0 0112 15a8 8 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Full Name
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <p class="text-gray-700 leading-relaxed">{{ $resume->full_name }}</p>
                        </div>
                    </div>

                    {{-- Summary --}}
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Professional Summary
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <p class="text-gray-700 leading-relaxed">{{ $resume->about }}</p>
                        </div>
                    </div>

                    {{-- Experience --}}
                    @if($resume->experiences->count())
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-purple-700 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Work Experience
                            </h3>
                            <div class="space-y-6">
                                @foreach($resume->experiences as $experience)
                                    <div class="bg-white rounded-lg p-4 border-l-4 border-purple-500 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                            <div>
                                                <h4 class="text-lg font-medium text-gray-900">{{ $experience->position }}</h4>
                                                <p class="text-gray-600 font-medium">{{ $experience->company }}</p>
                                            </div>
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-2 md:mt-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $experience->start_date->format('M Y') }} –
                                                @if($experience->is_current)
                                                    <span class="text-green-600 font-semibold ml-1">Present</span>
                                                @else
                                                    {{ $experience->end_date->format('M Y') }}
                                                @endif
                                            </div>
                                        </div>
                                        <p class="mt-3 text-gray-700">{{ $experience->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Education --}}
                    @if($resume->educations->count())
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-blue-700 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                                Education
                            </h3>
                            <div class="space-y-6">
                                @foreach($resume->educations as $edu)
                                    <div class="bg-white rounded-lg p-4 border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                            <div>
                                                <h4 class="text-lg font-medium text-gray-900">{{ $edu->degree }}</h4>
                                                <p class="text-gray-600 font-medium">{{ $edu->institution }}</p>
                                            </div>
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-2 md:mt-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $edu->start_date->format('M Y') }} –
                                                @if($edu->is_current)
                                                    <span class="text-green-600 font-semibold ml-1">Present</span>
                                                @else
                                                    {{ $edu->end_date->format('M Y') }}
                                                @endif
                                            </div>
                                        </div>
                                        <p class="mt-3 text-gray-700">{{ $edu->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Skills --}}
                    @if($resume->skills->count())
                        <div>
                            <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                Skills
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-5 border border-gray-100">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($resume->skills as $skill)
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span class="font-medium text-gray-800">{{ $skill->name }}</span>
                                                <span class="text-gray-600 text-sm">{{ $skill->level}}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $skill->level}}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
