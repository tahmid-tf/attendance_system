<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SendExportedFile extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subject;
    public $message;
    public $filePath;

    public function __construct($subject, $message, $filePath)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->view('view.name');

        return $this->subject($this->subject)
            ->attach($this->filePath, [
                'as' => 'attendance_report.xlsx',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])
            ->markdown('emails.send_exported_file')  // Move this line to the end
            ->with([
                'subject' => $this->subject,
                'message' => $this->message,
            ]);
    }
}
