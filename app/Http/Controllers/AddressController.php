<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["message"=>"API","test"=>"address"],201);
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
        'address' => 'required|max:100'
      ]);

      if($validator->fails()) {
        return response()->json([
          'message' => 'La obtención de datos fue inválida',
          'errors'=>$validator->errors()
        ],422);
      } else {
        $address = new Address;
        $address->address = $request->address;
        $address->user_address_fk = $request->id;
        $address->save();
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
      if(Address::where('id',$id)->exists()) {
        $address = Address::find($id);
        return response()->json($address,200);
      } else {
        return response()->json(["message"=>"La dirección no se encontró"],404);
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
        'address' => 'required|max:100'
      ]);

      if($validator->fails()) {
        return response()->json([
          'message' => 'La obtención de datos fue inválida',
          'errors'=>$validator->errors()
        ],422);
      } else {
        if(Address::where('id',$id)->exists()){
          $address = Address::find($id);
          $address->address = $request->address;
          $result = $address->save();
          return response()->json(["message"=>"Dirección actualizada con éxito"],200);
        } else {
          return response()->json(["message"=>"La dirección no se encontró"],404);
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
      if(Address::where("id",$id)->exists()){
        Address::destroy($id);
        return response()->json(["message"=>"Se eliminó el registro"],202);
      } else {
        return response()->json(["message"=>"No se encontró el registro"],404);
      }
    }
}
