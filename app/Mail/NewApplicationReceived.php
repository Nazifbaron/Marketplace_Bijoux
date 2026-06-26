<?php

namespace App\Mail;

use App\Models\ArtisanApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public ArtisanApplication $application;

    /**
     * Create a new message instance.
     */
    public function __construct(ArtisanApplication $application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nouvelle candidature artisan — L\'Éclat du Bénin')
                    ->view('emails.new_application_received')
                    ->with(['application' => $this->application]);
    }
}
