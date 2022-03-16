<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $title,$description;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('post.post-mail')->subject("New Post added");

    }
}