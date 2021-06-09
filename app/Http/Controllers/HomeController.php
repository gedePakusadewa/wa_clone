<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHomePage(){
        return view('home');
    }

    public function tes123(){
        $dataServer = "ulala ".$_GET['code'];
        header('Content-Type: application/json');
        echo json_encode($dataServer);
    }
}
