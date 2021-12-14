<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $email="";
    public $password="";
    public function __construct($email,$password)
    {
      $this->email=$email;
      $this->password=$password;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.adminadded',['email'=>$this->email,'password'=>$this->password]);
    }
}
