@extends('layouts.app')

@section('title', 'QR Scanner')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">QR Code Scanner</h1>
    <p class="text-gray-600">Scan student QR codes for attendance</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Scan QR Code</h2>
        
        <div class="mb-4">
            <label for="studentIdInput" class="block text-gray-700 font-bold mb-2">Enter Student ID</label>
            <div class="flex space-x-2">
                <input type="text" id="studentIdInput" placeholder="STU000001"
                    class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button onclick="scanQRCode()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                    <i class="fas fa-qrcode mr-2"></i>Scan
                </button>
            </div>
        </div>

        <div id="scanResult" class="hidden mt-4 p-4 rounded"></div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Scans</h2>
        <div id="recentScans" class="space-y-2">
            <p class="text-gray-500 text-sm">No recent scans</p>
        </div>
    </div>
</div>

<div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
    <h3 class="text-lg font-bold mb-2 text-blue-800">Instructions</h3>
    <ul class="list-disc list-inside text-blue-700 space-y-1">
        <li>Enter or scan the student ID from their QR code</li>
        <li>First scan of the day records check-in time</li>
        <li>Second scan records check-out time</li>
        <li>Student attendance is automatically tracked</li>
    </ul>
</div>

@push('scripts')
<script>
let recentScans = [];

function scanQRCode() {
    const studentId = document.getElementById('studentIdInput').value.trim();
    
    if (!studentId) {
        showResult('error', 'Please enter a student ID');
        return;
    }

    // Make API call to process QR scan
    fetch('{{ route("reception.qr.scan") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ student_id: studentId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const action = data.action === 'check_in' ? 'Checked In' : 'Checked Out';
            showResult('success', `${data.student.name} - ${action} successfully!`);
            addRecentScan(data.student.name, data.student.student_id, action);
        } else {
            showResult('error', data.message);
        }
        document.getElementById('studentIdInput').value = '';
    })
    .catch(error => {
        showResult('error', 'An error occurred. Please try again.');
        console.error('Error:', error);
    });
}

function showResult(type, message) {
    const resultDiv = document.getElementById('scanResult');
    resultDiv.className = type === 'success' 
        ? 'mt-4 p-4 rounded bg-green-100 border border-green-400 text-green-700'
        : 'mt-4 p-4 rounded bg-red-100 border border-red-400 text-red-700';
    resultDiv.textContent = message;
    resultDiv.classList.remove('hidden');
    
    setTimeout(() => {
        resultDiv.classList.add('hidden');
    }, 5000);
}

function addRecentScan(name, studentId, action) {
    const now = new Date().toLocaleTimeString();
    recentScans.unshift({ name, studentId, action, time: now });
    
    if (recentScans.length > 10) {
        recentScans.pop();
    }
    
    updateRecentScans();
}

function updateRecentScans() {
    const container = document.getElementById('recentScans');
    
    if (recentScans.length === 0) {
        container.innerHTML = '<p class="text-gray-500 text-sm">No recent scans</p>';
        return;
    }
    
    container.innerHTML = recentScans.map(scan => `
        <div class="p-3 bg-gray-50 rounded border border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <div class="font-semibold">${scan.name}</div>
                    <div class="text-xs text-gray-500">${scan.studentId}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm font-semibold ${scan.action === 'Checked In' ? 'text-green-600' : 'text-blue-600'}">
                        ${scan.action}
                    </div>
                    <div class="text-xs text-gray-500">${scan.time}</div>
                </div>
            </div>
        </div>
    `).join('');
}

// Allow Enter key to trigger scan
document.getElementById('studentIdInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        scanQRCode();
    }
});
</script>
@endpush
@endsection
