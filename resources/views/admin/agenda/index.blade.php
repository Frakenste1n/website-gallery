@extends('layouts.panel')

@section('title', 'Manajemen Agenda')

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

    .btn-edit {
        background-color: #F39C12;
    }

    .btn-delete {
        background-color: #E74C3C;
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

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: white;
    }

    .bg-info {
        background-color: #3498DB;
    }

    .bg-success {
        background-color: #2ECC71;
    }

    .bg-danger {
        background-color: #E74C3C;
    }
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Manajemen Agenda</h2>
            <i class="fas fa-calendar-alt" style="color: white; font-size: 24px;"></i>
        </div>
        <a href="{{ route('admin.agenda.create') }}" class="btn btn-create">
            <i class="fas fa-plus"></i> Tambah Agenda
        </a>
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
                <th>Judul Agenda</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $index => $agenda)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $agenda->judul_agenda }}</td>
                <td>{{ \Carbon\Carbon::parse($agenda->tgl_agenda)->format('d M Y') }}</td>
                <td>{{ $agenda->lokasi }}</td>
                <td>
                    @php
                        $today = \Carbon\Carbon::now()->startOfDay();
                        $agendaDate = \Carbon\Carbon::parse($agenda->tgl_agenda)->startOfDay();
                    @endphp

                    @if($agendaDate->isFuture())
                        <span class="badge bg-info">Segera</span>
                    @elseif($agendaDate->isToday())
                        <span class="badge bg-success">Berlangsung</span>
                    @else
                        <span class="badge bg-danger">Berakhir</span>
                    @endif
                </td>
                <td class="actions">
                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" 
                          method="POST" 
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-delete" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data agenda</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($agendas->hasPages())
<div class="pagination-container" style="margin-top: 20px;">
    {{ $agendas->links() }}
</div>
@endif
@endsection
