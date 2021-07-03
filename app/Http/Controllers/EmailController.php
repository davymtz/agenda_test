<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Emails;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["message"=>"API","test"=>"email"],201);
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
          'email' => 'required|email:filter,rfc,dns'
        ]);

        if($validator->fails()) {
          return response()->json([
            'message' => 'La obtención de datos fue inválida',
            'errors'=>$validator->errors()
          ],422);
        } else {
          $email = new Emails;
          $email->email = $request->email;
          $email->user_email_fk = $request->id;
          $email->save();
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
      if(Emails::where('id',$id)->exists()) {
        $email = Emails::find($id);
        return response()->json($email,200);
      } else {
        return response()->json(["message"=>"el email no se encontró"],404);
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
        'email' => 'required|email:filter,rfc,dns'
      ]);

      if($validator->fails()) {
        return response()->json([
          'message' => 'La obtención de datos fue inválida',
          'errors'=>$validator->errors()
        ],422);
      } else {
        if(Emails::where('id',$id)->exists()){
          $email = Emails::find($id);
          $email->email = $request->email;
          $result = $email->save();
          return response()->json(["message"=>"Email actualizado con éxito"],200);
        } else {
          return response()->json(["message"=>"El email no se encontró"],404);
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
      if(Emails::where("id",$id)->exists()){
        Emails::destroy($id);
        return response()->json(["message"=>"Se eliminó el registro"],202);
      } else {
        return response()->json(["message"=>"No se encontró el registro"],404);
      }
    }
}
