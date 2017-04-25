<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 9:07 AM
 */

namespace Models;


use Framework\Base\Model;
use Globals\Utility;

/**
 * This is the model class for table "auths".
 * @Entity @Table(name="auths")
 **/
class Auth extends Model
{
    /**
     * @param array $data
     * @return Auth
     */
    public static function createAccount(array $data){
        $auth = new Auth();
        $auth->setUsername($data['username']);
        $auth->setEmail($data['email']);
        $auth->setPassword(($data['password']));
        $auth->setRole(Role::User);
        $auth->setLastLogin(date('Y:m:d H:i:s'));
        $auth->setStatus(Status::Active);
        $auth->save();
        return $auth;
    }

    /**
     * @param $username
     * @param $password
     * @return Auth
     */
    public static function login($username, $password){

        /** @var Auth $user */
        $user = self::findOneBy(['username' => $username, 'password' => md5($password)]);
        if($user !== null){
            $user->setLastLogin(date('Y:m:d H:i:s'));
            $user->update();
            Utility::getInstance()->session('current_user', $user);
        }
        return $user;
    }

    public static function changePassword($username, $old_password, $new_password){
        /** @var Auth $user */
        $user = self::findOneBy(['username' => $username, 'password' => md5($old_password)]);
        if(!$user) return false;
        $user->setPassword(($new_password));
        $user->update();
        return true;
    }

    /** @Column(type="string") */
    protected $username;

    /** @Column(type="string", length=128, unique=true)**/
    protected $email;

    /** @Column(type="string", length=265)**/
    protected $password;

    /** @Column(type="integer") **/
    protected $role;

    /** @Column(type="datetime")**/
    protected $last_login;

    protected $status;

    /**
     * @OneToOne(targetEntity="User", mappedBy="auth")
     */
    protected $user;


    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Auth
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Auth
     */
    public function setPassword($password)
    {
        $this->password = md5($password);

        return $this;
    }


    /**
     * @param int $role
     * @return $this
     */
    public function setRole($role){
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole(){
        return $this->role;
    }

    /**
     * Set last_login
     *
     * @param \DateTime $lastLogin
     * @return Auth
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;

        return $this;
    }

    /**
     * Get last_login
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set user
     *
     * @param \Models\User $user
     * @return Auth
     */
    public function setUser(\Models\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Models\User 
     */
    public function getUser()
    {
        return $this->user;
    }



    public static function findUserByLogin($login){
        return self::findOneBy(['username' => $login]);
    }
}
