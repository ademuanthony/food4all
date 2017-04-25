<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 1/7/2017
 * Time: 2:44 PM
 */

namespace Controllers\Backend;


use Globals\AppConstants;
use Globals\AppService;
use Models\Campaign;
use Models\Role;
use Facebook\Exceptions\FacebookSDKException;

class ToolsController extends BackendBaseController
{
    public function IndexAction(){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $page_info = Campaign::findAll([], $off_set, $this->page_size);


        return $this->render('index', ['page_info' => $page_info,
            'layout' => ['title' => 'Promotion Tools']]);
    }

    public function SocialShareAction($campaign_id, $network){

        if(in_array(null, [$campaign_id, $network])){
            $this->flashError('Required fields not sent');
            return $this->back();
        }
        /** @var Campaign $campaign */
        $campaign = Campaign::find($campaign_id);
        if(!$campaign){
            $this->flashError('Invalid campaign Id');
            return $this->back();
        }
        switch($network){
            case AppConstants::FACEBOOK:
                $this->ShareOnFacebook($campaign);
                break;
        }
    }

    protected function ShareOnFacebook(Campaign $campaign){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $member = $this->getCurrentMember();


        $fb = new \Facebook\Facebook([
            'app_id' => AppConstants::FACEBOOK_SECRET,
            'app_secret' => AppConstants::FACEBOOK_SECRET,
            'default_graph_version' => 'v2.4',
        ]);

        $helper = $fb->getCanvasHelper();
        $permissions = ['email', 'publish_actions']; // optional
        try {
            if (isset($_SESSION['facebook_access_token'])) {
                $accessToken = $_SESSION['facebook_access_token'];
            } else {
                $accessToken = $helper->getAccessToken();
            }
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        if (isset($accessToken)) {
            if (isset($_SESSION['facebook_access_token'])) {
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            } else {
                $_SESSION['facebook_access_token'] = (string) $accessToken;
                // OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();
                // Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            }

            // validating the access token
            try {
                $request = $fb->get('/me');
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                if ($e->getCode() == 190) {
                    unset($_SESSION['facebook_access_token']);
                    $helper = $fb->getRedirectLoginHelper();
                    $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
                    echo "<script>window.top.location.href='".$loginUrl."'</script>";
                    exit;
                }
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            // posting on user timeline using publish_actins permission
            try {
                // message must come from the user-end
                $data = ['message' => 'testing...'];
                $request = $fb->post('/me/feed', $data);
                $response = $request->getGraphNode()->asArray;
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            echo $response['id'];
            // Now you can redirect to another page and use the
            // access token from $_SESSION['facebook_access_token']
        } else {
            $helper = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
            echo "<script>window.top.location.href='".$loginUrl."'</script>";
        }

        die();

    }
}