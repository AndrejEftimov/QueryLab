<?php

class PostUpvote
{

    use Model;

    protected $table = 'post_upvote';

    protected $allowedColumns = [

        'user_id',
        'post_id'
    ];

    public function delete($user_id, $post_id)
    {
        $query = "delete from $this->table where user_id = $user_id and post_id = $post_id";
        $this->query($query);

        return false;
    }

}