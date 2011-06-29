<?php
class Post extends Common
{
    public $id;
    public $user_id;
    public $category_id;
    public $post_title;
    public $post_content;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    
    public $rel;
    
    function __construct($params=NULL)
    {
        $this->constructor($params);
        $dao = new DAO();
        $this->rel = $dao->get_related($this);
        return $this;
    }
}
?>
