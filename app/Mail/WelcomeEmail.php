<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        return $this->subject('TUBOQUEST INFORMATION')
                    ->view('emails.welcomeEmail')
                    ->with(
                        'imagePath', env('APP_URL') . '/assets/logo.png'
                    );
    }
}