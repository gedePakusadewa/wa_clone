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

    //send data chat to javascript client based on id account owner and his/her friend id.
    public function sendDataChatToClient(){
        $dataServer = Message::getAllMessageOneAccount($_GET['friend_id'], $_GET['account_id']);
        header('Content-Type: application/json');
        echo json_encode($dataServer);
    }

    public function saveAndSentNewDataToClient(){
        Message::addNewData((int)$_GET['account_id'], (int)$_GET['friend_id'], $_GET['chatData']);
        $newData = Message::getAllMessageOneAccount($_GET['friend_id'], $_GET['account_id']);
        header('Content-Type: application/json');
        echo json_encode($newData);
    }
    
}
