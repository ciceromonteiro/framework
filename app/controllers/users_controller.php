<?php
/**
* @package      User
* @author       Cicero Monteiro
* @version      1.10.6
* @description  ContŽm regras de neg—cio para a entidade Usu‡rios
*/
class Users_Controller extends App_Controller
{
    /**
    * @package      User
    * @subpackage   users_controller
    * @author       Cicero Monteiro
    * @description  Adiciona um novo usu‡rio
    */
    function add()
    {
        global $CFG;
        global $DATA;
        global $MSG;
        global $FIELDS;
        if ($DATA)
        {
            //var_dump($DATA);
            validates_presence_of('User', 'user_full_name', 'Full Name');
            validates_presence_of('User', 'user_pass', 'Password');
            validates_presence_of('User', 'user_pass_confirm', 'Confirm Password');
            validates_format_of('User', 'user_email', 'email', 'Email', true);
            if (@$DATA['User']['user_pass'] != @$DATA['User']['user_pass_confirm'])
            {
                $MSG->error[] = "The passwords must be equal.";
                $FIELDS[] = 'user_pass_confirm';
            }
            if (!check_errors())
            {
                $dao = new DAO();
                unset($DATA['User']['terms']);
                unset($DATA['User']['user_pass_confirm']);
                $DATA['User']['user_pass'] = sha1(md5($DATA['User']['user_pass']));
                $DATA['User']['user_activation_key'] = uuid();
                $user = new User($DATA['User']);
                if ($dao->Create($user, true))
                {
                    $addr = WWWROOT."/join?auth=".$DATA['User']['user_activation_key'];
                    $MSG->success[] = "Awesome! Now check out your email to activate your account.";
                    $MSG->success[] = "Actually, it's a test, so <a href=\"$addr\">click here</a> to activate it.";
                }
            }
        }
        return false;
    }
    /**
    * @author       Cicero Monteiro
    * @description  Autentica um usu‡rio recŽm cadastrado
    */
    function auth($key)
    {
        global $CFG;
        global $DATA;
        global $MSG;
        global $FIELDS;
        $dao = new DAO();
        if ($user = $dao->Retrieve('Users', array('user_activation_key'=>$key), true, true))
        {
            if($user->user_status == '0')
            {
                $user->set('user_status',1);
                if ($dao->Update($user))
                {
                    $MSG->success[] = "Great! Your account is now active. <a href=\"".WWWROOT."/login\">Do login</a> and enjoy!";
                }
            }
            else
            {
                $MSG->notice[] = "You have been activated already. Try to <a href=\"".WWWROOT."/login\">login</a> to use your account.";
                $MSG->notice[] = "You can also retrieve your password by <a href=\"".WWWROOT."\">clicking here</a>.";
            }
        }
        else
        {
            $MSG->error[] = "Opps... Something wrong happen. Please check your activation link or contact our support.";
        }
    }
    /**
    * @author       Cicero Monteiro
    * @description  Loga um usu‡rio no sistema e inicia a sess‹o
    */
    function login()
    {
        global $MSG;
        global $DATA;
        if ($DATA)
        {
            validates_presence_of('User', 'user_email', 'Email');
            validates_presence_of('User', 'user_pass', 'Password');
            if (!check_errors())
            {
                $dao = new DAO();
                $params = array('user_email'=>$DATA['User']['user_email'],'user_pass'=>sha1(md5($DATA['User']['user_pass'])));
                if ($user = $dao->Retrieve('Users', $params, true, true))
                {
                    // successfully login
                    if ($user->user_status == '1')
                    {
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['logged_since'] = date('l, F jS Y');
                        $user->set('user_last_login', now());
                        $dao->Update($user);
                    }
                    else
                    {
                        $addr = WWWROOT."/join?auth=".$user->user_activation_key;
                        $MSG->alert[] = "Look, your account must be activated to proceed with login. <a href=\"$addr\">Click here</a> to activate your account.";
                    }
                }
                else
                {
                    $MSG->error[] = "Opps... Something wrong happen. Please verify your data before proceed.";
                }
            }
        }
    }
    /**
    * @author       Cicero Monteiro
    * @description  Termina a sess‹o do usu‡rio
    */
    function logout()
    {
        session_destroy();
        session_unset();
        redirect_to("login");
    }
}
?>
