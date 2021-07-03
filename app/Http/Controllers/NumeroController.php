<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Phones;

class NumeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["message"=>"API","test"=>"phones"],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
          'tag' => 'nullable',
          'number' => 'required|digits:10'
        ]);

        if($validator->fails()) {
          return response()->json([
            'message' => 'La obtención de datos fue inválida',
            'errors'=>$validator->errors()
          ],422);
        } else {
          $numero = new Phones;
          $numero->tag = $request->tag;
          $numero->phone = $request->number;
          $numero->user_phone_fk = $request->id;
          $numero->save();

          return response()->json(["message"=>"Registro guardado con éxito"],201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Phones::where('id',$id)->exists()) {
          $phone = Phones::find($id);
          return response()->json($phone,200);
        } else {
          return response()->json(["message"=>"el teléfono no se encontró"],404);
        }
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
        $validator = Validator::make($request->all(),[
          'tag' => 'nullable',
          'number' => 'required|digits:10'
        ]);

        if($validator->fails()) {
          return response()->json([
            'message' => 'La obtención de datos fue inválida',
            'errors'=>$validator->errors()
          ],422);
        } else {
          if(Phones::where('id',$id)->exists()){
            $phone = Phones::find($id);
            $phone->tag = $request->tag;
            $phone->phone = $request->number;
            $result = $phone->save();
            return response()->json(["message"=>"Teléfono actualizado con éxito"],200);
          } else {
            return response()->json(["message"=>"El teléfono no se encontró"],404);
          }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Phones::where("id",$id)->exists()){
          Phones::destroy($id);
          return response()->json(["message"=>"Se eliminó el registro"],202);
        } else {
          return response()->json(["message"=>"No se encontró el registro"],404);
        }
    }
}
