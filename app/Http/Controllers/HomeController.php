<?php

namespace App\Http\Controllers;

use App\Models\Noticia;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $noticias = Noticia::where('user_id', '=', $user->id)->simplePaginate(3);
        return view('dashboard', ['user' => $user, 'noticias' => $noticias]);
    }
}
