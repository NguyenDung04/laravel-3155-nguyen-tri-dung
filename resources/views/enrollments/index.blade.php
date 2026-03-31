@extends('layouts.app')

@section('page_title', '📋 Đăng ký môn học')
@section('page_desc', 'Danh sách sinh viên đã đăng ký các môn học.')

@section('content')

<div class="mb-4">
    <a href="{{ route('enrollments.create') }}" class="btn-primary-custom">
        <span>＋</span> Đăng ký môn
    </a>
</div>

@if(session('success'))
    <div class="flash-success mb-3">✓ {{ session('success') }}</div>
@endif

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Sinh viên</th>
                <th>Môn học</th>
                <th style="width:110px; text-align:center">Tín chỉ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $e)
            <tr>
                <td class="fw-semibold">{{ $e->student->name }}</td>
                <td><span class="tag-blue">{{ $e->course->name }}</span></td>
                <td style="text-align:center">
                    <span class="credit-badge">{{ $e->course->credits }} TC</span>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="empty-state">Chưa có đăng ký nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection