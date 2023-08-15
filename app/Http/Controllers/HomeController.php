<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        foreach (warehouse() as $key => $value) {
            $data[$key] = [
                'label' => $value['label'],
                'counts' => Item::where('warehouse',$key)->count(),
            ];
        }
        return view('home',[
            'data' => $data
        ]);
    }
}
