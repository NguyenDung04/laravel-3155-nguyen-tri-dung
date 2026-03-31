<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // 📋 danh sách
    public function index()
    {
        $appointments = Appointment::orderBy('date')->orderBy('time')->get();
        return view('bookings.index', compact('appointments'));
    }

    // ➕ form
    public function create()
    {
        return view('bookings.create');
    }

    // 💾 lưu
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'=>'required',
            'date'=>'required|date',
            'time'=>'required'
        ]);

        // ❗ không cho đặt quá khứ
        $dateTime = Carbon::parse($request->date.' '.$request->time);

        if($dateTime < now()){
            return back()->with('error','Không được đặt lịch trong quá khứ');
        }

        // ❗ kiểm tra trùng giờ
        $exists = Appointment::where('date',$request->date)
                             ->where('time',$request->time)
                             ->exists();

        if($exists){
            return back()->with('error','Khung giờ đã được đặt');
        }

        Appointment::create($request->all());

        return redirect()->route('bookings.index');
    }

    // ❌ hủy lịch
    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return back();
    }
}