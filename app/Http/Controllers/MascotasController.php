<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Mascotas;
use App\Models\Tipos;
class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mascotas = Mascotas::all();
        $mascotas = Mascotas::select('mascotas.id','id_tipo','tipo','raza','nombre','cuidados','fecha_nacimiento','precio','foto')
        ->join('tipos','tipos.id','=','mascotas.id_tipo')->get();
        $tipos = Tipos::all();
        return view('mascotas', compact('mascotas','tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('mascotas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //$mascota = new Mascotas($request->input());
      //$mascota->saveOrFail();
        //return redirect('mascotas');
       $request->validate([
        'id_tipo'=>'required',
        'raza'=>'required',
        'nombre'=>'required',
        'cuidados'=>'required',
        'fecha_nacimiento'=>'required|date',
        'precio'=>'required|numeric',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
       ]);
    $mascota = Mascotas::create($request->all());

    if ($request->hasFile('foto')) {
        $nombre = $mascota->id . '.' . $request->file('foto')->getClientOriginalExtension();
        $request->file('foto')->storeAs('/img', $nombre);
        $mascota->foto = 'img/' . $nombre;
        $mascota->save();
    }
       return redirect('mascotas')->with('success',' Mascota añadida correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mascota = Mascotas::find($id);
        $tipos = Tipos::all();
        //return view('Mascotas', compact('mascota','tipos'));
        return view('editMascotas', compact('mascota','tipos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('edit.Mascotas', compact('mascota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mascotas $mascota)
    {
        //$mascota = Mascotas::find($id);
        //$mascota->fill($request->input())->saveOrFail();
        //return redirect('mascotas');
        $request->validate([
            'id_tipo'=>'required',
            'raza'=>'required',
            'nombre'=>'required',
            'cuidados'=>'required',
            'fecha_nacimiento'=>'required|date',
            'precio'=>'required|numeric',
           ]);
           if($request->hasFile('foto')){
            Storage::disk('public')->delete($mascota->foto);
            $nombre = $mascota->id . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('public/img',$nombre);
            $mascota->foto = 'img/'.$nombre;
            $mascota->save();
           }
           $mascota->update($request->input());
           return redirect('mascotas')->with('success',' Mascota actualizada.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id )
    {
        $mascota = Mascotas::find($id);
        //Storage::disk('public')->delete($mascota->image);
        $mascota->delete();
        return redirect('mascotas')->with('success',' Mascota eliminada.');
        }
    }