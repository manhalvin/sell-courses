<?php

namespace App\Mail\API;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('api.mail.forgot_password')
            ->from('quocmanh1998s@gmail.com', 'Quốc Mạnh')
            ->subject('Link Code OTP')
            ->with($this->data);
    }
}
