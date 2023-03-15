<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfEdit;
use App\Http\Requests\ProfPost;
use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesor::get();
        return view('layouts/vistas.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/vistas.crearProfes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfPost $request)
    {
        $profesor = new Profesor();
        $profesor->nombre = $request->get('nombre');
        $profesor->email = $request->get('email');
        $profesor->tipo = $request->get('tipo');

        $profesor->save();
        return redirect("/profesores");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Profesor::find($id);
        return view('layouts/vistas.editProfes', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfEdit $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->nombre = $request->get('nombre');
        $profesor->tipo = $request->get('tipo');
        $profesor->save();
        return redirect("/profesores");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Profesor::findOrFail($id)->delete();
        return redirect("/profesores");
    }
}
