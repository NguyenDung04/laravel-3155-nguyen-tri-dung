@extends('layouts.app')

@section('page_title', '🛒 Chi tiết đơn hàng')
@section('page_desc', 'Xem chi tiết các sản phẩm trong đơn hàng.')

@section('content')

<div class="form-back-link mb-4">
    <a href="{{ route('orders.index') }}" class="back-link">← Quay lại danh sách</a>
</div>

{{-- Order meta card --}}
<div class="detail-meta-card mb-4">
    <div class="detail-meta-row">
        <span class="detail-meta-label">Khách hàng</span>
        <span class="detail-meta-value fw-semibold">{{ $order->customer_name }}</span>
    </div>
    <div class="detail-meta-row">
        <span class="detail-meta-label">Trạng thái</span>
        <span>
            @if($order->status === 'completed')
                <span class="status-badge success">✅ Hoàn thành</span>
            @elseif($order->status === 'processing')
                <span class="status-badge" style="background:var(--blue-100);color:var(--blue-700)">🔄 Đang xử lý</span>
            @else
                <span class="status-badge" style="background:#f3f4f6;color:#374151">⏳ Chờ xử lý</span>
            @endif
        </span>
    </div>
    <div class="detail-meta-row">
        <span class="detail-meta-label">Tổng tiền</span>
        <span class="fw-semibold" style="color:var(--blue-700); font-size:1.05rem">
            {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫
        </span>
    </div>
</div>

{{-- Items table --}}
<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th style="width:110px; text-align:center">Số lượng</th>
                <th style="width:140px; text-align:right">Đơn giá</th>
                <th style="width:160px; text-align:right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($order->items as $item)
            <tr>
                <td class="fw-semibold">{{ $item->product->name }}</td>
                <td style="text-align:center">
                    <span class="credit-badge">{{ $item->quantity }}</span>
                </td>
                <td style="text-align:right; color:var(--text-muted)">
                    {{ number_format($item->price, 0, ',', '.') }}₫
                </td>
                <td style="text-align:right; font-weight:600; color:var(--blue-700)">
                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="empty-state">Không có sản phẩm nào.</td></tr>
            @endforelse
        </tbody>
        @if($order->items->count())
        <tfoot>
            <tr style="background:var(--blue-50)">
                <td colspan="3" style="padding:.75rem 1rem; text-align:right; font-weight:700; font-size:.85rem; text-transform:uppercase; letter-spacing:.04em; color:var(--blue-700)">
                    Tổng cộng
                </td>
                <td style="padding:.75rem 1rem; text-align:right; font-weight:700; color:var(--blue-700); font-size:1rem">
                    {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

@endsection