<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Notification;
use Carbon;
use App\Notifications\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'one' => 'required',
            'two' => 'required',
        ]);

        $data = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'one' => $request->one,
            'two' => $request->two,
        ]);

        try {
            Notification::route('mail', 'rajoniakter.dev@gmail.com')->notify(
                new ContactMail($request->all())
            );
        } catch (\Exception $e) {
            // dd($e->getMessage());

            

            return;
        }
        
        return response()->json([
            'data' => $data,
            'success' => true,
        ],201);

    }
}
