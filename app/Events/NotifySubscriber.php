<?php

namespace App\Events;

use App\Blog;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifySubscriber
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Blog
     */
    public $blog;
    /**
     * @var User
     */
    public $author;

    /**
     * Create a new event instance.
     *
     * @param Blog $blog
     * @param User $author
     */
    public function __construct(Blog $blog, $author)
    {
        $this->blog = $blog;
        $this->author = $author;
    }
}
