<?php

namespace App\Mail;

use App\Models\Curriculum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationByEmail extends Mailable
{
    use Queueable, SerializesModels;

	/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            to: env('MAIL_FROM_ADDRESS'),
            subject: 'Notification Byemail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(view: 'mail',
        with: [
            'first_name'=>'first_name',
            'last_name'=>'last_name',
            'phone'=>'phone',
            'email'=>'email',
            'street_address'=>'street_address',
            'country'=>'country',
            'city'=>'city',
            'region'=>'region',
            'postal_code'=>'postal_code',
            'about'=>'about',
            'ip_send'=>'ip_send',
            'file_upload'=>'file_upload',
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
        ];
    }
}
