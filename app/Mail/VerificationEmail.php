<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;

class VerificationEmail extends Mailable
{
    public $randomPassword;
    public $verificationToken;
    public $userId;
    public $registeredId;

    /**
     * Create a new message instance.
     */
    public function __construct($registeredId, $randomPassword,  $verificationToken)
    {
        $this->randomPassword = $randomPassword;
        $this->verificationToken =  $verificationToken;
    
        $this->verificationLink = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $registeredId,
                'hash' => $verificationToken,
            ]
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
 
        return $this->view('emails.verification')
        ->with(['verificationLink' => $this->verificationLink])
        ->subject('Verification Email');
    }
}
