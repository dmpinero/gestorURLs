<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\URL;

class ShowURLsController extends Controller
{
    public function index()
    {
        // Recuperar todas las URLs
        $urls = URL::all();

        // Devolver a la vista con el parámetro $post
        return view('url.list')->withurls($urls);
    }
}
