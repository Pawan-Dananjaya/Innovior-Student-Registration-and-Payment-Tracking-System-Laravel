<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReceptionController extends Controller
{
    /**
     * Show reception dashboard
     */
    public function dashboard()
    {
        $todayRegistrations = Student::whereDate('created_at', today())->count();
        $todayPayments = Payment::whereDate('payment_date', today())->sum('amount');
        $todayAttendance = Attendance::whereDate('attendance_date', today())->count();

        return view('reception.dashboard', compact(
            'todayRegistrations',
            'todayPayments',
            'todayAttendance'
        ));
    }

    /**
     * Show student registration form
     */
    public function registerStudent()
    {
        return view('reception.register-student');
    }

    /**
     * Store new student
     */
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'course' => 'required|string|max:255',
        ]);

        $studentId = 'STU' . str_pad(Student::count() + 1, 6, '0', STR_PAD_LEFT);

        $student = Student::create([
            'student_id' => $studentId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'date_of_birth' => $validated['date_of_birth'],
            'enrollment_date' => now(),
            'course' => $validated['course'],
            'status' => 'active',
        ]);

        // Generate QR code
        $qrCode = base64_encode(QrCode::format('png')->size(200)->generate($student->student_id));
        $student->update(['qr_code' => $qrCode]);

        return redirect()->route('reception.students')->with('success', 'Student registered successfully!');
    }

    /**
     * Show students list
     */
    public function students()
    {
        $students = Student::orderBy('created_at', 'desc')->paginate(15);
        return view('reception.students', compact('students'));
    }

    /**
     * Show payment form
     */
    public function recordPayment()
    {
        $students = Student::where('status', 'active')->get();
        return view('reception.record-payment', compact('students'));
    }

    /**
     * Store payment
     */
    public function storePayment(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|in:tuition,registration,exam,library,other',
            'notes' => 'nullable|string',
        ]);

        Payment::create([
            'student_id' => $validated['student_id'],
            'amount' => $validated['amount'],
            'payment_date' => now(),
            'payment_type' => $validated['payment_type'],
            'status' => 'paid',
            'reference_number' => 'PAY' . time() . rand(1000, 9999),
            'notes' => $validated['notes'] ?? null,
            'processed_by' => Auth::id(),
        ]);

        return redirect()->route('reception.payments')->with('success', 'Payment recorded successfully!');
    }

    /**
     * Show payments list
     */
    public function payments()
    {
        $payments = Payment::with(['student', 'processor'])
            ->orderBy('payment_date', 'desc')
            ->paginate(15);

        return view('reception.payments', compact('payments'));
    }

    /**
     * Show QR scanner
     */
    public function qrScanner()
    {
        return view('reception.qr-scanner');
    }

    /**
     * Process QR scan for attendance
     */
    public function processQrScan(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,student_id',
        ]);

        $student = Student::where('student_id', $validated['student_id'])->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        // Check if already checked in today
        $existingAttendance = Attendance::where('student_id', $student->id)
            ->whereDate('attendance_date', today())
            ->first();

        if ($existingAttendance) {
            // Check out
            if (!$existingAttendance->check_out_time) {
                $existingAttendance->update(['check_out_time' => now()]);
                return response()->json([
                    'success' => true,
                    'message' => 'Student checked out successfully',
                    'student' => $student,
                    'action' => 'check_out'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Student already checked in and out today'
            ], 400);
        }

        // Check in
        Attendance::create([
            'student_id' => $student->id,
            'attendance_date' => today(),
            'check_in_time' => now(),
            'status' => 'present',
            'scanned_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Student checked in successfully',
            'student' => $student,
            'action' => 'check_in'
        ]);
    }
}
