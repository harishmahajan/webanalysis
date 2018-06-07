<?php
/**
 * Created by Indrek Päri
 * Date: 28.03.14 13:17
 */

namespace Model;

class Ajax extends \Webpage
{
    public function __construct(){

        $this->TemplateData['name'] = 'ajax.tpl';

    }

    public function fb_short_token(){

        /*
        print_r($_POST);
        Array
        (
            [accountID] => 10
            [pageID] => 525978864088811
            [accTok] => CAAG4LFVANukBAAuSabbYg9dZCwg0DNTy6bdofm5Bw7qaMuRZCdQJ6wSGBmZB9HjqQ2QqF7caVvM5OR4lfOLZBaxfYKZCd9T1d1HYxl8oiS7Y2rZBcQoJ5gzUaH034pPTl6l9Xu7hZA3pzuIAi1xH1L4E5yRuFVRUOU7KudsI82qsPmAfAjJo7BwBZCAERDs5w4Ev9gV9GDJXOQZDZD
        )
        */

        if($oConnection = \Connection::getFacebookConnection($_POST['accountID']))
        {
            // ask long term token and save it to database :)

            $oFB = new \Model\Facebook();
            $oFB->connect($_POST['accTok'],$oConnection->ConnectionID);

        }

        $this->TemplateData['data']['content'] = 'error';
    }

    public function fb_datain(){

        if(empty($_POST['data'])) return;

        // validate if account is mine
        if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$_POST['accountID']))
        {
            $oFb = new \Facebook($oAccount->AccountID, $_POST['pageID']);
            echo "in ajax.php";
            exit;

            switch($_POST['action']){
                case 'DataFb':

                    $oFb->update_DataFb($_POST['data']);

                break;
                case 'DataFb_Posts':

                    $oFb->update_DataFb_Posts($_POST['data']);

                break;
                case 'page_fans':
                case 'page_fans_city':
                case 'page_fans_country':
                case 'page_fans_gender_age':
                case 'page_views_external_referrals':
                case 'page_fans_by_like_source':
                case 'page_storytellers_by_age_gender':

                    $request = 'update_'.$_POST['action'];
                    $oFb->$request($_POST['data']);

                break;
                default:

                    print_r($_POST);

                break;
            }

            $oFb->updateminMax();

            $this->TemplateData['data']['content'] = 'ok';
        }
        else
        {
            $this->TemplateData['data']['content'] = 'error';
        }
       
        
    }
}