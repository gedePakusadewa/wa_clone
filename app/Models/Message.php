<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = ['id', 'created_at', 'sender_id', 'receiver_id', 'memo'];

    static function addNewData($sender_id, $receiver_id, $memo){
        return Message::create([
            'sender_id' => $sender_id, 
            'receiver_id'  => $receiver_id,
            'memo'  => $memo,
        ]);
    }

    static function addSampleData(){
        return Message::addNewData('1', '2', 'Hai!!!!');
    }
}
