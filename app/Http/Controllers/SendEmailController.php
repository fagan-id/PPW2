<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    // public function index()
    // {
    //     $content = [
    //         'name' => 'Ini Nama Pengirim',
    //         'subject' => 'ini Subject Email',
    //         'body' => 'Ini adalah isi email yang dikirim dari laravel 10'
    //     ];

        // Mail::to('mustafafagan@gmail.com')->send(new SendEmail($content));

    //     return "Email Berhasil Dikirim";
    // }

    public function index()
    {
        return view('emails.kirim-email');
    }

    public function store(Request $request)
    {
        // Validate Data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $data = $request->all();
        Mail::to($data['email'])->send(new SendEmail($data));
        return redirect()->route('kirim-email')->with('status', 'Email berhasil dikirim');
    }
}
