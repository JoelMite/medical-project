<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservedAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $created_appointment;
    public $specialty_name;
    public $doctor_name;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($created, $specialty_name, $doctor_name)
    {
        $this->created_appointment = $created;
        $this->specialty_name = $specialty_name;
        $this->doctor_name = $doctor_name;
    
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Cita Reservada Sistema Médico San Benito',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.reserved_appointment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
