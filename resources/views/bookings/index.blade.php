@extends('layouts.app')

@section('page_title', '📅 Đặt lịch')
@section('page_desc', 'Quản lý các cuộc hẹn và lịch đặt chỗ.')

@section('content')

<div class="mb-4">
    <a href="{{ route('bookings.create') }}" class="btn-primary-custom">
        <span>＋</span> Đặt lịch mới
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
                <th>Ngày</th>
                <th>Giờ</th>
                <th style="width:90px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $a)
            <tr>
                <td class="fw-semibold">{{ $a->customer_name }}</td>

                <td>
                    <span class="date-chip">
                        📅 {{ \Carbon\Carbon::parse($a->date)->format('d/m/Y') }}
                    </span>
                </td>

                <td>
                    <span class="time-chip">
                        🕐 {{ $a->time }}
                    </span>
                </td>

                <td>
                    <form method="POST" action="{{ route('bookings.destroy', $a->id) }}"
                          onsubmit="return confirm('Hủy lịch hẹn này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-xs-danger">Hủy</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="empty-state">Chưa có lịch hẹn nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection