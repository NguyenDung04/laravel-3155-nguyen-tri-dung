@extends('layouts.app')

@section('page_title', '🎓 Thêm sinh viên')
@section('page_desc', 'Điền thông tin để tạo hồ sơ sinh viên mới.')

@section('content')

<div class="form-back-link">
    <a href="{{ route('students.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

<form method="POST" action="{{ route('students.store') }}" class="app-form">
    @csrf

    <div class="form-group">
        <label class="form-label">Họ và tên <span class="required">*</span></label>
        <input type="text" name="name" value="{{ old('name') }}"
               class="form-input @error('name') is-invalid @enderror"
               placeholder="Nguyễn Văn A">
        @error('name')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Ngành học <span class="required">*</span></label>
        <input type="text" name="major" value="{{ old('major') }}"
               class="form-input @error('major') is-invalid @enderror"
               placeholder="Công nghệ thông tin">
        @error('major')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Email <span class="required">*</span></label>
        <input type="email" name="email" value="{{ old('email') }}"
               class="form-input @error('email') is-invalid @enderror"
               placeholder="example@email.com">
        @error('email')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-actions">
        <a href="{{ route('students.index') }}" class="btn-cancel">Hủy</a>
        <button type="submit" class="btn-primary-custom">💾 Lưu sinh viên</button>
    </div>
</form>

@endsection