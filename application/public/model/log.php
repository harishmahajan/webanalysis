<?php
/**
 * Created by Indrek Päri
 * Date: 21.03.14 14:59
 */

namespace Model;
//error_reporting(E_ALL); 
class Log extends \Webpage
{

    private $aTplVars = array();

    public function __construct(){
        // if no action skip
        if(!isset($_POST['action'])) return;

        switch($_POST['action']){

            case 'login':

                if(\Utility\Client::logIn($_POST['email'],$_POST['password']) == false)
                {
                    $this->aTplVars['login_error'] = 'Incorrect Email and/or Password!';
                }

            break;
            case 'register':

                $this->aTplVars['register_error'] = 'Registration closed at the moment!';
                /*
                if(\Utility\Client::register($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password']) == false)
                {
                    $this->aTplVars['register_error'] = 'You have already registered, please log in!';
                }
                */

            break;
            case 'logout':

                \Utility\Client::logOut();

            break;
        }

    }

    public function in(){
        $this->addSub('login.tpl','content',$this->aTplVars);
    }

    public function out(){

        \Utility\Client::logOut();

    }
}
