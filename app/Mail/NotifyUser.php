<?php

namespace App\Mail;

use App\Blog;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUser extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $author;
    /**
     * @var Blog
     */
    public $blog;
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $author
     * @param Blog $blog
     * @param User $user
     */
    public function __construct(User $author, Blog $blog, User $user)
    {
        $this->author = $author;
        $this->blog = $blog;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notify@app.com')
            ->view('emails.notify');
    }
}
