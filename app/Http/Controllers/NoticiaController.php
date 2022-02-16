<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    //
    public function add()
    {
        return view('noticias.create');
    }

    public function create(Request $request)
    {
        try {
            //code...
       
            $noticia = new Noticia;
            $noticia->title = $request->title;
            $noticia->subtitle = $request->subtitle;
            $noticia->description = $request->description; 
            $noticia->font = $request->font;

            if($request->hasFile('foto') && $request->file('foto')->isValid())
            {
                $requestImage = $request->foto;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtolower('now')). "." . $extension;

                $requestImage->move(public_path('img/noticia'),$imageName);
                $noticia->image = $imageName;
            }
            // var_dump($request->hasFile('foto'));
            // var_dump($request->foto);
            $noticia->save();
            return redirect(route('noticia.add'))->withStatus(__('Noticia criada com sucesso.'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect(route('noticia.add'))->withStatus(__('erro '));

        }
    }
}
