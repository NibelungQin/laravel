<?php

namespace App\Mailer;


use Illuminate\Support\Facades\Mail;

class Mailer
{
    public function sendTo($user,$subject,$view,$data=[])
    {
        Mail::queue($view,$data,function ($message) use ($user,$subject){
            $message->to($user->email)->subject($subject);
        });
    }
}