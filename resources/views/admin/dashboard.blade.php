@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
    <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Students</p>
                <h3 class="text-3xl font-bold text-blue-600">{{ $totalStudents }}</h3>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">{{ $activeStudents }} active</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Payments</p>
                <h3 class="text-3xl font-bold text-green-600">${{ number_format($totalPayments, 2) }}</h3>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <i class="fas fa-dollar-sign text-green-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">All time</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pending Payments</p>
                <h3 class="text-3xl font-bold text-orange-600">${{ number_format($pendingPayments, 2) }}</h3>
            </div>
            <div class="bg-orange-100 rounded-full p-3">
                <i class="fas fa-clock text-orange-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">Outstanding</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Today's Attendance</p>
                <h3 class="text-3xl font-bold text-purple-600">{{ $todayAttendance }}</h3>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <i class="fas fa-calendar-check text-purple-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">Check-ins</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="space-y-3">
            <a href="{{ route('admin.students') }}" class="block bg-blue-50 hover:bg-blue-100 p-4 rounded">
                <i class="fas fa-users mr-2 text-blue-600"></i>Manage Students
            </a>
            <a href="{{ route('admin.payments') }}" class="block bg-green-50 hover:bg-green-100 p-4 rounded">
                <i class="fas fa-dollar-sign mr-2 text-green-600"></i>View Payments
            </a>
            <a href="{{ route('admin.attendance') }}" class="block bg-purple-50 hover:bg-purple-100 p-4 rounded">
                <i class="fas fa-calendar-check mr-2 text-purple-600"></i>Check Attendance
            </a>
            <a href="{{ route('admin.reports') }}" class="block bg-orange-50 hover:bg-orange-100 p-4 rounded">
                <i class="fas fa-file-pdf mr-2 text-orange-600"></i>Generate Reports
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">System Status</h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-gray-600">System Status</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Active</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Database</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Connected</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Last Backup</span>
                <span class="text-gray-800">{{ now()->format('Y-m-d H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
