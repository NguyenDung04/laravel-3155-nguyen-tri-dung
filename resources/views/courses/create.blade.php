@extends('layouts.app')

@section('page_title', '📘 Thêm môn học')
@section('page_desc', 'Tạo môn học mới cho chương trình đào tạo.')

@section('content')

<div class="form-back-link">
    <a href="{{ route('courses.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

<form method="POST" action="{{ route('courses.store') }}" class="app-form">
    @csrf

    <div class="form-row-2">
        <div class="form-group">
            <label class="form-label">Tên môn học <span class="required">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-input @error('name') is-invalid @enderror"
                   placeholder="Lập trình Web">
            @error('name') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Số tín chỉ <span class="required">*</span></label>
            <input type="number" name="credits" value="{{ old('credits') }}" min="1" max="10"
                   class="form-input @error('credits') is-invalid @enderror"
                   placeholder="3">
            @error('credits') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('courses.index') }}" class="btn-cancel">Hủy</a>
        <button type="submit" class="btn-primary-custom">💾 Lưu môn học</button>
    </div>
</form>

@endsection