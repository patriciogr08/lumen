<?php

namespace app\Http\Controllers;

use App\Helpers\EstadoTransaccion;
use App\Http\BusinessLayer\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
    private $et;
    private $persona;

    
	function __construct(){
        $this->et        = new EstadoTransaccion();
        $this->persona   = new Persona();
    }

    public function listar()
    {
        try{
           /* $plainPassword = "admin";
            $newpassword = app('hash')->make($plainPassword);
            var_dump($newpassword);*/
            $this->et->data = $this->persona->listar();            
        }catch(\Exception $e){
            $this->et->existeError  = true;
            $this->et->mensaje      = 'Error: ' . $e->getMessage();
        }        
        return response()->json($this->et);    
    }

    public function buscarPersona($id)
    {
        try{
            $this->et->data = $this->persona->buscarPersona($id);            
        }catch(\Exception $e){
            $this->et->existeError  = true;
            $this->et->mensaje      = 'Error: ' . $e->getMessage();
        }        
        return response()->json($this->et);
    }


    public function insertar(Request $request){
        try {
            $datos = json_decode($request->getContent(),true);
            $this->persona->insertarActualizar($datos,"insert");
        } catch (\Exception $e) {
            $this->et->existeError  = true;
            $this->et->mensaje      = 'Error: ' . $e->getMessage();
        }
    }

    public function actualizar(Request $request){
        try {
            $datos = json_decode($request->getContent(),true);
            $this->et = $this->persona->insertarActualizar($datos,"update");
            $this->dataos = $datos;
        } catch (\Exception $e) {
            $this->et->existeError  = true;
            $this->et->mensaje      = 'Error: ' . $e->getMessage();
        }
        return response()->json($this->et);
    }

    public function eliminadoFisico($id){
        try{
            $this->et       = $this->persona->eliminadoFisico($id);
        }catch(\Exception $e){
            $this->et->existeError  = true;
            $this->et->mensaje      = 'Error: ' . $e->getMessage();
        }        
        return response()->json($this->et);
    }
}