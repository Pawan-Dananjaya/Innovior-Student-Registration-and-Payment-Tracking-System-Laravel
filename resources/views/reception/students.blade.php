@extends('layouts.app')

@section('title', 'Students - Reception')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Students</h1>
    <p class="text-gray-600">View all registered students</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">All Students</h2>
            <a href="{{ route('reception.register.student') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-plus mr-2"></i>New Student
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">QR Code</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($students as $student)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $student->student_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $student->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $student->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $student->phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $student->course }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs {{ $student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($student->qr_code)
                        <button onclick="showQRCode('{{ $student->student_id }}', '{{ $student->qr_code }}')" 
                            class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-qrcode"></i> View
                        </button>
                        @else
                        <span class="text-gray-400">N/A</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No students found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t">
        {{ $students->links() }}
    </div>
</div>

<!-- QR Code Modal -->
<div id="qrModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Student QR Code</h3>
            <button onclick="closeQRModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="text-center">
            <p id="studentIdDisplay" class="mb-4 font-semibold"></p>
            <img id="qrCodeImage" src="" alt="QR Code" class="mx-auto">
        </div>
    </div>
</div>

@push('scripts')
<script>
function showQRCode(studentId, qrCode) {
    document.getElementById('studentIdDisplay').textContent = 'Student ID: ' + studentId;
    document.getElementById('qrCodeImage').src = 'data:image/png;base64,' + qrCode;
    document.getElementById('qrModal').classList.remove('hidden');
}

function closeQRModal() {
    document.getElementById('qrModal').classList.add('hidden');
}
</script>
@endpush
@endsection
