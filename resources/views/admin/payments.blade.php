@extends('layouts.app')

@section('title', 'Payments - Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Payment Management</h1>
    <p class="text-gray-600">View all payment records</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">All Payments</h2>
            <a href="{{ route('reports.payments') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-file-pdf mr-2"></i>Generate Report
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Processed By</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment->reference_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>{{ $payment->student->name }}</div>
                        <div class="text-xs text-gray-500">{{ $payment->student->student_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold">${{ number_format($payment->amount, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($payment->payment_type) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment->payment_date->format('Y-m-d') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $payment->status === 'pending' ? 'bg-orange-100 text-orange-800' : '' }}
                            {{ $payment->status === 'overdue' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment->processor->name ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No payments found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t">
        {{ $payments->links() }}
    </div>
</div>
@endsection
