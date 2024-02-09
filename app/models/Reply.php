<?php

class Reply
{

    use Model;

    protected $table = 'reply';

    protected $allowedColumns = [

        'text',
        'date',
        'upvote_count',
        'post_id',
        'user_id'
    ];

    public function insert($data)
    {

        /** remove unwanted data **/
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        $this->query($query, $data);

        $post = new Post;
        $post->increment_reply_count($data['post_id']);

        return false;
    }

    public function get_replies_for_post($post_id)
    {
        $query = "SELECT reply.id, reply.text, reply.date, reply.upvote_count, user.id as user_id, user.username, user.profile_image 
        FROM reply 
        INNER JOIN user ON reply.user_id = user.id and reply.post_id = $post_id 
        ORDER BY reply.date DESC";

        $result = $this->query($query);

        if (empty($result)) {
            $result = [];
        }

        return $result;
    }

    public function get_replies_for_user($user_id)
    {
        $query = "SELECT reply.id, reply.text, reply.date, reply.upvote_count, user.id as user_id, user.username, user.profile_image, post.id as post_id 
        FROM reply 
        INNER JOIN user ON reply.user_id = user.id and user.id = $user_id 
        INNER JOIN post ON reply.post_id = post.id 
        ORDER BY reply.date DESC";

        $result = $this->query($query);

        if (empty($result)) {
            $result = [];
        }

        return $result;
    }

}