<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/17/2016
 * Time: 12:47 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Framework\Base\Model;
use Globals\Utility;
use Models\Auth;
use Models\BankDetail;
use Globals\AppService;
use Models\Member;
use Models\TempMember;

class AccountController extends BackendBaseController
{
    public function LoginAction(){
        $return_url = $this->request->get('return_url');

        if($this->request->isMethod('post')){
            $login = $this->request->get('login');
            $password = $this->request->get('password');
            if(in_array(null, [$login, $password])){
                $this->flashError('Email and password are required');
                return $this->renderPartial('login');
            }
            $user = Auth::login($login, $password);
            if(!$user){
                $this->flashError('Invalid email or password');
                return $this->renderPartial('login');
            }

            Utility::getInstance()->session('current_user', $user);
            return $this->redirectTo($return_url? $return_url: AppService::RouteBackendDashboard);
        }
        return $this->renderPartial('login');
    }

    public function RegisterAction(){
        //check session for entered data
        $temp_member = new TempMember();
        if($id_ref = Utility::getInstance()->session('temp_member_id')){
            $temp_member = TempMember::getFromRef($id_ref);
        }

        if($this->request->isMethod('post')){
            try{
                Model::beginTransaction();

                $email = $this->request->get('email');
                $username= $this->request->get('username');
                $sponsor_id = $this->request->get('sponsor_id');
                $parent_id = $this->request->get('parent_id');
                $password = $this->request->get('password');
                $retype_password = $this->request->get('retype_password');
                $payment_method = $this->request->get('payment_method');
                $number_of_accounts = $this->request->get('number_of_accounts');


                if($password !== $retype_password){
                    $this->flashError('The confirmation password is not the same is the selected password');
                    return $this->back();
                }

                $temp_member->setEmail($email);
                $temp_member->setNumberOfAccounts($number_of_accounts);
                $temp_member->setParentId($parent_id);
                $temp_member->setPassword($password);
                $temp_member->setSponsorId($sponsor_id);
                $temp_member->setUsername($username);
                $temp_member->setPaymentMethod($payment_method);

                if(in_array(null, [$email, $username, $password, $payment_method])){
                    $this->flashError('Please enter your email, username and password and select a payment method');
                    return $this->renderPartial('register', ['member' => $temp_member]);
                }
                $temp_member->save();
                Utility::getInstance()->session('temp_member_id', $temp_member->getRef());
                Model::commit();
                return $this->redirectTo(AppService::RegisterStep2);
            }catch (\Exception $ex){
                Model::rollBack();
                $this->flashError('Error in initiating registration process. Please try again after sometime');
                return $this->back();
            }
        }

        $this->addScript('app/js/register.js');

        return $this->renderPartial('register', ['member' => $temp_member]);
    }

    public function RegisterStep2Action(){
        //get info from session and db
        if($id_ref = Utility::getInstance()->session('temp_member_id')){
            $temp_member = TempMember::getFromRef($id_ref);
        }else{
            return $this->redirectTo(AppService::Register);
        }

        if($this->request->isMethod('post')){
            try{
                Model::beginTransaction();
                $numberOfAccounts = $temp_member->getNumberOfAccounts();
                $registrationPins = explode(',', $this->request->get('pins'));

                if(count($registrationPins) != $numberOfAccounts){
                    $this->flashError("You must enter $numberOfAccounts PINs separated with comma to register $numberOfAccounts accounts");
                    return $this->back();
                }

                $registrationPin = $registrationPins[0];

                $email = $temp_member->getEmail();
                $username = $temp_member->getUsername();
                $password = $temp_member->getPassword();

                $member = new Member();

                $member->setSponsorId($temp_member->getSponsorId());
                $member->setParentId($temp_member->getParentId());
                $member->setRegistrationPin($registrationPin);
                $member->setEmailAddress($temp_member->getEmail());
                $member->setUsername($temp_member->getUsername());

                $checked = $member->save();
                if(!$checked['success']){
                    Model::rollBack();
                    $this->flashError($checked['message']);
                    return $this->renderPartial('pay_with_pin', ['member' => $temp_member]);
                }

                Auth::createAccount(['username' => $member->getUsername(), 'email' => $email, 'password' => $password]);

                /**
                 * if registering multiple accounts,
                 * split the pins
                 * register the first
                 * use the first as parent and sponsor for the rest
                 */
                for($i = 1; $i < $numberOfAccounts; $i++){
                    $sub_member = new Member();

                    $sub_member->setSponsorId($member->getMembershipId());
                    $sub_member->setParentId($member->getMembershipId());
                    $sub_member->setRegistrationPin($registrationPins[$i]);
                    $sub_member->setEmailAddress($email);
                    $sub_member->setUsername($member->getUsername().$i);

                    $sub_member->save();
                    Auth::createAccount(['username' => $sub_member->getUsername(), 'email' => $email, 'password' => $password]);
                }

                Auth::login($member->getUsername(), $password);

                Model::commit();

                Utility::getInstance()->session('temp_member_id', false);

                return $this->redirectTo(AppService::ControlPanel);
            }catch (\Exception $e){
                Model::rollBack();
                Utility::slackDebug('Member not created', $e->getMessage());
                $this->flashError('Error in creating account. Please try again later');
            }
        }

        $view = $temp_member->getPaymentMethod() == '1'? 'pay_with_pin': 'pay_online';

        return $this->renderPartial($view, ['member' => $temp_member]);
    }

