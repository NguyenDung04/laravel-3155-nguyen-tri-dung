@extends('layouts.app')

@section('page_title', '🛒 Đơn hàng')
@section('page_desc', 'Theo dõi và cập nhật trạng thái đơn hàng.')

@section('content')

<div class="mb-4">
    <a href="{{ route('orders.create') }}" class="btn-primary-custom">
        <span>＋</span> Tạo đơn hàng
    </a>
</div>

@if(session('success'))
    <div class="flash-success mb-3">✓ {{ session('success') }}</div>
@endif

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th style="width:90px">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $o)

            @php
                $total = $o->items->sum(fn($item) => $item->price * $item->quantity);
            @endphp

            <tr>
                <td class="fw-semibold">{{ $o->customer_name }}</td>

                <td class="fw-semibold" style="color:var(--blue-700)">
                    {{ number_format($total, 0, ',', '.') }}₫
                </td>

                <td>
                    <form method="POST" action="{{ route('orders.update', $o->id) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="status-select
                            {{ $o->status === 'completed' ? 'status-select--green' : ($o->status === 'processing' ? 'status-select--blue' : 'status-select--gray') }}">
                            <option value="pending"    {{ $o->status=='pending'    ? 'selected':'' }}>⏳ Chờ xử lý</option>
                            <option value="processing" {{ $o->status=='processing' ? 'selected':'' }}>🔄 Đang xử lý</option>
                            <option value="completed"  {{ $o->status=='completed'  ? 'selected':'' }}>✅ Hoàn thành</option>
                        </select>
                    </form>
                </td>

                <td>
                    <a href="{{ route('orders.show', $o->id) }}" class="btn-xs-info">Xem</a>
                </td>
            </tr>

            @empty
            <tr><td colspan="4" class="empty-state">Chưa có đơn hàng nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection