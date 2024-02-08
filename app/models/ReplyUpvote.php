<?php

class ReplyUpvote
{

    use Model;

    protected $table = 'reply_upvote';

    protected $allowedColumns = [

        'user_id',
        'reply_id'
    ];

    public function delete($user_id, $reply_id)
    {
        $query = "delete from $this->table where user_id = $user_id and reply_id = $reply_id";
        $this->query($query);

        return false;
    }

}