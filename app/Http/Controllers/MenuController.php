<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServeiEdit;
use App\Http\Requests\ServeiPost;
use App\Models\Profesor;
use App\Models\Reserva;
use App\Models\Servei;
use App\Models\ServeiProfesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servei::orderBy('fecha', 'DESC')->paginate(3);
        return view('layouts/vistas.menu', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profSala = Profesor::where('tipo', '=', 'sala')->get();
        $profCoc = Profesor::where('tipo', '=', 'cocina')->get();
        return view('layouts/vistas.crearMenu', compact('profCoc', 'profSala'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServeiPost $request)
    {
        $servicio = new Servei();
        $servicio->fecha = $request->get('fecha');
        $servicio->horariIni = $request->get('horaIni');
        $servicio->horariFin = $request->get('horaFin');
        $servicio->places = $request->get('plazas');
        $servicio->overbooking = $request->get('overbooking');
        $servicio->llistaEspera = $request->get('espera');
        $servicio->user_id = Auth::id();

        $servicio->save();

        if ($request->file('foto')) {
            $imagen = $servicio->id . "-menu.jpg";
            $request->file('foto')->move(public_path('img'), $imagen);
            shell_exec("rsync -a /var/www/back/current/public/img/$imagen ubuntu@ip-172-31-52-86.ec2.internal:/var/www/back/current/public/img/");
        }

        $profCoc = $request->get('profesCoc');
        $profSala = $request->get('profesSala');
        $profesores = array_merge($profCoc, $profSala);

        foreach ($profesores as $profesor) {
            $servicio->profesores()->attach($profesor);
        }

        return redirect("/disponibles/$servicio->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Servei::findOrFail($id);
        $reservasAceptadas = Reserva::where('confirmada', '=', true)->where('servei_id', '=', $id)->get();

        $comensales = 0;
        $totalComensales = Reserva::where('confirmada', '=', true)->where('servei_id', '=', $id)->get('comensales');
        foreach ($totalComensales as $comensal) {
            $comensales += $comensal->comensales;
        }
        $arrayProfesCoc =  $servicio->profesoresCoc;
        $arrayProfesSala =  $servicio->profesoresSala;
        $reservas = Reserva::where('servei_id', '=', $id)->get();

        return view('layouts/vistas.vistaMenu', compact('servicio', 'arrayProfesCoc', 'arrayProfesSala', 'reservas', 'reservasAceptadas', 'comensales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servei::find($id);

        $arrayCoc = [];
        foreach ($servicio->profesoresCoc as $profe) {
            $arrayCoc[] = $profe->id;
        }
        $arraySala = [];
        foreach ($servicio->profesoresSala as $profe) {
            $arraySala[] = $profe->id;
        }
        $profSala = Profesor::where('tipo', '=', 'sala')->get();
        $profCoc = Profesor::where('tipo', '=', 'cocina')->get();
        return view('layouts/vistas.editServicio', compact('servicio', 'profCoc', 'profSala', 'arrayCoc', 'arraySala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServeiEdit $request, $id)
    {
        $servicio = Servei::findOrFail($id);;
        $servicio->fecha = $request->get('fecha');
        $servicio->horariIni = $request->get('horaIni');
        $servicio->horariFin = $request->get('horaFin');
        $servicio->places = $request->get('plazas');
        $servicio->overbooking = $request->get('overbooking');
        $servicio->llistaEspera = $request->get('espera');
        $servicio->user_id = Auth::id();
        $servicio->save();

        if ($request->file('foto')) {
            $imagen = $servicio->id . "-menu.jpg";
            $request->file('foto')->move(public_path('img'), $imagen);
            shell_exec("rsync -a /var/www/back/current/public/img/$imagen ubuntu@ip-172-31-52-86.ec2.internal:/var/www/back/current/public/img/");
        }

        $profCoc = $request->get('profesCoc');
        $profSala = $request->get('profesSala');
        $profesores = array_merge($profCoc, $profSala);

        $servicio->profesores()->sync($profesores);

        return redirect("/disponibles/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio = Servei::findOrFail($id);
        $servicio->delete();
        $imagen = public_path('/img/'.$id.'-menu.jpg');
        if (@getimagesize($imagen)) {
            unlink($imagen);
        }
        return redirect("/disponibles");
    }
}
