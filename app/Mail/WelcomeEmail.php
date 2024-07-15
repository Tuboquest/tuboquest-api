<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     * 
     * @return this
     */
    public function build()
    {
        $url = Storage::url('img/logo.png');
        return $this->view('emails.welcomeEmail')
                    ->subject('TUBOQUEST INFORMATION')
                    ->with(['logoUrl' => $url]);
    }
}