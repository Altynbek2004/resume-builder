@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-bold text-2xl text-indigo-800 leading-tight">
            {{ __('My Resumes') }}
        </h2>
        <div class="flex space-x-3">
            <a href="{{ route('resume.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Create New Resume
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-indigo-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($resumes) && count($resumes) > 0)
                <div>
                    @foreach($resumes as $resume)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 mt-2">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $resume->title }}</h2>
                                <div class="flex items-center text-sm text-gray-500 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Created: {{ $resume->created_at->format('M d, Y') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Last updated: {{ $resume->updated_at->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-4">
                                <div class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('resume.show', $resume) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md shadow-sm text-xs font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('resume.edit', $resume) }}" class="inline-flex items-center px-3 py-1.5 bg-gray-600 border border-transparent rounded-md shadow-sm text-xs font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="{{ route('resume.pdf', $resume) }}" class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md shadow-sm text-xs font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        PDF
                                    </a>
                                    <form action="{{ route('resume.destroy', $resume) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md shadow-sm text-xs font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                onclick="return confirm('Are you sure you want to delete this resume?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-lg">You haven't created any resumes yet.</p>
                            <p class="mt-2">
                                <a href="{{ route('resume.create') }}" class="text-blue-700 font-medium hover:text-blue-900 underline">Create your first resume</a> now!
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

{{--@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            --}}{{-- Welcome Card --}}{{--
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 overflow-hidden shadow-xl sm:rounded-xl mb-6">
                <div class="p-8 sm:p-10">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-white sm:text-2xl">
                                {{ __("Welcome back, ") }} {{ Auth::user()->name }}!
                            </h2>
                            <p class="mt-2 text-sm text-indigo-100">
                                {{ __("You've successfully logged into your account. Here's an overview of your recent activity.") }}
                            </p>
                        </div>
                        <div class="hidden sm:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white opacity-25" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            --}}{{-- Stats --}}{{--
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                @php
                    $stats = [
                        ['label' => 'Projects', 'count' => 12, 'color' => 'indigo', 'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z'],
                        ['label' => 'Completed', 'count' => 8, 'color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Pending', 'count' => 4, 'color' => 'yellow', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Team Members', 'count' => 6, 'color' => 'pink', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-{{ $stat['color'] }}-100 rounded-md p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-{{ $stat['color'] }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500">{{ __($stat['label']) }}</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stat['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            --}}{{-- Activity --}}{{--
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __("Recent Activity") }}</h3>

                    <div class="space-y-4">
                        @php
                            $activities = [
                                ['initials' => 'JS', 'name' => 'John Smith', 'time' => '2 hours ago', 'desc' => 'Updated the project "Website Redesign" status to completed', 'color' => 'indigo'],
                                ['initials' => 'AD', 'name' => 'Alice Doe', 'time' => 'Yesterday', 'desc' => 'Created a new task "Update user documentation" in the Mobile App project', 'color' => 'green'],
                                ['initials' => 'RB', 'name' => 'Robert Brown', 'time' => '2 days ago', 'desc' => 'Added you to the API Integration project', 'color' => 'purple'],
                            ];
                        @endphp

                        @foreach ($activities as $activity)
                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-{{ $activity['color'] }}-500 flex items-center justify-center text-white font-bold">
                                        {{ $activity['initials'] }}
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $activity['name'] }}</h4>
                                        <p class="text-sm text-gray-500">{{ $activity['time'] }}</p>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">{{ $activity['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 text-center">
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('View all activity') }} →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection--}}
