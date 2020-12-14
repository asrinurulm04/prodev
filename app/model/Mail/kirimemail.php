<?php

namespace App\model\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class kirimemail extends Mailable
{
    use Queueable, SerializesModels;

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
     * @return $this
     */

public function build()
{
       return $this->from('prodev@nutrifood.co.id')
                   ->view('email')
                   ->with(
                    [
                        'nama' => 'Admin PRODEV',
                    ]);
}
}
