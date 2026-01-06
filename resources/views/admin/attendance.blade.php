@extends('layouts.app')

@section('title', 'Attendance - Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Attendance Management</h1>
    <p class="text-gray-600">View all attendance records</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Attendance Records</h2>
            <a href="{{ route('reports.attendance') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-file-pdf mr-2"></i>Generate Report
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check In</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check Out</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scanned By</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($attendances as $attendance)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->attendance_date->format('Y-m-d') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>{{ $attendance->student->name }}</div>
                        <div class="text-xs text-gray-500">{{ $attendance->student->student_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $attendance->status === 'late' ? 'bg-orange-100 text-orange-800' : '' }}
                            {{ $attendance->status === 'absent' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->scanner->name ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No attendance records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t">
        {{ $attendances->links() }}
    </div>
</div>
@endsection
