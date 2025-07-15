<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $templateId;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message, $templateId = null)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->templateId = $templateId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->templateId) {
            $template = EmailTemplate::find($this->templateId);
            if ($template) {
                return new Content(
                    view: 'emails.template',
                    with: [
                        'content' => $template->content,
                        'customMessage' => $this->message,
                    ],
                );
            }
        }

        return new Content(
            view: 'emails.basic',
            with: [
                'message' => $this->message,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 