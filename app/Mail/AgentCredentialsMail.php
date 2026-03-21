<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($agent, $password)
    {
        $this->agent = $agent;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Padosi Agents - Your Account Credentials',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.agent_credentials',
            with: [
                'agent' => $this->agent,
                'password' => $this->password,
            ]
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
