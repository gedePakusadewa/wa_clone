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
    public function getHomePage(Request $request){
        //return view('home');
        //Accounts::addSampleData();
        //Message::addSampleData();
        //friend_list::addSampleData();
        //var_dump(friend_list::getFriendsOfOneAccount(1));
        // $iduser = $request->input('userId');
        // return view('home', ['friendList' => friend_list::getFriendsOfOneAccount((int)$iduser), 'dataAccount' => Accounts::getOneData('id', $iduser)]);
        // foreach(Message::getAllMessageOneAccount(2,1) as $data){
        //     echo $data->sender_id."<br />";
        //     echo $data->memo."<br /><br />";
        // };

         // $mgLenght = count($magazine);
        // $ntLenght = count($note);
        // $i = 0;
        // $k = 0;
        // $incre = 0;
        // $tmp = "";

        // $magazine = array('two', 'times', 'three', 'is', 'not', 'four', 'two', 'two');
        // $note = array('two', 'times', 'two', 'is', 'four');
        // $status = true;
        // $tmpArrayMag = array_count_values($magazine);
        // $tmpArrayNote = array_count_values($note);

        // foreach($tmpArrayNote as $key => $value){
        //     if($status === false){
        //         break;
        //     }
        //     if(array_key_exists($key, $tmpArrayMag)){
        //         if($tmpArrayMag[$key] === $tmpArrayNote[$key] 
        //             || $tmpArrayNote[$key] < $tmpArrayMag[$key]){
        //             $status = true;
        //         }else{
        //             $status = false;
        //         }
        //         //var_dump($tmpArrayMag[$key] === $tmpArrayNote[$key]);
        //     }
        // }
        //$text = implode(" ", $magazine);
        // for($i = 0; $i < $ntLenght; $i++){
        //     for($k = 0; $k < $mgLenght; $k++){
        //         if($note[$i] === $magazine[$k]){
        //             $incre++;
        //             //$magazine[$k] = "asas".strval($i);
        //             if($mgLenght - 1 !== $k){
        //                 $tmp = $magazine[$mgLenght - 1];
        //                 $magazine[$mgLenght - 1] = $magazine[$k];
        //                 $magazine[$k] = $tmp;
        //             }
        //             array_pop($magazine);
        //             $k = $mgLenght;
        //         }
        //     }
        //     $mgLenght = $mgLenght - 1;
        // }
        
        // if($status === true){
        //     print('Yes');
        // }else{
        //     print('No');
        // }
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

    public function notifToClient(Request $request){
        $dtaJSON = json_decode($request->targetId);
        // $tes = new Notice($request->targetId);
        // $tes->id = $request->targetId;
        // $dta = "1";
        $account = Accounts::getOneData('id', $dtaJSON);
        event(
            new Notice(
                //$request->input('targetId')
                $account
                //$_POST['targetId']
                //data['targetId']
                //$dtaJSON->targetId
                //$tes
                //strval($dtaJSON)
                //'2'
            )
        );
        // $newData = "goblok lu";
        // header('Content-Type: application/json');
        // echo json_encode($newData);
        return ['success' => $account];
    }

    public function customLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
   
        $credentials = $request->only('email', 'password');
        // Auth::attempt($credentials);
        // var_dump(Auth::check());
        if (Auth::attempt($credentials)) {
            //return view('index', ['userId' => Auth::user()->id]);
            //echo Auth::user()->id
            return view('home', ['friendList' => friend_list::getFriendsOfOneAccount((int)Auth::user()->id), 'dataAccount' => User::getOneData('id', (int)Auth::user()->id)]);
        }
  
        // return redirect("login");
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 

    public function customRegistration(Request $request)
    {  
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
