@extends('layouts.app')

@section('title', 'Add Education')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Add Education</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('education.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">

                <div>
                    <label for="institution" class="block text-sm font-medium text-gray-700">Institution/School</label>
                    <input type="text" id="institution" name="institution"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('institution') border-red-500 @enderror"
                           value="{{ old('institution') }}">
                    @error('institution')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="degree" class="block text-sm font-medium text-gray-700">Degree/Certificate</label>
                    <input type="text" id="degree" name="degree"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('degree') border-red-500 @enderror"
                           value="{{ old('degree') }}">
                    @error('degree')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="field_of_study" class="block text-sm font-medium text-gray-700">Field of Study</label>
                    <input type="text" id="field_of_study" name="field_of_study"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('field_of_study') border-red-500 @enderror"
                           value="{{ old('field_of_study') }}">
                    @error('field_of_study')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="month" id="start_date" name="start_date"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('start_date') border-red-500 @enderror"
                               value="{{ old('start_date') }}">
                        @error('start_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="end_date_container">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="month" id="end_date" name="end_date"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('end_date') border-red-500 @enderror"
                               value="{{ old('end_date') }}">
                        @error('end_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_current" name="is_current" value="1"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                        {{ old('is_current') ? 'checked' : '' }}>
                    <label for="is_current" class="ml-2 block text-sm text-gray-700">I am currently studying here</label>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Add Education</button>
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
