@extends('layouts.app')

@section('page_title', '📋 Đăng ký môn học')
@section('page_desc', 'Chọn sinh viên và môn học để tạo đăng ký.')

@section('content')

<div class="form-back-link">
    <a href="{{ route('enrollments.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

@if(session('error'))
    <div class="flash-error mb-4">⚠ {{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('enrollments.store') }}" class="app-form">
    @csrf

    <div class="form-group">
        <label class="form-label">Sinh viên <span class="required">*</span></label>
        <select name="student_id" class="form-select-input @error('student_id') is-invalid @enderror">
            <option value="">— Chọn sinh viên —</option>
            @foreach($students as $s)
                <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>
                    {{ $s->name }}
                </option>
            @endforeach
        </select>
        @error('student_id') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Môn học <span class="required">*</span></label>
        <select name="course_id" class="form-select-input @error('course_id') is-invalid @enderror">
            <option value="">— Chọn môn học —</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>
                    {{ $c->name }} — {{ $c->credits }} tín chỉ
                </option>
            @endforeach
        </select>
        @error('course_id') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-actions">
        <a href="{{ route('enrollments.index') }}" class="btn-cancel">Hủy</a>
        <button type="submit" class="btn-primary-custom">✅ Xác nhận đăng ký</button>
    </div>
</form>

@endsection