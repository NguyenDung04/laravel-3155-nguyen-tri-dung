<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // danh sách đăng ký
    public function index()
    {
        $enrollments = Enrollment::with('student','course')->get();
        return view('enrollments.index', compact('enrollments'));
    }

    // form đăng ký
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();

        return view('enrollments.create', compact('students','courses'));
    }

    // lưu đăng ký
    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required',
            'course_id'=>'required'
        ]);

        // ❗ kiểm tra trùng
        $exists = Enrollment::where('student_id',$request->student_id)
                            ->where('course_id',$request->course_id)
                            ->exists();

        if($exists){
            return back()->with('error','Đã đăng ký môn này');
        }

        // ❗ tính tổng tín chỉ
        $totalCredits = Enrollment::where('student_id',$request->student_id)
            ->join('courses','courses.id','=','enrollments.course_id')
            ->sum('credits');

        $course = Course::find($request->course_id);

        if($totalCredits + $course->credits > 18){
            return back()->with('error','Vượt quá 18 tín chỉ');
        }

        Enrollment::create($request->all());

        return redirect()->route('enrollments.index');
    }
}
