<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class friend_list extends Model
{
    use HasFactory;
    protected $table = 'friend_lists';
    protected $fillable = ['id', 'created_at', 'account_id', 'friend_account_id'];

    static function addNewData($account_id, $friend_account_id){
        return friend_list::create([
            'account_id' => $account_id, 
            'friend_account_id'  => $friend_account_id
        ]);
    }

    static function addSampleData(){
        return friend_list::addNewData('1', '2');
    }

    // static function getFriendsOfOneAccount($account_id){
    //     return Accounts::
    // }
}
