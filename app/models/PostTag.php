<?php

class PostTag
{

    use Model;

    protected $table = 'post_tag';

    protected $allowedColumns = [

        'post_id', 
        'tag_id'
    ];

    public function insert_post_tag($post_id, $tag_name){
        $t = new Tag;
        $tag = $t->first(array('name' => $tag_name));

        $data = array('post_id' => $post_id, 'tag_id' => $tag->id);
        $this->insert($data);
    }
}