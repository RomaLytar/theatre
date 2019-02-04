<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     * @param $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = \PDF::loadView('pdf.tickets', ['order' => $this->order])
            ->setOptions(['isFontSubsettingEnabled' => 'true']);

        $email = $this->view('emails.order-created')
            ->with(['order' => $this->order])
            ->subject('You have bought tickets successfully');

        $email->attachData($pdf->output(), 'order.pdf', ['mime' => 'application/pdf']);

        foreach ($this->order->tickets as $ticket) {
            $ticketPdf = \PDF::loadView('pdf.ticket', ['ticket' => $ticket, 'order' => $this->order])
                ->setOptions(['isFontSubsettingEnabled' => 'true']);
            $email->attachData($ticketPdf->output(), 'ticket' . $ticket->id . '.pdf', ['mime' => 'application/pdf']);
        }

        return $email;
    }
}
