@extends('layouts.app')

@section('page_title', '🎓 Sinh viên')
@section('page_desc', 'Danh sách sinh viên đang theo học.') 

@section('content')

{{-- Toolbar --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

    <a href="{{ route('students.create') }}" class="btn-primary-custom">
        <span>＋</span> Thêm sinh viên
    </a>

    <form method="GET" class="search-bar">
        <div class="search-input-wrap">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên..." class="input-field">
        </div>

        <select name="sort" class="select-field">
            <option value="">Sắp xếp</option>
            <option value="asc"  {{ request('sort')=='asc'  ? 'selected' : '' }}>A → Z</option>
            <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>Z → A</option>
        </select>

        <button type="submit" class="btn-outline-custom">Lọc</button>
    </form>

</div>

{{-- Flash --}}
@if(session('success'))
    <div class="flash-success mb-3">✓ {{ session('success') }}</div>
@endif

{{-- Table --}}
<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:60px">ID</th>
                <th>Tên sinh viên</th>
                <th>Ngành học</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $sv)
            <tr>
                <td><span class="id-badge">{{ $sv->id }}</span></td>
                <td class="fw-semibold">{{ $sv->name }}</td>
                <td><span class="tag-blue">{{ $sv->major }}</span></td>
                <td class="text-muted-custom">{{ $sv->email }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="empty-state">Chưa có sinh viên nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $students->links() }}</div>

@endsection 