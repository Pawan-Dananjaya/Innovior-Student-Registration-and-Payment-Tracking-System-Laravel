<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Generate student report
     */
    public function studentReport($id)
    {
        $student = Student::with(['payments', 'attendances'])->findOrFail($id);
        
        $pdf = Pdf::loadView('reports.student', compact('student'));
        
        return $pdf->download('student-report-' . $student->student_id . '.pdf');
    }

    /**
     * Generate payments report
     */
    public function paymentsReport(Request $request)
    {
        $query = Payment::with(['student', 'processor']);

        if ($request->has('start_date')) {
            $query->whereDate('payment_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('payment_date', '<=', $request->end_date);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->orderBy('payment_date', 'desc')->get();
        $totalAmount = $payments->sum('amount');

        $pdf = Pdf::loadView('reports.payments', compact('payments', 'totalAmount'));
        
        return $pdf->download('payments-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate attendance report
     */
    public function attendanceReport(Request $request)
    {
        $query = Attendance::with(['student', 'scanner']);

        if ($request->has('start_date')) {
            $query->whereDate('attendance_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('attendance_date', '<=', $request->end_date);
        }

        if ($request->has('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->get();

        $pdf = Pdf::loadView('reports.attendance', compact('attendances'));
        
        return $pdf->download('attendance-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate comprehensive report
     */
    public function comprehensiveReport()
    {
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'active')->count();
        $totalPayments = Payment::where('status', 'paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->sum('amount');
        $averageAttendance = Attendance::where('status', 'present')
            ->whereDate('attendance_date', '>=', now()->subDays(30))
            ->count() / 30;

        $recentStudents = Student::with(['payments', 'attendances'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $pdf = Pdf::loadView('reports.comprehensive', compact(
            'totalStudents',
            'activeStudents',
            'totalPayments',
            'pendingPayments',
            'averageAttendance',
            'recentStudents'
        ));
        
        return $pdf->download('comprehensive-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
