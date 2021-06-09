<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use App\Models\Message;
use App\Models\friend_list;

class HomeController extends Controller
{
    public function getHomePage(){
        //return view('home');
        //Accounts::addSampleData();
        //Message::addSampleData();
        //friend_list::addSampleData();
        //var_dump(friend_list::getFriendsOfOneAccount(1));
        $iduser = 1;
        return view('home', ['friendList' => friend_list::getFriendsOfOneAccount($iduser), 'dataAccount' => Accounts::getOneData('id', $iduser)]);
        // foreach(Message::getAllMessageOneAccount(2,1) as $data){
        //     echo $data->sender_id."<br />";
        //     echo $data->memo."<br /><br />";
        // };
    }

    public function tes123(){
        //$dataServer = "friend_id -> ".$_GET['friend_id']." account_id-> ".$_GET['account_id'];
        $dataServer = Message::getAllMessageOneAccount($_GET['friend_id'], $_GET['account_id']);
        header('Content-Type: application/json');
        echo json_encode($dataServer);
    }
    
}
