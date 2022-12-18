<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExamInvitationForStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $inviationCode;
    public $invitationLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student,$code)
    {
        $this->student = $student;
        $this->inviationCode = $code;
        $this->invitationLink = URL::to("/invitation/$code");
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Online Exam Invitation',
            from: new Address('admin@examity.com', 'Hari Upreti'),
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
            view: 'email.StudentInvitation',
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
