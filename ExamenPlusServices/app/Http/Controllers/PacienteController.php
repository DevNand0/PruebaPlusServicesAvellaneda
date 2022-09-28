<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Exception;
use \Illuminate\Http\Response;
class PacienteController extends Controller
{
    public function all(){

        try{
            $message = (Paciente::all()->count()==0)?"no hay pacientes en el sistema":"";
            return response()->json(['data'=>Paciente::all(),'message'=>$message],Response::HTTP_OK);
        }catch(Exception $ex){
            return response()->json(['data'=>null,'message'=>'error al obtener pacientes'],Response::HTTP_BAD_REQUEST);
        }
    }

    public function get($id){
        try{
            $message = (Paciente::find($id)!=null)?"":"ese usuario no existe";
            return response()->json(['data'=>Paciente::find($id),'message'=>$message],Response::HTTP_OK);
        }catch(Exception $ex){
            return response()->json(['data'=>null,'message'=>'No se pudo obtener ese paciente'],Response::HTTP_BAD_REQUEST);
        }

    }

    public function add(Request $request){

        if(Paciente::where('email',$request->email)->first()){
            return response()->json(['data'=>null,'message' => 'Este email esta siendo usado por otro paciente'], Response::HTTP_BAD_REQUEST);
        }
        if(Paciente::where('cedula',$request->cedula)->first()){
            return response()->json(['data'=>null,'message' => 'Esta cedula le pertenece a otro paciente'], Response::HTTP_BAD_REQUEST);
        }

        try{
            $created = Paciente::create([
                'nombre_completo'  => $request->get('nombre_completo'),
                'email'            => $request->get('email'),
                //'password'         => Hash::make($request->get('password')),
                'cedula'           => $request->get('cedula'),
                'celular'          => $request->get('celular'),
                'fecha_nacimiento' => $request->get('fecha_nacimiento')
            ]);
            if($created){
                return response()->json(['data'=>$created,'message'=>"paciente creado correctamente"],Response::HTTP_OK);
            }
        }catch(Exception $e){
            return response()->json(['data'=>null,'message'=>'error al ingresar paciente '.$e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }

    public function put($id,Request $request){
        $paciente = Paciente::find($id);
        $error =false;
        $mensaje = "";
        if(is_null($paciente)){
            return response()->json(['data'=>null,'message' => 'Ese usuario no existe'], Response::HTTP_BAD_REQUEST);
        }
        if(Paciente::where('email',$request->get('email'))->first()!=null){
            if(Paciente::where('email',$request->get('email'))->first()->id!=$paciente->id){
                $mensaje .="Ese email le pertenece a otro paciente, ";
                $error =true;
                //return response()->json(['data'=>null,'message' => 'Ese email le pertenece a otro paciente'], Response::HTTP_BAD_REQUEST);
            }
        }

        if(Paciente::where('cedula',$request->get('cedula'))->first()!=null){
            if(Paciente::where('cedula',$request->get('cedula'))->first()->id!=$paciente->id){
                $mensaje .=" Esa cedula le pertenece a otro paciente";
                $error =true;
                //return response()->json(['data'=>null,'message' => 'Esa cedula le pertenece a otro paciente'], Response::HTTP_BAD_REQUEST);
            }
        }

        if($error)
            return response()->json(['data'=>null,'message' => $mensaje], Response::HTTP_BAD_REQUEST);

        try{
            if($request->has('nombre_completo'))
                $paciente->nombre_completo  = $request->get('nombre_completo');
            if($request->has('email'))
                $paciente->email            = $request->get('email');
            if($request->has('cedula'))
                $paciente->cedula           = $request->get('cedula');
            if($request->has('celular'))
                $paciente->celular          = $request->get('celular');
            if($request->has('fecha_nacimiento'))
                $paciente->fecha_nacimiento = $request->get('fecha_nacimiento');
            if($paciente->save())
                return response()->json(['data' => $paciente,'message'=>'Datos de paciente actualizados exitosamente'], Response::HTTP_OK);
        }catch(Exception $ex){
            return response()->json(['data'=>null,'message' => 'Error Fatal :'.$ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    public function remove($id){
        try{
            $paciente = Paciente::findOrFail($id);
            if($paciente){
                $paciente->delete();
                return response()->json(['data' => null,'message'=>'Paciente eliminado Correctamente'], Response::HTTP_OK);
            }else{
                return response()->json(['data' => null,'message' => "el paciente no existe o ya ha sido eliminado"], Response::HTTP_BAD_REQUEST);
            }


        }catch(Exception $ex){
            return response()->json(['data'=>null,'message' => 'Error Fatal al eliminar a paciente:'.$ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
