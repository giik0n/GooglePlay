<?php

namespace App\Http\Controllers;

use App\Models\Apps;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $categories;

    public function __construct()
    {
        // $this->middleware('auth');
        if (!session()->has('category')) {
            session(['category' => 'All']);
        }
        $this->categories = Category::orderBy('id')->get()->keyBy('id');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => ""]);
        session(['category' => 'All']);
        $items = Apps::orderBy('created_at')->take(15)->get();
        return view('welcome', ['items' => $items, 'categories' => $this->categories]);
    }

    public function app($id)
    {
        $categories = Category::orderBy('id')->get();
        $images = $this::getImages($id);
        $app = Apps::where('id', $id)->first();
        return view('apps.app', compact('app', 'categories', 'images'));
    }

    public function setCategory(Request $request)
    {
        $id = (int)$request->id;
        session(['category' => $this->categories[$id]->name]);
        return "OK";
    }

    public static function getImages($id = '')
    {
        $path = public_path() . '/images/apps/' . $id . '/';
        return HomeController::getFiles($path);

    }

    public static function getFile($id = '')
    {
        $path = public_path() . '/apps/' . $id . '/';
        return HomeController::getFiles($path)[2];
    }

    private static function getFiles($path)
    {
        if (is_dir($path)) {
            $files = array_diff(scandir($path), array('.', '..'));
        } else {
            $files = [];
        }
        return $files;
    }
    public function uploade(){
        if(!Auth::user()->developper){
            return redirect()->back();
        }
        return view('developper.index', ['categories' => $this->categories]);
    }

}
