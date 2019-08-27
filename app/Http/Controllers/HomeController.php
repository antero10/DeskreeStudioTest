<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\UserFiles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function upload(Request $request)
    {
      if ($request->hasFile('file')) {
        $user = Auth::user();
        $file = new UserFiles();
        $file->url = $request->file->store('files');
        $file->name = $request->file->getClientOriginalName();
        $user->files()->save($file);
        return redirect('home');
      }
    }

    public function download(Request $request, String $fileName = null)
    {
      if ($fileName) {
        return Storage::download('files/'.$fileName);
      }
      if (Input::get('urls')) {
        $urls = explode(',', Input::get('urls'));
        $zipper = new \Chumper\Zipper\Zipper;
        $zipper->make(storage_path('download.zip'))->add(
            array_map(function($value) {
              return storage_path(str_replace('files/', 'app/files/', $value));
            }, $urls)
        )->close();
        return response()->download(storage_path('download.zip'));
      }
    }
}
