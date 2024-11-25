@extends('layouts.panel')

@section('title', 'Manajemen User')

@section('content')
<style>
    .header {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
        background-color: #2C3E50;
        border-radius: 8px;
        margin-bottom: 20px;
        width: 100%;
    }

    .header-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }

    .title-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header h2 {
        color: white;
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-top: 15px;
    }

    .search-filter {
        display: flex;
        gap: 10px;
        flex: 1;
    }

    .form-control {
        padding: 10px;
        border: 1px solid #34495E;
        border-radius: 4px;
        background-color: #fff;
        color: #2C3E50;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #3498DB;
        outline: none;
    }

    .btn {
        padding: 8px 12px;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-create {
        background-color: #18BC9C;
    }

    .btn-create:hover {
        background-color: #16A085;
    }

    .btn-filter {
        background-color: #3498DB;
    }

    .btn-filter:hover {
        background-color: #2980B9;
    }

    .btn-reset {
        background-color: #95A5A6;
    }

    .btn-reset:hover {
        background-color: #7F8C8D;
    }

    .btn-edit {
        background-color: #F39C12;
    }

    .btn-edit:hover {
        background-color: #D35400;
    }

    .btn-delete {
        background-color: #E74C3C;
    }

    .btn-delete:hover {
        background-color: #C0392B;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    th {
        background-color: #34495E;
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: 500;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        color: #2C3E50;
    }

    tr:hover {
        background-color: #f5f6fa;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .alert {
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #18BC9C;
        color: white;
    }

    .alert-danger {
        background-color: #E74C3C;
        color: white;
    }

    @media (max-width: 768px) {
        .header-actions {
            flex-direction: column;
            gap: 10px;
        }

        .search-filter {
            flex-wrap: wrap;
        }

        .form-control {
            width: 100%;
        }
    }
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Manajemen User</h2>
            <i class="fas fa-users" style="color: white; font-size: 24px;"></i>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-create">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>
    <div class="header-actions">
        <form action="{{ route('admin.users.index') }}" method="GET" class="search-filter">
            <input type="text" 
                   name="search" 
                   class="form-control" 
                   placeholder="Cari user..."
                   value="{{ request('search') }}">
            
            <select name="role" class="form-control">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>

            <button type="submit" class="btn btn-filter">
                <i class="fas fa-search"></i> Filter
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-reset">
                <i class="fas fa-undo"></i> Reset
            </a>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td class="actions">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data user</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
