<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use Exception;
use \Illuminate\Http\Response;

class RecetaController extends Controller
{

    public function allByPaciente($paciente_id){
        try{
            $message = (Receta::where('paciente_id',"=",$paciente_id)->count()==0)?"no hay pacientes en el sistema":"";
            return response()->json(['data'=>Receta::all(),'message'=>$message],Response::HTTP_OK);
        }catch(Exception $ex){
            return response()->json(['data'=>null,'message'=>'error al obtener recetas del pacientes'],Response::HTTP_BAD_REQUEST);
        }
    }

    public function get($id){
        try{
            $message = (Receta::find($id)!=null)?"":"ese usuario no existe";
            return response()->json(['data'=>Receta::find($id),'message'=>$message],Response::HTTP_OK);
        }catch(Exception $ex){
            return response()->json(['data'=>null,'message'=>'No se pudo obtener la receta'],Response::HTTP_BAD_REQUEST);
        }

    }

    public function add(Request $request){

        try{
            $created = Receta::create([
                'medicacion'  => $request->get('medicacion'),
                'paciente_id' => $request->get('paciente_id'),
                'dieta'       => $request->get('dieta')
            ]);
            if($created){
                return response()->json(['data'=>$created,'message'=>"receta agregada correctamente"],Response::HTTP_OK);
            }
        }catch(Exception $e){
            return response()->json(['data'=>null,'message'=>'error al ingresar receta '.$e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }

    public function put($id,Request $request){
        $model = Receta::find($id);

        try{
            if($request->has('medicacion'))
                $model->medicacion  = $request->get('medicacion');
            if($request->has('paciente_id'))
                $model->paciente_id = $request->get('paciente_id');
            if($request->has('dieta'))
                $model->dieta       = $request->get('dieta');
            if($model->save())
                return response()->json(['data' => $model,'message'=>'Datos de paciente actualizados exitosamente'], Response::HTTP_OK);
        }catch(Exception $ex){
            return response()->json(['data'=>null,'message' => 'Error Fatal :'.$ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function remove($id){
        try{
            $model = Receta::findOrFail($id);
            if($model){
                $model->delete();
                return response()->json(['data' => null,'message'=>'Receta eliminada Correctamente'], Response::HTTP_OK);
            }else{
                return response()->json(['data' => null,'message' => "esta receta no existe"], Response::HTTP_BAD_REQUEST);
            }


        }catch(Exception $ex){
            return response()->json(['data'=>null,'message' => 'Error Fatal al eliminar a receta: '.$ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
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
