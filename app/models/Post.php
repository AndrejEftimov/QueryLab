<?php

class Post
{

    use Model;

    protected $table = 'post';

    protected $allowedColumns = [

        'title',
        'text',
        'image',
        'date',
        'tags',
        'user_id'
    ];

    public function insert_post($data)
    {
        if (!empty($data['title']) and !empty($data['text']) and !empty($data['tags'])) {
            $data['upvote_count'] = 0;
            $data['reply_count'] = 0;

            if(empty($data['image'])){
                $data['image'] = "";
            }

            $data['user_id'] = $_SESSION['USER']->id;

            $data['tags'] = implode(", ", $data['tags']);

            $this->insert($data);
            return true;
        }

        return false;
    }
}