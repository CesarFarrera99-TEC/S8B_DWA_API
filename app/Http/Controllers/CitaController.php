<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return Cita::all();
        }
        return Cita::where('user_id', Auth::id())->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cita = Cita::create([
            'user_id' => Auth::id(),
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'Pendiente',
        ]);
    
        return response()->json($cita, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        return response()->json($cita);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //NO hace falta.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }
    
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|in:Pendiente,Aceptado,Rechazado',
        ]);
    
        $cita->update([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => $request->estado,
        ]);
    
        return response()->json($cita);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }
    
        $cita->delete();
    
        return response()->json(['message' => 'Cita eliminada']);
    }
}