    public function AddAccountAction(){
        $member = new Member();

        if($this->request->isMethod('post')){
            try{
                Model::beginTransaction();
                $sponsorId = $this->request->get('sponsorId');
                $parentId = $this->request->get('parentId');
                $numberOfAccounts = $this->request->get('numberOfAccounts');
                $registrationPins = explode(',', $this->request->get('pin'));

                if(count($registrationPins) != $numberOfAccounts){
                    $this->flashError("You must enter $numberOfAccounts PINs separated with comma to register $numberOfAccounts accounts");
                    return $this->back();
                }

                $registrationPin = $registrationPins[0];

                $email = $this->request->get('email');
                $username = $this->request->get('username');
                $password = $this->request->get('password');
                $retype_password = $this->request->get('retype_password');


                $member->setSponsorId($sponsorId);
                $member->setParentId($parentId);
                $member->setRegistrationPin($registrationPin);
                $member->setEmailAddress($email);
                $member->setUsername($username);

                if($password !== $retype_password){
                    $this->flashError('The confirmation password is not the same is the selected password');
                    return $this->back();
                }

                $checked = $member->save();
                if(!$checked['success']){
                    Model::rollBack();
                    $this->flashError($checked['message']);
                    return $this->back();
                }

                Auth::createAccount(['username' => $member->getUsername(), 'email' => $email, 'password' => $password]);

                /**
                 * if registering multiple accounts,
                 * split the pins
                 * register the first
                 * use the first as parent and sponsor for the rest
                 */
                for($i = 1; $i < $numberOfAccounts; $i++){
                    $sub_member = new Member();

                    $sub_member->setSponsorId($sponsorId);
                    $sub_member->setParentId($parentId);
                    $sub_member->setRegistrationPin($registrationPins[$i]);
                    $sub_member->setEmailAddress($email);
                    $sub_member->setUsername($member->getUsername().$i);

                    $sub_member->save();
                    Auth::createAccount(['username' => $sub_member->getUsername(), 'email' => $email, 'password' => $password]);
                }


                Model::commit();
                $this->flashSuccess('Account(s) added');
                return $this->back();
            }catch (\Exception $e){
                Model::rollBack();
                Utility::slackDebugException('Member not created', $e);
                $this->flashError('Error in creating account. Please try again later');
            }

            return $this->back();
        }
        return $this->back();
    }

    public function LogoutAction(){
        Utility::getInstance()->unsetSession('current_user');
        $this->flashSuccess('You have been logged out of the system');
        return $this->redirectTo(AppService::Login);
    }

    public function ForgotPasswordAction(){
        return $this->renderPartial('forgot_password');
    }

    public function IndexAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $member = Utility::getInstance()->getCurrentMember();
        $bank_detail = $member->getBankDetail() == null? new BankDetail(): $member->getBankDetail();

        return $this->render('index', ['member' => $member, 'bank_detail'=>$bank_detail]);
    }

    public function UpdatePersonalInformationAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $member_date = $this->request->get('member');
        $member = $this->getCurrentMember();
        $member->setFirstname($member_date['firstname']);
        $member->setLastname($member_date['lastname']);
        $member->setDob($member_date['dob']);
        $member->setSex($member_date['sex']);
        $member->update();
        $this->flashSuccess('Update succeeded');
        return $this->back();
    }

    public function UpdateContactInformationAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $contact = $this->request->get('member');
        $member = $this->getCurrentMember();
        $member->setPhonenumber($contact['phonenumber']);
        $member->setCountry($contact['country']);
        $member->setState($contact['state']);
        $member->setCity($contact['city']);
        $member->setAddress($contact['address']);

        $member->update();
        $this->flashSuccess('Update succeeded');
        return $this->back();

    }

    public function UpdateNextOfKinAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $data = $this->request->get('member');

        $member = $this->getCurrentMember();

        $member->setNextofkinaddress($data['nextofkinaddress']);
        $member->setNameofkin($data['nameofkin']);
        $member->setKinrelationship($data['kinrelationship']);
        $member->setPhonenumberofkin($data['phonenumberofkin']);

        $member->update();
        $this->flashSuccess('Update succeeded');
        return $this->back();


    }

    public function UpdateBankDetailAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $data = $this->request->get('bank_detail');

        $bank_detail = $this->getCurrentMember()->getBankDetail();
        if(!$bank_detail) $bank_detail = new BankDetail();

        $bank_detail->setAccountName($data['accountName']);
        $bank_detail->setAccountNumber($data['accountNumber']);
        $bank_detail->setBankName($data['bankName']);
        $bank_detail->setBranchName($data['branchName']);
        $bank_detail->setMemberId($this->getCurrentMember()->getId());

        $bank_detail->save();

        $this->flashSuccess('Update succeeded');
        return $this->back();
    }

    public function ChangePasswordAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $data = $this->request->get('data');
        if($data['new_password'] !== $data['confirm_password']){
            $this->flashError('Password mismatch');
            return $this->back();
        }
        if(Auth::changePassword($this->getCurrentUser()->getUsername(), $data['old_password'], $data['new_password'])){
            $this->flashSuccess('Password changed');
        }else{
            $this->flashError('Invalid old password');
        }
        return $this->back();
    }

    public function ChangePinAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $this->flashError('we are still working of our mailing system. you will get a mail once we are done');
        return $this->back();


    }
}