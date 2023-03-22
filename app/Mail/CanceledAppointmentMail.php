<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CanceledAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $specialty_name;
    public $doctor_name;
    public $cancellation_justification;
    public $person_cancel_appointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $specialty_name, $doctor_name, $cancellation_justification, $person_cancel_appointment)
    {
        $this->appointment = $appointment;
        $this->specialty_name = $specialty_name;
        $this->doctor_name = $doctor_name;
        $this->cancellation_justification = $cancellation_justification;
        $this->person_cancel_appointment = $person_cancel_appointment;
    
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Cita Cancelada Sistema Médico San Benito',
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
            view: 'mails.canceled_appointment',
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
