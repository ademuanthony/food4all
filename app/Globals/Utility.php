<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 12:47 PM
 */

namespace Globals;


use Framework\Http\Client\HttpClient;
use Framework\TinyMvc;
use Models\Auth;
use Models\Member;
use Models\Store;
use Models\User;

use Aws\Ses\SesClient;

class Utility
{
    const DATETIME_FORMAT = 'y-m-d H:i:s';

    public static function isActiveMenu($slug){
        return TinyMvc::$app->currentRoute == $slug;
    }


    public static function slackDebugException($title, \Exception $exception){
        self::slackDebug($title, $exception->getMessage()." Trace: ".$exception->getTraceAsString());
    }

    /**
     * Debug with Slack
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @param $tag
     * @param $text
     */
    public static function slackDebug($tag, $text)
    {
        try{
            //xoxb-55390846452-E4AmK4St8uQBvR21WDqtMhx9
            $httpClient = new HttpClient();
            $data = ['username' => 'La Verita Bot', 'icon_emoji' => ':rat:',
                'attachments' => [
                    [
                        'fallback' => "$tag",
                        'color' => '#205081',
                        'author_name' => 'La Veritas - Food4All' ,
                        'title' => "$tag",
                        'text' => $text
                    ]
                ]];
            $httpClient->post('https://hooks.slack.com/services/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', json_encode($data));
        }catch (\Exception $ex){
            if(TinyMvc::isDevEnv()){
                dd($text);
            }
        }

    }

    /**
     * @author Ademu Anthony <ademuanthony@gmail.com>
     */
    public static function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }



    private function __construct()
    {
    }

    /**
     * @var Utility
     */
    private static $instance;

    /**
     * @return Utility
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Utility();
        }
        return self::$instance;
    }

    public function sendMail($data){
        // Replace path_to_sdk_inclusion with the path to the SDK as described in
// http://docs.aws.amazon.com/aws-sdk-php/v2/guide/quick-start.html
        define('REQUIRED_FILE','path_to_sdk_inclusion');

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
        define('SENDER', 'sender@example.com');

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
        define('RECIPIENT', 'recipient@example.com');

// Replace us-west-2 with the AWS region you're using for Amazon SES.
        define('REGION','us-west-2');

        define('SUBJECT','Amazon SES test (AWS SDK for PHP)');
        define('BODY','This email was sent with Amazon SES using the AWS SDK for PHP.');

        require REQUIRED_FILE;


        $client = SesClient::factory(array(
            'version'=> 'latest',
            'region' => REGION
        ));

        $request = array();
        $request['Source'] = SENDER;
        $request['Destination']['ToAddresses'] = array(RECIPIENT);
        $request['Message']['Subject']['Data'] = SUBJECT;
        $request['Message']['Body']['Text']['Data'] = BODY;

        try {
            $result = $client->sendEmail($request);
            $messageId = $result->get('MessageId');
            echo("Email sent! Message ID: $messageId"."\n");

        } catch (\Exception $e) {
            echo("The email was not sent. Error message: ");
            echo($e->getMessage()."\n");
        }
    }

    /**
     * get or set a session by key
     * @param $key
     * @param null $value
     * @return null
     */
    public function session($key, $value = null){
        if(!isset($_SESSION)){
            session_start();
        }
        if($value != null){
            $_SESSION[$key] = $value;
        }
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function unsetSession($key){
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param Store $store
     */
    public function setStore(Store $store){
        $this->session('current_store', $store);
    }

    /**
     * @return Auth
     */
    public function getCurrentUser(){
        return $this->session('current_user');
    }

    /**
     * @param $role
     * @return bool
     */
    public function isUserInRole($role){
        return $this->getCurrentUser()->getRole() == $role;
    }

    private $member = null;

    /**
     * @return Member|null
     */
    public function getCurrentMember(){
        if($this->member == null){
            if(!$this->getCurrentUser()) return new Member();
            $this->member = Member::getByUsername($this->getCurrentUser()->getUsername());
        }
        return $this->member;
    }

    private static $current_store = null;

    /**
     * @return Store
     */
    public function getStore(){
        $store = self::$current_store;

        if(!$store){

            ///*
            $url = 'http://food.example.com';

            $parsedUrl = parse_url($url);

            $host = explode('.', $parsedUrl['host']);

            $sub_domain = strtolower($host[0]) == 'www'?$host[1]:$host[0];
            //*/

            /*
            $sub_domain = '';
            $data = explode('.',$_SERVER['SERVER_NAME']); // Get the sub-domain here

            if (!empty($data[0])) {
                $sub_domain = $data[0]; // The * of *.mydummyapp.com will be now stored in $subdomain
            }

            */


            $store = Store::findOneBy(array('sub_domain' => $sub_domain));
            self::$current_store = $store;
        }

        return $store;
    }

    function getCurrentUrl(){
        return $this->getStore()->getUrl();
    }

    const THEME_SHOPLY = 'shoply';
    const THEME_ELEGANZA = 'eleganza';

    private static $thems = [self::THEME_ELEGANZA => 'Eleganza', self::THEME_SHOPLY => 'Shoply'];

    public static function getThemes(){
        return self::$thems;
    }


    public static function getLocalCurrencyValue($amount){
        return TinyMvc::$config[AppConstants::CURRENCY_VALUE] * $amount;
    }
}