<?php

namespace App\Http\Controllers;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Coba extends Controller
{
    public function index()
    {
        $cb = Carbon::now()->Format('dy');
        $id = IdGenerator::generate(['table' => 'alamat', 'length' => 10, 'prefix' =>'CUST-']);
        dd($cb);
        return view('coba');
    }
}
