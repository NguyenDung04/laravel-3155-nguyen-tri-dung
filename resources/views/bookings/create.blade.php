@extends('layouts.app')

@section('page_title', '📅 Đặt lịch hẹn')
@section('page_desc', 'Nhập thông tin để đặt lịch hẹn mới.')

@section('content')

<div class="form-back-link">
    <a href="{{ route('bookings.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

@if(session('error'))
    <div class="flash-error mb-4">⚠ {{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('bookings.store') }}" class="app-form">
    @csrf

    <div class="form-group">
        <label class="form-label">Tên khách hàng <span class="required">*</span></label>
        <input type="text" name="customer_name" value="{{ old('customer_name') }}"
               class="form-input @error('customer_name') is-invalid @enderror"
               placeholder="Nguyễn Văn A">
        @error('customer_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label class="form-label">Ngày hẹn <span class="required">*</span></label>
            <input type="date" name="date" value="{{ old('date') }}"
                   class="form-input @error('date') is-invalid @enderror"
                   min="{{ date('Y-m-d') }}">
            @error('date') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Giờ hẹn <span class="required">*</span></label>
            <input type="time" name="time" value="{{ old('time') }}"
                   class="form-input @error('time') is-invalid @enderror">
            @error('time') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('bookings.index') }}" class="btn-cancel">Hủy</a>
        <button type="submit" class="btn-primary-custom">📅 Xác nhận đặt lịch</button>
    </div>
</form>

@endsection