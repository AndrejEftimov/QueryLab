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

            $this->insert($data);
            return true;
        }

        return false;
    }

    public function get_tags($post_id){
        $query = "SELECT tag.name FROM post INNER JOIN post_tag ON post.id = post_tag.post_id and post.id = $post_id INNER JOIN tag ON post_tag.tag_id = tag.id ORDER BY tag.name ASC";
        $result = $this->query($query);

        if(empty($result)){
            $result = [];
        }

        return $result;
    }

    public function get_posts_for_tags($tags){
        if(empty($tags)){
            return array();
        }
        
        $query = "SELECT post.id, post.title, post.text, post.image, post.date, 
        post.upvote_count, post.reply_count, user.id AS user_id, user.username, user.profile_image 
        FROM post_tag
        INNER JOIN post ON post_tag.post_id = post.id and ";

        foreach($tags as $tag){
            $query .= "post_tag.tag_id = $tag->id and ";
        }

        $query = trim($query," and ");

        $query .= " INNER JOIN user ON post.user_id = user.id ORDER BY post.date DESC";

        $result = $this->query($query);

        if(empty($result)){
            $result = [];
        }

        return $result;
    }
}