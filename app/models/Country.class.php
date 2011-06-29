<?php
class Country extends Common
{
    public $id;
    public $iso;
    public $name;
    public $printable_name;
    public $iso3;
    public $numcode;
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
