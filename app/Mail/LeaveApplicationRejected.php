<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeaveApplicationRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $updateTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $updateTransaction)
    {
        $this->updateTransaction = $updateTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.leave-application-rejected')
                    ->subject('Halo, Maaf Pengajuan Cuti Anda Ditolak');
    }
}
