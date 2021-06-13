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
        return friend_list::addNewData('1', '3');
    }

    // static function getFriendsOfOneAccount($account_id){
    //     return friend_list::select('accounts.id', 'accounts.username', 'accounts.path_img_profile')
    //                     ->join('accounts', 'friend_lists.friend_account_id', '=', 'accounts.id')
    //                     ->where('friend_lists.account_id', '=', $account_id)
    //                     ->get();
    // }

    static function getFriendsOfOneAccount($account_id){
        return friend_list::select('users.id', 'users.name', 'users.path_img_profile')
                        ->join('users', 'friend_lists.friend_account_id', '=', 'users.id')
                        ->where('friend_lists.account_id', '=', $account_id)
                        ->get();
    }
}
