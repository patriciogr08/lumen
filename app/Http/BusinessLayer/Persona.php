<?php

namespace App\Http\BusinessLayer;
use App\Http\Repositories\PersonaRepository;
use Symfony\Component\VarDumper\VarDumper;
use App\Helpers\EstadoTransaccion;

class Persona
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function listar(){
        try {
            $personaRepo = new PersonaRepository();
            $respuesta   =$personaRepo->listar();
            return $respuesta;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function buscarPersona($id){
        try {
            $personaRepo = new PersonaRepository();
            $respuesta   =$personaRepo->buscarPersona($id);
            return $respuesta;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
    }

    public function insertarActualizar($datos,$evento){     
        try{
            $et             = new EstadoTransaccion();
            $personaRepo    = new PersonaRepository($datos);
            $respuesta      = $personaRepo->insertarActualizar($evento);
            if($respuesta==0){
                $et->existeError    = true;
                $et->mensaje        = $et->PROCESO_ERRONEO;
            }
            return $et;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function eliminadoFisico($id){
        try{
            $et             = new EstadoTransaccion();
            $personaRepo    = new PersonaRepository();
            $et->data       = $personaRepo->eliminadoFisico($id);          
            return $et;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}