<?php
class User extends Common
{
    public $id;
    public $user_full_name;
    public $user_email;
    public $user_pass;
    public $user_activation_key;
    public $user_status;
    public $user_last_login;
    public $user_thumb;
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
