<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\User;

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
            $user = auth()->user();
            $noticia->user_id = $user->id;
            $noticia->save();
            return redirect(route('home'))->withStatus(__('Noticia criada com sucesso.'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect(route('noticia.add'))->withStatus(__('erro ao cadastrar erro:=>'. $th));

        }
    }

    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);

        $donoNoticia = User::where('id', $noticia->user_id)->first()->toArray();

        return view('noticias.show', ['noticia' => $noticia, 'autor' => $donoNoticia]);
    }

    public function getNoticia(Request $request)
    {
        $noticias = Noticia::where('title','LIKE', '%'.$request->data.'%')->get();
        return response()->json($noticias);
    }

    public function list()
    {
        $user = auth()->user();
        $noticias = Noticia::where('user_id', '=', $user->id)->get();

        return view('noticias.index',['allNoticias' => $noticias]);
    }
}
