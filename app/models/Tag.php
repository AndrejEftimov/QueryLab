<?php

class Tag
{

    use Model;

    protected $table = 'tag';

    protected $allowedColumns = [

        'name'
    ];

    function __construct()
    {
        $this->limit = 9999;
        $this->order_type = "asc";
    }

    public function get_tag_ids($tag_names){
        if(empty($tag_names)){
            return array();
        }

        $query = "SELECT * FROM tag WHERE ";

        foreach($tag_names as $tag_name){
            $query .= "name = '$tag_name' or ";
        }

        $query = trim($query," or ");

        $result = $this->query($query);

        return $result;
    }

}