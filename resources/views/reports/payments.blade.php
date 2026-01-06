<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payments Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2563eb; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #2563eb; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .total { background: #f3f4f6; font-weight: bold; padding: 10px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Innovior Student Management System</h1>
        <h2>Payments Report</h2>
        <p>Generated: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Reference</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                <td>{{ $payment->student->name }} ({{ $payment->student->student_id }})</td>
                <td>{{ ucfirst($payment->payment_type) }}</td>
                <td>${{ number_format($payment->amount, 2) }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>{{ $payment->reference_number }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No payment records found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Amount: ${{ number_format($totalAmount, 2) }}
    </div>
</body>
</html>
