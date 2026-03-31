@extends('layouts.app')

@section('page_title', '🛒 Tạo đơn hàng')
@section('page_desc', 'Chọn sản phẩm và số lượng để tạo đơn hàng mới.')

@section('content')

<div class="form-back-link">
    <a href="{{ route('orders.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

@if(session('error'))
    <div class="flash-error mb-4">⚠ {{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('orders.store') }}" class="app-form">
    @csrf

    <div class="form-group">
        <label class="form-label">Tên khách hàng <span class="required">*</span></label>
        <input type="text" name="customer_name" value="{{ old('customer_name') }}"
               class="form-input @error('customer_name') is-invalid @enderror"
               placeholder="Nguyễn Văn A">
        @error('customer_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-section-title">Chọn sản phẩm</div>

    <div class="product-picker">
        @foreach($products as $p)
        <div class="product-pick-row">
            <div class="product-pick-info">
                <span class="product-pick-name">{{ $p->name }}</span>
                <span class="product-pick-price">{{ number_format($p->price, 0, ',', '.') }}₫</span>
                @if($p->quantity == 0)
                    <span class="status-badge danger" style="font-size:.7rem">Hết hàng</span>
                @else
                    <span class="status-badge success" style="font-size:.7rem">Còn {{ $p->quantity }}</span>
                @endif
            </div>
            <input type="number" name="products[{{ $p->id }}]"
                   value="{{ old('products.'.$p->id, 0) }}"
                   min="0" max="{{ $p->quantity }}"
                   class="qty-input" {{ $p->quantity == 0 ? 'disabled' : '' }}>
        </div>
        @endforeach
    </div>

    <div class="form-actions">
        <a href="{{ route('orders.index') }}" class="btn-cancel">Hủy</a>
        <button type="submit" class="btn-primary-custom">🛒 Tạo đơn hàng</button>
    </div>
</form>

@endsection