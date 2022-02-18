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
            return redirect(route('noticia.add'))->with('error','erro ao criar noticia'.$th->getMessage());

        }
    }

    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);

        $donoNoticia = User::where('id', $noticia->user_id)->first()->toArray();

        return view('noticias.show', ['noticia' => $noticia, 'autor' => $donoNoticia]);
    }

    public function getNoticiaId($id)
    {
        $noticia = Noticia::findOrFail($id);      
        return response()->json($noticia);
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

    public function update(Request $request)
    {
        try {
            //code...       
            $data = $request->except('_token','_method','fotoAntiga');
        
            if($request->hasFile('image') && $request->file('image')->isValid())
            {
               if(!file_exists("/img/noticias/".$request->image))
               {
                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtolower('now')). "." . $extension;

                $requestImage->move(public_path('img/noticia'),$imageName);
                $data['image'] = $imageName;               
               }else
               {
                $data['image'] = $request->fotoAntiga;
               }
            }

            Noticia::findOrFail($request->id)->update($data);
            
            return redirect('/noticia/'.$request->id)->withStatus(__('Noticia atualizada com sucesso.'));

        } catch (\Exception $th) {
            //throw $th;
            return redirect(route('noticia.add'))->with('error','erro ao editar noticia'.$th->getMessage());

        }
    }

    public function destroy($id)
    {
        Noticia::findOrFail($id)->delete();

        return redirect( route('noticia.index'))->withStatus(__('Noticia deletada com sucesso.'));
    }

}
