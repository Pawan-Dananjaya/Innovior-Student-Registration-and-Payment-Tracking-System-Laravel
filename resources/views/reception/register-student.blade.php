@extends('layouts.app')

@section('title', 'Register Student')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Register New Student</h1>
    <p class="text-gray-600">Fill in student details below</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('reception.store.student') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-gray-700 font-bold mb-2">Full Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-bold mb-2">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-gray-700 font-bold mb-2">Phone *</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date_of_birth" class="block text-gray-700 font-bold mb-2">Date of Birth *</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('date_of_birth') border-red-500 @enderror">
                @error('date_of_birth')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="course" class="block text-gray-700 font-bold mb-2">Course *</label>
                <select name="course" id="course" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('course') border-red-500 @enderror">
                    <option value="">Select Course</option>
                    <option value="Computer Science" {{ old('course') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                    <option value="Business Administration" {{ old('course') == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
                    <option value="Engineering" {{ old('course') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                    <option value="Medicine" {{ old('course') == 'Medicine' ? 'selected' : '' }}>Medicine</option>
                    <option value="Law" {{ old('course') == 'Law' ? 'selected' : '' }}>Law</option>
                </select>
                @error('course')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                <textarea name="address" id="address" rows="3"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                <i class="fas fa-save mr-2"></i>Register Student
            </button>
            <a href="{{ route('reception.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
