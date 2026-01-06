<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2563eb; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #2563eb; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Innovior Student Management System</h1>
        <h2>Attendance Report</h2>
        <p>Generated: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
            <tr>
                <td>{{ $attendance->attendance_date->format('Y-m-d') }}</td>
                <td>{{ $attendance->student->name }} ({{ $attendance->student->student_id }})</td>
                <td>{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i') : 'N/A' }}</td>
                <td>{{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i') : 'N/A' }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No attendance records found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
