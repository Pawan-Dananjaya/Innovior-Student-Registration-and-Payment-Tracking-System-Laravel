<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2563eb; color: white; padding: 20px; text-align: center; }
        .content { background: #f9fafb; padding: 30px; }
        .footer { background: #e5e7eb; padding: 20px; text-align: center; font-size: 12px; }
        .button { display: inline-block; background: #2563eb; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Innovior Student System</h1>
            <h2>
                @if($type === 'reminder')
                    Payment Reminder
                @else
                    Payment Confirmation
                @endif
            </h2>
        </div>

        <div class="content">
            <p>Dear {{ $payment->student->name }},</p>

            @if($type === 'reminder')
                <p>This is a friendly reminder about your pending payment:</p>
            @else
                <p>We have received your payment with the following details:</p>
            @endif

            <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px; background: white;"><strong>Reference Number:</strong></td>
                    <td style="padding: 10px; background: white;">{{ $payment->reference_number }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: white;"><strong>Amount:</strong></td>
                    <td style="padding: 10px; background: white;">${{ number_format($payment->amount, 2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: white;"><strong>Payment Type:</strong></td>
                    <td style="padding: 10px; background: white;">{{ ucfirst($payment->payment_type) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: white;"><strong>Date:</strong></td>
                    <td style="padding: 10px; background: white;">{{ $payment->payment_date->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: white;"><strong>Status:</strong></td>
                    <td style="padding: 10px; background: white;">{{ ucfirst($payment->status) }}</td>
                </tr>
            </table>

            @if($type === 'reminder')
                <p>Please make your payment at your earliest convenience to avoid any disruption to your studies.</p>
            @else
                <p>Thank you for your payment. Your transaction has been recorded successfully.</p>
            @endif

            <p>If you have any questions, please contact our office.</p>

            <p>Best regards,<br>
            Innovior Administration Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Innovior Student Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
