<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssociateAdded extends Mailable
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
        return $this->markdown('email.associate',['email'=>$this->email,'password'=>$this->password]);
    }
}
