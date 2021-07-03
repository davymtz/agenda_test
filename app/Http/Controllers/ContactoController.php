<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Contacto;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $contactos = Contacto::all();
      return view('list',compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
          'nombre' => 'required|max:50',
          'ap_paterno' => 'required|max:40',
          'photo' => 'mimes:png',
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()) {
          $file = $request->file('photo');
          $path = time().'_photo.png';
          $file->move(public_path().'/images',$path);
        } else $path = null;

        $contacto = new Contacto;
        $contacto->nombre = $request->nombre;
        $contacto->ap_paterno = $request->ap_paterno;
        $contacto->ap_materno = $request->ap_materno;
        $contacto->dateOfBirth = $request->dateOfBirth;
        $contacto->alias = $request->alias;
        $contacto->path_photo = $path;
        $contacto->save();

        return redirect("contacto")->with("message","creado con éxito");
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
        $contacto = Contacto::findOrFail($id);
        if(Storage::disk('images')->exists($contacto->path_photo)) {
          $url = 'images/'.$contacto->path_photo;
        } else $url = null;

        return view('edit',compact("contacto","url"));
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
        $validated = $request->validate([
          'nombre' => 'required|max:50',
          'ap_paterno' => 'required|max:40',
          'photo_update' => 'mimetypes:image/png',
        ]);

        $contacto = Contacto::find($id);
        if($request->hasFile('photo_update') && $request->photo_update->isValid()) {
          Storage::disk('images')->delete($contacto->path_photo);
          $file = $request->photo_update;
          $path = time().'_photo.png';
          $contacto->path_photo = $path;
          $file->move(public_path().'/images',$path);
        }
        $contacto->nombre = $request->nombre;
        $contacto->ap_paterno = $request->ap_paterno;
        $contacto->ap_materno = $request->ap_materno;
        $contacto->dateOfBirth = $request->dateOfBirth;
        $contacto->alias = $request->alias;
        $contacto->save();


        return redirect("contacto")->with("message","actualizado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contacto::destroy($id);

        return redirect("contacto")->with("message","eliminado con éxito");
    }
}
