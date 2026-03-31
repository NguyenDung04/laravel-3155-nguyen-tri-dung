@extends('layouts.app')

@section('page_title', '📦 Thêm sản phẩm')
@section('page_desc', 'Điền thông tin để thêm sản phẩm vào kho.')

@section('content')

<div class="form-back-link">
    <a href="{{ route('products.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

<form method="POST" action="{{ route('products.store') }}" class="app-form">
    @csrf

    <div class="form-row-2">
        <div class="form-group">
            <label class="form-label">Tên sản phẩm <span class="required">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-input @error('name') is-invalid @enderror"
                   placeholder="Áo thun trắng">
            @error('name') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Danh mục <span class="required">*</span></label>
            <input type="text" name="category" value="{{ old('category') }}"
                   class="form-input @error('category') is-invalid @enderror"
                   placeholder="Thời trang">
            @error('category') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label class="form-label">Giá (₫) <span class="required">*</span></label>
            <div class="input-prefix-wrap">
                <span class="input-prefix">₫</span>
                <input type="number" name="price" value="{{ old('price') }}" min="0"
                       class="form-input has-prefix @error('price') is-invalid @enderror"
                       placeholder="150000">
            </div>
            @error('price') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Số lượng <span class="required">*</span></label>
            <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0"
                   class="form-input @error('quantity') is-invalid @enderror"
                   placeholder="0">
            @error('quantity') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('products.index') }}" class="btn-cancel">Hủy</a>
        <button type="submit" class="btn-primary-custom">💾 Lưu sản phẩm</button>
    </div>
</form>

@endsection