@extends('layouts.app')

@section('page_title', '📘 Môn học')
@section('page_desc', 'Danh sách các môn học trong chương trình.')

@section('content')

<div class="mb-4">
    <a href="{{ route('courses.create') }}" class="btn-primary-custom">
        <span>＋</span> Thêm môn học
    </a>
</div>

@if(session('success'))
    <div class="flash-success mb-3">✓ {{ session('success') }}</div>
@endif

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Tên môn học</th>
                <th style="width:130px; text-align:center">Số tín chỉ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $c)
            <tr>
                <td class="fw-semibold">{{ $c->name }}</td>
                <td style="text-align:center">
                    <span class="credit-badge">{{ $c->credits }} TC</span>
                </td>
            </tr>
            @empty
            <tr><td colspan="2" class="empty-state">Chưa có môn học nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection