<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactAdminInquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquirydetails)
    {
        $this->inquirydetails = $inquirydetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $inquirydetails = $this->inquirydetails;
		
        return $this->from('hello@app.com', 'Efficient Corporate')
            ->subject('Contact Inquiry Arrived')
            ->view('mailtemplate.admincontactmail')
			->with(compact('inquirydetails'));
    }
}
