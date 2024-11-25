<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tgl_agenda', 'desc')->paginate(10);
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        \Log::info('Request Data:', $request->all());

        $validated = $request->validate([
            'judul_agenda' => 'required|string|max:255',
            'tgl_agenda' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        try {
            \Log::info('Validated Data:', $validated);

            $agenda = new Agenda();
            $agenda->judul_agenda = $validated['judul_agenda'];
            $agenda->tgl_agenda = $validated['tgl_agenda'];
            $agenda->lokasi = $validated['lokasi'];
            $agenda->deskripsi_agenda = $validated['deskripsi'];
            $agenda->save();

            \Log::info('Created Agenda:', $agenda->toArray());

            return redirect()
                ->route('admin.agenda.index')
                ->with('success', 'Agenda berhasil ditambahkan');
        } catch (\Exception $e) {
            \Log::error('Error creating agenda: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda)->format('Y-m-d');
            return view('admin.agenda.edit', compact('agenda'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.agenda.index')
                ->with('error', 'Agenda tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $validated = $request->validate([
            'judul_agenda' => 'required|string|max:255',
            'tgl_agenda' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        try {
            $agenda->judul_agenda = $validated['judul_agenda'];
            $agenda->tgl_agenda = $validated['tgl_agenda'];
            $agenda->lokasi = $validated['lokasi'];
            $agenda->deskripsi_agenda = $validated['deskripsi'];
            $agenda->save();

            return redirect()
                ->route('admin.agenda.index')
                ->with('success', 'Agenda berhasil diperbarui');
        } catch (\Exception $e) {
            \Log::error('Error updating agenda: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->delete();

            return redirect()
                ->route('admin.agenda.index')
                ->with('success', 'Agenda berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan saat menghapus agenda');
        }
    }
}
