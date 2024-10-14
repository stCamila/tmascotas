<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos;

class TiposController extends Controller
{

    public function index()
    {
        $tipos = Tipos::all();
        return view('tipos', compact('tipos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $tipo = new Tipos($request->input());
        $tipo->saveOrFail();
        return redirect('tipos')->with('success',' Tipo de mascota añadida correctamente.');
    }


    public function show($id)
    {
        $tipo = Tipos::find($id);
        return view('editTipo', compact('tipo'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipos::find($id);
        $tipo->fill($request->input())->saveOrFail();
        return redirect('tipos')->with('success',' Tipo  de mascota actualizada.');
    }

    public function destroy(string $id)
    {
        $tipo = Tipos::find($id);
        $tipo->delete();
        return redirect('tipos')->with('success',' Tipo  de mascota eliminada.');
    }
}
