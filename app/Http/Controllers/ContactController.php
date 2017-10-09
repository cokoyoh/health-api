<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function getMessage()
    {
        Mail::send('mails.contact-us',
            [
                'name' => request('full_name'),
                'email' => request('email'),
                'phone_number' => request('phone_number'),
                'user_message' => request('text')
            ], function($message)
            {
                $sender = request('email');
                $receiver = 'info@justabus.com';
                $message->from($sender, request('full_name'));
                $message->to($receiver , 'Admin')->subject('Website Email');
            });

        return response(['message' => 'Message sent. Thank you.'],200);
    }
}
