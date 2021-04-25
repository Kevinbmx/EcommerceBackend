<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pedidoConfirmado;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedidoConfirmado)
    {
        $this->pedidoConfirmado= $pedidoConfirmado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tu pedido de Niño Tienda se ha realizado exitosamente')->view('mails.confirmed');
    }
}
