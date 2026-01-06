<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprehensive Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2563eb; margin: 0; }
        .stats { display: flex; margin-bottom: 30px; }
        .stat-box { flex: 1; padding: 15px; margin: 5px; background: #f3f4f6; border-radius: 5px; }
        .stat-box h3 { margin: 0; color: #2563eb; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #2563eb; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Innovior Student Management System</h1>
        <h2>Comprehensive System Report</h2>
        <p>Generated: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    <h3>System Statistics</h3>
    <table>
        <tr>
            <td><strong>Total Students:</strong></td>
            <td>{{ $totalStudents }}</td>
            <td><strong>Active Students:</strong></td>
            <td>{{ $activeStudents }}</td>
        </tr>
        <tr>
            <td><strong>Total Payments:</strong></td>
            <td>${{ number_format($totalPayments, 2) }}</td>
            <td><strong>Pending Payments:</strong></td>
            <td>${{ number_format($pendingPayments, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Average Daily Attendance (30 days):</strong></td>
            <td>{{ number_format($averageAttendance, 1) }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <h3 style="margin-top: 30px;">Recent Students</h3>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Total Paid</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentStudents as $student)
            <tr>
                <td>{{ $student->student_id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->course }}</td>
                <td>${{ number_format($student->total_paid, 2) }}</td>
                <td>{{ ucfirst($student->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
