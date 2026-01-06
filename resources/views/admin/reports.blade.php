@extends('layouts.app')

@section('title', 'Reports - Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Reports</h1>
    <p class="text-gray-600">Generate PDF reports</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <i class="fas fa-file-pdf text-blue-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold">Comprehensive Report</h3>
        </div>
        <p class="text-gray-600 mb-4">Generate a complete overview of all system data</p>
        <a href="{{ route('reports.comprehensive') }}" class="block bg-blue-500 text-white text-center px-4 py-2 rounded hover:bg-blue-600">
            Generate Report
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <i class="fas fa-dollar-sign text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold">Payments Report</h3>
        </div>
        <p class="text-gray-600 mb-4">Generate detailed payment transactions report</p>
        <form method="GET" action="{{ route('reports.payments') }}" class="space-y-2">
            <input type="date" name="start_date" class="w-full border rounded px-2 py-1 text-sm">
            <input type="date" name="end_date" class="w-full border rounded px-2 py-1 text-sm">
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Generate Report
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="bg-purple-100 rounded-full p-3 mr-4">
                <i class="fas fa-calendar-check text-purple-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold">Attendance Report</h3>
        </div>
        <p class="text-gray-600 mb-4">Generate attendance records report</p>
        <form method="GET" action="{{ route('reports.attendance') }}" class="space-y-2">
            <input type="date" name="start_date" class="w-full border rounded px-2 py-1 text-sm">
            <input type="date" name="end_date" class="w-full border rounded px-2 py-1 text-sm">
            <button type="submit" class="w-full bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                Generate Report
            </button>
        </form>
    </div>
</div>
@endsection
