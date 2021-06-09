<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;

class HomeController extends Controller
{
    public function getHomePage(){
        return view('home');
        //Accounts::addSampleData();
    }

    public function tes123(){
        $dataServer = "ulala ".$_GET['code'];
        header('Content-Type: application/json');
        echo json_encode($dataServer);
    }
}
