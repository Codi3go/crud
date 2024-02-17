<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index(){
        $datos=DB::select(" select  *from deportistas");
             return view ("welcome")->with("datos",$datos);
    }

    public function create(Request $request){
   try {
        $sql=DB::insert(" insert into deportistas(documento,nombre,nacimiento,eps)values(?,?,?,?)",[
            $request->txtcodigo,
            $request->txtnombre,
            $request->txtnacimiento,
            $request->txteps,
        ]);
   } catch (\Throwable $th) {
    $sql = 0;
   }
        if ($sql == true){
            return back()->with("correcto","deportistas registrado con exito");
        }else{
            return back()->with("incorrecto","Error al registrar");

        }
}

public function update(Request $request)
{
    try {
         $sql=DB::update(" update deportistas set nombre=?, nacimiento=?, eps=? where documento=? ",[
             
             $request->txtnombre,
             $request->txtnacimiento,
             $request->txteps,
             $request->txtcodigo,
         ]);
         if ($sql==0) {
            $sql=1; }  
    } catch (\Throwable $th) {
        $sql = 0;
    }
         if ($sql == true){
             return back()->with("correcto","deportistas modificado con exito");
         }else{
             return back()->with("incorrecto","Error al modificar");
 
         }
 }

 public function delete($id){
    try {
        $sql=DB::delete(" delete from deportistas where documento=$id");
   } catch (\Throwable $th) {
    $sql = 0;
   }
        if ($sql == true){
            return back()->with("correcto","deportistas eliminado con exito");
        }else{
            return back()->with("incorrecto","No se pudo eliminar");

        }
 }
}