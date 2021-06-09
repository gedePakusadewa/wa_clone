<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;
    protected $table = 'wa_clone';
    protected $fillable = ['id', 'created_at', 'username', 'passwd'];

    static function addNewData($username, $passwd){
        return Accounts::create([
            'username' => $username, 
            'passwd'  => $passwd
        ]);
    }

    static function addSampleData(){
        return Accounts::addNewData('deltagod', 'qwer1234');
    }
}
