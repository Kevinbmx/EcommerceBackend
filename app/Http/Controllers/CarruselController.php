<?php

namespace App\Http\Controllers;

use App\Helper\Acceso;
use App\Models\Carrusel;
use Illuminate\Http\Request;

class CarruselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPermission = false;
        $CategoryTree ='';
        // return 'algo';
        if(Acceso::hasPermission(Acceso::getListarCarrusel())){
            $Carrusel = Carrusel::all();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'carrusel'=> $Carrusel,
        ]);
    }
    public function getById($id)
    {
        $hasPermission = false;
        $CategoryTree ='';
        // return 'algo';
        if(Acceso::hasPermission(Acceso::getActualizarCarrusel())){
            $Carrusel = Carrusel::where('id',$id)->first();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'carrusel'=> $Carrusel,
        ]);
    }
    public function getCarruselHabilitado()
    {
        $hasPermission = false;
        $CategoryTree ='';
        // return 'algo';
        $Carrusel = Carrusel::where('enable',1)->get();
        $hasPermission = true;
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'carrusel'=> $Carrusel,
        ]);
    }

    public function store(Request $request)
    {
        $hasPermission = false;
        $crearCarrusel ='';
        try {
            if(Acceso::hasPermission(Acceso::getCrearCarrusel())){
                // return $request;
                $data = $request->validate([
                    'descripcion' => 'required|string',
                    'url' => 'required|string',
                    'pathFile' => 'required|string',
                    'pathName' => 'required|string',
                    'pathFileMobile' => 'required|string',
                    'pathNameMobile' => 'required|string',
                    'enable'=> 'required',
                ]);
                // return $request;
                $crearCarrusel = Carrusel::create([
                    'descripcion' => $request->descripcion,
                    'url' => $request->url,
                    'pathFile' => $request->pathFile,
                    'pathName' => $request->pathName,
                    'pathFileMobile' => $request->pathFileMobile,
                    'pathNameMobile' => $request->pathNameMobile,
                    'enable' => $request->enable =='true'?1:0
                ]);
                $hasPermission = true;
            }
            return response()
            ->json([
                'carrusel'=> $crearCarrusel,
                'hasPermission'=> $hasPermission
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'carrusel'=> $crearCarrusel,
                'hasPermission'=> $hasPermission
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $carrusel = '';
        $hasPermission = false;
        // try {
            if(Acceso::hasPermission(Acceso::getActualizarCarrusel())){
                $this->validate($request, [
                    'descripcion' => 'required|string',
                    'url' => 'required|string',
                    'pathFile' => 'required|string',
                    'pathName' => 'required|string',
                    'pathFileMobile' => 'required|string',
                    'pathNameMobile' => 'required|string',
                    'enable'=> 'required',
                ]);
                $carrusel = Carrusel::findOrFail($id);
                $carrusel->update([
                    'descripcion' => $request->descripcion,
                    'url' => $request->url,
                    'pathFile' => $request->pathFile,
                    'pathName' => $request->pathName,
                    'pathFileMobile' => $request->pathFileMobile,
                    'pathNameMobile' => $request->pathNameMobile,
                    'enable' => $request->enable =='true'?1:0
                ]);
                $hasPermission = true;
                // return $carrusel;
                return response()
                ->json([
                    'carrusel'=> $carrusel,
                    'hasPermission'=> $hasPermission,
                    'type'=> 'update'
                ]);
            }
        // } catch (\Throwable $th) {
        //     return response()
        //     ->json([
        //         'hasPermission'=> $hasPermission,
        //         'carrusel'=> $carrusel,
        //         'type'=> 'update'
        //     ]);
        // }
    }
    public function habilitar(Request $request,$id)
    {
        $carrusel = '';
        $hasPermission = false;
        try {
            if(Acceso::hasPermission(Acceso::getActualizarCarrusel())){
                $this->validate($request, [
                    'enable'=> 'required',
                ]);
                    $carrusel = Carrusel::findOrFail($id);
                    // return $request->enable =='true'?1:0;
                    $carrusel->update([
                        'enable' => $request->enable =='true'?1:0
                    ]);
                    $hasPermission = true;
                    // return $carrusel;
                    return response()
                    ->json([
                        'carrusel'=> $carrusel,
                        'hasPermission'=> $hasPermission,
                        'type'=> 'update'
                    ]);
            }
        } catch (\Throwable $th) {
            return response()
            ->json([
                'hasPermission'=> $hasPermission,
                'carrusel'=> $carrusel,
                'type'=> 'update'
            ]);
        }
    }
    public function destroy($id)
    {
        $hasPermission = false;
        $Carrusel='';
        try {
            if(Acceso::hasPermission(Acceso::getEliminarCarrusel())){
                $Carrusel = Carrusel::findOrfail($id);
                $Carrusel->delete();
                $hasPermission = true;
            }
            return response()
            ->json([
                'hasPermission' => $hasPermission,
                'carrusel'=> $Carrusel,
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'hasPermission' => $hasPermission,
                'carrusel'=> $Carrusel,
            ]);
        }
    }
}
