<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; // Import model Student

class StudentController extends Controller
{
    // Hiển thị danh sách
    public function index(Request $request)
    {
        $query = Student::query();

        // 🔍 Tìm kiếm theo tên
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔽 Sắp xếp theo tên
        if ($request->sort) {
            $query->orderBy('name', $request->sort); // asc | desc
        }

        // 📄 Phân trang
        $students = $query->paginate(5);

        return view('students.index', compact('students'));
    }

    // Hiển thị form
    public function create()
    {
        return view('students.create');
    }

    // Lưu dữ liệu
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required',
            'major' => 'required',
            'email' => 'required|email|unique:students'
        ]);

        // 💾 Lưu DB
        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success','Thêm thành công');
    }
}