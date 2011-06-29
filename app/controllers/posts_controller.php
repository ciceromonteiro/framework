<?php
class Posts_Controller extends App_Controller
{
    function add()
    {
    	global $CFG;
        global $DATA;
        global $MSG;
        global $FIELDS;
        if ($DATA)
        {
            validates_presence_of('Post', 'post_title', 'Title');
            validates_presence_of('Post', 'post_content', 'Content');
            if (!check_errors())
            {
                $dao = new DAO();
                $DATA["Post"]["user_id"] = $_SESSION["user_id"];
                $post = new Post($DATA["Post"]);
                if ($id = $dao->Create($post))
                {
                	redirect_to("posts/show/$id");
                }
            }
        }
        return false;
    }
}
?>