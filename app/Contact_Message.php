<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_Message extends Model
{
    protected $fillable = ['message_id', 'username', 'phone_number','email','message'];
    protected $primaryKey = 'message_id';
    protected $table = 'contact_messages';
}
