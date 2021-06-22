<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use App\Models\Message;
use App\Models\friend_list;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\Notice;

class HomeController extends Controller
{
    public function getHomepage(){
        if(Auth::check()){
            return view('home', 
            [
                'friendList' => friend_list::getFriendsOfOneAccount((int)Auth::user()->id), 
                'dataAccount' => User::getOneData('id', (int)Auth::user()->id)
            ]);
        }else{
            return redirect()->route('login');
        }
    }

    //send data chat to javascript client based on id account owner and his/her friend id.
    public function getDataChat(Request $request){
        // $dataServer = Message::getAllMessageOneAccount($_GET['friend_id'], $_GET['account_id']);
        // header('Content-Type: application/json');
        // echo json_encode($dataServer);

        $dataServer = Message::getAllMessageOneAccount($request->friend_id, $request->account_id);
        return response()->json($dataServer, 200);
    }

    public function saveDataAndGetLatestData(Request $request){
        // Message::addNewData((int)$_GET['account_id'], (int)$_GET['friend_id'], $_GET['chatData']);
        // $newData = Message::getAllMessageOneAccount($_GET['friend_id'], $_GET['account_id']);
        // header('Content-Type: application/json');
        // echo json_encode($newData);

        Message::addNewData((int)$request->account_id, (int)$request->friend_id, $request->chatData);
        $newData = Message::getAllMessageOneAccount($request->friend_id, $request->account_id);
        return response()->json($newData, 200);
    }

    public function setAndSendNewNotification(Request $request){
        $targetDataJSON = json_decode($request->targetId);
        $senderDataJSON = json_decode($request->senderId);

        $targetUser = User::getOneData('id', $targetDataJSON);
        $senderUser = User::getOneData('id', $senderDataJSON);
        
        event(
            new Notice(
                $targetUser,
                $senderUser 
            )
        );
        return ['success' => true];
    }

    public function loginValidation(Request $request){
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
   
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // return view('home', 
            // [
            //     'friendList' => friend_list::getFriendsOfOneAccount((int)Auth::user()->id), 
            //     'dataAccount' => User::getOneData('id', (int)Auth::user()->id)
            // ]);
            return redirect()->route('homepage');
        }
  
        return redirect()->route('login');
    }

    public function create(array $data){
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 

    public function validateAndSaveRegistrationData(Request $request){  
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        // ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect()->route('login');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('login');
    }

}
