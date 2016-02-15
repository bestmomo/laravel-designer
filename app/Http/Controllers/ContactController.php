<?php

namespace App\Http\Controllers;

use Mail;

use App\Http\Requests\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function contact(Contact $request)
    {        

    	Mail::send('emails.message', [
        	'email' => $request->input('email'),
        	'mess' => $request->input('message')
        	], function ($m) {
            $m->to(config('mail.to.adress'), config('mail.to.name'))->subject('Message de Laravel Designer');
        });  

 		return response()->json();

    }

}
