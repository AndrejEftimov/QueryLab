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

    public function get_posts($tags){
        if(empty($tags)){
            return false;
        }
        
        $query = "SELECT post.id, post.title, post.text, post.image, post.date, ".
        "post.upvote_count, post.reply_count, post.tags, user.username, user.profile_image ";

        $query .= "FROM post ";

        $query .= "INNER JOIN user ON post.user_id = user.id ";

        $query .= "WHERE ";
    }
}