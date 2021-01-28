<?php

namespace App\Http\Repositories;
use Illuminate\Support\Facades\DB; 

class PersonaRepository{
    private $id;
    private $nombre;
    private $apellido;
    private $email;

    public function __construct($data=NULL){
        $this->id        =   $data['id']         ??null;
        $this->nombre    =   $data['nombre']     ??null;
        $this->apellido  =   $data['apellido']   ??null;
        $this->email     =   $data['email']      ??null;
    }

    public function listar(){
        try {
            $respuesta=DB::select('SELECT * FROM PERSONA');
            return $respuesta;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }   
    }

    public function buscarPersona($id){
        try {
            $respuesta=DB::select("SELECT * FROM PERSONA where id=$id");
            return $respuesta;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }   
    }

    public function insertarActualizar($evento){
        try {
            if($evento =="update"){
                DB::update("UPDATE persona
                SET nombre= '$this->nombre',apellido='$this->apellido',email='$this->email'
                where id=$this->id");
                $respuesta=1;
            }else{
                if($this->id!=NULL){
                    DB::insert("INSERT INTO persona(id,nombre,apellido,email) values
                    ($this->id,'$this->nombre','$this->apellido','$this->email')");
                    $respuesta=1;
                }else{
                    $respuesta=0;
                }
            }
            return $respuesta;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }  
    }

    public function eliminadoFisico($id){
        try {
            $respuesta=DB::delete("DELETE FROM persona WHERE id=$id");
            return $respuesta;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }       
    }

}