<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tgl_agenda', 'desc')
            ->get()
            ->map(function($agenda) {
                $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda);
                return $agenda;
            });

        return view('user.agenda.index', compact('agendas'));
    }

    public function show($id)
    {
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda);
            return view('user.agenda.show', compact('agenda'));
        } catch (\Exception $e) {
            return redirect()->route('agenda.index')
                ->with('error', 'Agenda tidak ditemukan');
        }
    }
}
