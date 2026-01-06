<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'active')->count();
        $totalPayments = Payment::where('status', 'paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->sum('amount');
        $todayAttendance = Attendance::whereDate('attendance_date', today())->count();

        return view('admin.dashboard', compact(
            'totalStudents',
            'activeStudents',
            'totalPayments',
            'pendingPayments',
            'todayAttendance'
        ));
    }

    /**
     * Show all students
     */
    public function students()
    {
        $students = Student::with(['payments', 'attendances'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.students', compact('students'));
    }

    /**
     * Show all payments
     */
    public function payments()
    {
        $payments = Payment::with(['student', 'processor'])
            ->orderBy('payment_date', 'desc')
            ->paginate(15);

        return view('admin.payments', compact('payments'));
    }

    /**
     * Show all attendance records
     */
    public function attendance()
    {
        $attendances = Attendance::with(['student', 'scanner'])
            ->orderBy('attendance_date', 'desc')
            ->paginate(15);

        return view('admin.attendance', compact('attendances'));
    }

    /**
     * Show reports page
     */
    public function reports()
    {
        return view('admin.reports');
    }
}
