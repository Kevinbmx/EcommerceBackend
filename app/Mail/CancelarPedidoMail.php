<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelarPedidoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pedidoCancelado;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedidoCancelado)
    {
        $this->pedidoCancelado= $pedidoCancelado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Has cancelado tu pedido de Niño Tienda')->view('mails.cancelar');
    }
}
