@extends('layouts.app')

@section('page_title', '📦 Sản phẩm')
@section('page_desc', 'Quản lý kho hàng và cập nhật số lượng.')

@section('content')

{{-- Toolbar --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

    <a href="{{ route('products.create') }}" class="btn-primary-custom">
        <span>＋</span> Thêm sản phẩm
    </a>

    <form method="GET" class="search-bar">
        <div class="search-input-wrap">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm sản phẩm..." class="input-field">
        </div>
        <button type="submit" class="btn-outline-custom">Tìm</button>
    </form>

</div>

@if(session('success'))
    <div class="flash-success mb-3">✓ {{ session('success') }}</div>
@endif

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th style="width:90px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td class="fw-semibold">{{ $p->name }}</td>

                <td class="fw-semibold" style="color:var(--blue-700)">
                    {{ number_format($p->price, 0, ',', '.') }}₫
                </td>

                {{-- Inline quantity update --}}
                <td>
                    <form method="POST" action="{{ route('products.update', $p->id) }}" class="d-flex align-items-center gap-2">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $p->quantity }}"
                               class="qty-input" min="0">
                        <button type="submit" class="btn-xs-primary">✓</button>
                    </form>
                </td>

                <td><span class="tag-blue">{{ $p->category }}</span></td>

                <td>
                    @if($p->quantity == 0)
                        <span class="status-badge danger">Hết hàng</span>
                    @elseif($p->quantity < 5)
                        <span class="status-badge warning">Sắp hết</span>
                    @else
                        <span class="status-badge success">Còn hàng</span>
                    @endif
                </td>

                <td>
                    <form method="POST" action="{{ route('products.destroy', $p->id) }}"
                          onsubmit="return confirm('Xóa sản phẩm này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-xs-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-state">Chưa có sản phẩm nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $products->links() }}</div>

@endsection