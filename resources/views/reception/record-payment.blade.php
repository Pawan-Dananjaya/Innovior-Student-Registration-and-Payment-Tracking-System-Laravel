@extends('layouts.app')

@section('title', 'Record Payment')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Record Payment</h1>
    <p class="text-gray-600">Process student payment</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('reception.store.payment') }}">
        @csrf

        <div class="space-y-4">
            <div>
                <label for="student_id" class="block text-gray-700 font-bold mb-2">Select Student *</label>
                <select name="student_id" id="student_id" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('student_id') border-red-500 @enderror">
                    <option value="">Select a student</option>
                    @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->student_id }} - {{ $student->name }}
                    </option>
                    @endforeach
                </select>
                @error('student_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="amount" class="block text-gray-700 font-bold mb-2">Amount ($) *</label>
                <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount') }}" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('amount') border-red-500 @enderror">
                @error('amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="payment_type" class="block text-gray-700 font-bold mb-2">Payment Type *</label>
                <select name="payment_type" id="payment_type" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_type') border-red-500 @enderror">
                    <option value="">Select Type</option>
                    <option value="tuition" {{ old('payment_type') == 'tuition' ? 'selected' : '' }}>Tuition</option>
                    <option value="registration" {{ old('payment_type') == 'registration' ? 'selected' : '' }}>Registration</option>
                    <option value="exam" {{ old('payment_type') == 'exam' ? 'selected' : '' }}>Exam Fee</option>
                    <option value="library" {{ old('payment_type') == 'library' ? 'selected' : '' }}>Library Fee</option>
                    <option value="other" {{ old('payment_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('payment_type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="block text-gray-700 font-bold mb-2">Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                @error('notes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
                <i class="fas fa-save mr-2"></i>Record Payment
            </button>
            <a href="{{ route('reception.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
