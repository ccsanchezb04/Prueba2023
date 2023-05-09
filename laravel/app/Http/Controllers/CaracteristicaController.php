<?php

namespace App\Http\Controllers;

use App\Models\Caracteristicas;
use Illuminate\Http\Request;

class CaracteristicaController extends Controller
{
    public function index()
    {
        return view('equipos');
    }

    public function getEquipos()
    {
        try {
            $query = Caracteristicas::all();

            $response = ["status" => true, "data" => $query];
        } catch (\Exception $e) {
            $response = ["status" => false, "msm" => "Error al procesar la información"];
        }

        return response()->json($response);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        try {
            $dataSaved = [
                'gce_nombre_equipo' => $request->gce_caracteristicas['gce_nombre_equipo'],
                'gce_board' => $request->gce_caracteristicas['gce_board'],
                'gce_case' => $request->gce_caracteristicas['gce_case'],
                'gce_procesador' => $request->gce_caracteristicas['gce_procesador'],
                'gce_grafica' => $request->gce_caracteristicas['gce_grafica'],
                'gce_ram' => $request->gce_caracteristicas['gce_ram'],
                'gce_disco_duro' => $request->gce_caracteristicas['gce_disco_duro'],
                'gce_teclado' => $request->gce_caracteristicas['gce_teclado'],
                'gce_mouse' => $request->gce_caracteristicas['gce_mouse'],
                'gce_pantalla' => $request->gce_caracteristicas['gce_pantalla'],
                'gce_estado' => $request->gce_caracteristicas['gce_estado']
            ];

            if (empty($request->gce_caracteristicas['gce_id'])) {
                Caracteristicas::create($dataSaved);
            } else {
                Caracteristicas::find($request->gce_caracteristicas['gce_id'])->update($dataSaved);
            }

            $response = ["status" => true, "msm" => "Registro guardado con éxito"];
        } catch (\Exception $e) {
            $response = ["status" => false, "msm" => $e->getMessage()];
            dd($e);
        }

        return response()->json($response);
    }

    public function getEquipoById(Request $request)
    {
        // dd($request->all());
        try {
            $equipo = Caracteristicas::find($request->idEquipo);

            $response = ["status" => true, "data" => $equipo];
        } catch (\Exception $e) {
            $response = ["status" => false, "msm" => $e->getMessage()];
            dd($e);
        }

        return response()->json($response);
    }

    public function changeState(Request $request)
    {
        // dd($request->all());
        try {
            Caracteristicas::find($request->idEquipo)->update(['gce_estado' => $request->status]);
            $response = ["status" => true, "msm" => "Estado actualizado con éxito"];
        } catch (\Exception $e) {
            $response = ["status" => false, "msm" => $e->getMessage()];
            dd($e);
        }

        return response()->json($response);
    }

    public function deleteEquipo(Request $request)
    {
        try {
            $equipo = Caracteristicas::find($request->idEquipo);
            $equipo->delete();

            $response = ["status" => true, "msm" => "Equipo eliminado con éxito"];
        } catch (\Exception $e) {
            $response = ["status" => false, "msm" => $e->getMessage()];
            dd($e);
        }

        return response()->json($response);
    }
}
