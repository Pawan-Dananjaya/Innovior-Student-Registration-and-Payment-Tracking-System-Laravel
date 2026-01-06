<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2563eb; margin: 0; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 8px; border: 1px solid #ddd; }
        .section-title { background: #2563eb; color: white; padding: 10px; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f3f4f6; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Innovior Student Management System</h1>
        <h2>Student Report</h2>
        <p>Generated: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    <h3>Student Information</h3>
    <table class="info-table">
        <tr>
            <td><strong>Student ID:</strong></td>
            <td>{{ $student->student_id }}</td>
            <td><strong>Name:</strong></td>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $student->email }}</td>
            <td><strong>Phone:</strong></td>
            <td>{{ $student->phone }}</td>
        </tr>
        <tr>
            <td><strong>Course:</strong></td>
            <td>{{ $student->course }}</td>
            <td><strong>Status:</strong></td>
            <td>{{ ucfirst($student->status) }}</td>
        </tr>
        <tr>
            <td><strong>Enrollment Date:</strong></td>
            <td>{{ $student->enrollment_date->format('Y-m-d') }}</td>
            <td><strong>Date of Birth:</strong></td>
            <td>{{ $student->date_of_birth->format('Y-m-d') }}</td>
        </tr>
    </table>

    <div class="section-title">Payment Summary</div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Reference</th>
            </tr>
        </thead>
        <tbody>
            @forelse($student->payments as $payment)
            <tr>
                <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                <td>{{ ucfirst($payment->payment_type) }}</td>
                <td>${{ number_format($payment->amount, 2) }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>{{ $payment->reference_number }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No payment records</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Attendance Summary</div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($student->attendances()->latest('attendance_date')->limit(20)->get() as $attendance)
            <tr>
                <td>{{ $attendance->attendance_date->format('Y-m-d') }}</td>
                <td>{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i') : 'N/A' }}</td>
                <td>{{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i') : 'N/A' }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No attendance records</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
