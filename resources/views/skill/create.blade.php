@extends('layouts.app')

@section('title', 'Add Skill')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Add Skill</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('skill.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Skill name</label>
                    <input type="text" id="name" name="name"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                           value="{{ old('name') }}">
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                    <input type="text" id="level" name="level"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('level') border-red-500 @enderror"
                           value="{{ old('level') }}">
                    @error('level')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Add Skill</button>
                    <a href="{{ route('resume.edit', $resume) }}"
                       class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const checkbox = document.getElementById('is_current');
        const endDateContainer = document.getElementById('end_date_container');
        const endDateInput = document.getElementById('end_date');

        function toggleEndDate() {
            if (checkbox.checked) {
                endDateContainer.classList.add('opacity-50');
                endDateInput.disabled = true;
            } else {
                endDateContainer.classList.remove('opacity-50');
                endDateInput.disabled = false;
            }
        }

        checkbox.addEventListener('change', toggleEndDate);
        window.addEventListener('DOMContentLoaded', toggleEndDate);
    </script>
@endsection
