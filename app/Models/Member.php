<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 9/20/2016
 * Time: 10:27 PM
 */

namespace Models;


use Doctrine\DBAL\Exception\NonUniqueFieldNameException;
use Framework\Base\Model;
use Framework\TinyMvc;
use Globals\AppConstants;
use Globals\AppService;
use Models\Status;
use Globals\Utility;
use Helpers\StringMethods;
use Zebra_Mptt_master\Zebra_Mptt;

class Member extends Model
{
    public function __construct()
    {
        $this->profile_image = '';
    }

    protected $membership_id;

    protected $username;

    protected $parent_id;

    protected $sponsor_id;

    protected $level;

    protected $left_index;

    protected $right_index;

    protected $registration_pin;

    protected $stage;

    protected $firstname;

    protected $lastname;

    protected $profile_image;

    protected $phonenumber;

    protected $email_address;

    protected $sex;

    protected $dob;

    protected $country;

    protected $state;

    protected $city;

    protected $address;

    protected $nameofkin;

    protected $nextofkinaddress;

    protected $kinrelationship;

    protected $phonenumberofkin;

    protected $status;

    protected $transaction_password;

    public function setTransactionPassword($transaction_password)
    {
        $this->transaction_password = $transaction_password;
        return $this;
    }

    public function getTransactionPassword()
    {
        return $this->transaction_password;
    }


    public function setMembershipId($membership_id = null){
        if($membership_id === null && empty($this->membership_id)){
            $membership_id = StringMethods::GetRandomString(10);
            $member = self::getByMembershipId($membership_id);
            while($member !== null){
                $membership_id = StringMethods::GetRandomString(10);
            }
        }
        $this->membership_id = $membership_id;
        return $this;
    }

    public function getMembershipId(){
        return $this->membership_id;
    }

    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setParentId($parent_id){
        $this->parent_id = $parent_id;
        return $this;
    }

    public function getParentId(){
        return $this->parent_id;
    }

    public function setSponsorId($sponsor_id){
        $this->sponsor_id= $sponsor_id;
        return $this;
    }

    public function getSponsorId(){
        return $this->sponsor_id;
    }

    public function setProfileImage($profile_image)
    {
        $this->profile_image = $profile_image;
        return $this;
    }

    public function getProfileImage()
    {
        return $this->profile_image;
    }

    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    public function setLeftIndex($left_index)
    {
        $this->left_index = $left_index;
        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLeftIndex()
    {
        return $this->left_index;
    }

    public function setRightIndex($right_index)
    {
        $this->right_index = $right_index;
        return $this;
    }

    public function getRightIndex()
    {
        return $this->right_index;
    }

    public function getNextofkinaddress()
    {
        return $this->nextofkinaddress;
    }

    public function getLevel(){
        return $this->level;
    }

    public function setRegistrationPin($pin){
        $this->registration_pin = $pin;
        return $this;
    }

    public function getRegistrationPin(){
        return $this->registration_pin;
    }

    public function setStage($stage){
        $this->stage = $stage;
        return $this;
    }

    public function getStage(){
        return $this->stage;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
        return $this;
    }

    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @param $email_address
     * @return Member $this
     */
    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setNameofkin($nameofkin)
    {
        $this->nameofkin = $nameofkin;
        return $this;
    }

    public function getNameofkin()
    {
        return $this->nameofkin;
    }

    public function setNextofkinaddress($nextofkinaddress)
    {
        $this->nextofkinaddress = $nextofkinaddress;
        return $this;
    }

    public function setKinrelationship($kinrelationship)
    {
        $this->kinrelationship = $kinrelationship;
        return $this;
    }

    public function getKinrelationship()
    {
        return $this->kinrelationship;
    }

    public function setPhonenumberofkin($phonenumberofkin)
    {
        $this->phonenumberofkin = $phonenumberofkin;
        return $this;
    }

    public function getPhonenumberofkin()
    {
        return $this->phonenumberofkin;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getFullname(){
        return $this->getFirstname().' '.$this->getLastname();
    }

    public function __toString()
    {
        return $this->getFullname().'('.$this->getMembershipId().')';
    }

    private $parent = null;
    /**
     * @return Member|null
     */
    public function getParent(){
        if(!$this->getParentId()) return null;
        if($this->parent == null){
            $this->parent = self::getByMembershipId($this->getParentId());
        }
        return $this->parent;
    }

    private $sponsor = null;
    /**
     * @return Member|null
     */
    public function getSponsor(){
        if(!$this->getSponsorId()) return null;
        if($this->sponsor == null){
            $this->sponsor = self::getByMembershipId($this->getSponsorId());
        }
        return $this->sponsor;
    }

    private $bank_detail = null;
    /**
     * @return BankDetail|null
     */
    public function getBankDetail(){
        if($this->bank_detail == null){
            $this->bank_detail = BankDetail::findOneBy(['member_id' => $this->getId()]);
        }
        return $this->bank_detail;
    }

    //traverse the network binary tree to fetch the next available upline to place the user under
    /**
     * @param string $upline
     * @return Member|bool
     */
    public static function getNextFreeUpline($upline = '')
    {
        if(empty($upline)) $upline = TinyMvc::$config['base_upline'];
        /** @var Member $member */
        $member  = self::findOneBy(['membership_id' => $upline]);
        if(!$member) return false;

        $left = $member->getLeftIndex();
        $right = $member->getRightIndex();

        $sql = "SELECT m.membership_id, count(md.parent_id) AS downlines, m.username, m.left_index, m.`level` FROM members m
                LEFT JOIN members md ON  m.membership_id = md.parent_id
                GROUP BY m.membership_id, m.username
                HAVING (m.left_index BETWEEN $left AND $right) AND downlines < 2 ORDER BY m.`level`, m.`left_index` limit 0,1;";

        $result = \R::getAll($sql);
        if(count($result) < 1) return false;
        return self::findOneBy(['membership_id' => $result[0]['membership_id']]);
    }

    public function getDirectDownlines(){
        return self::findAll(['parent_id' => $this->getMembershipId()]);
    }

    public function getReferralCount(){
        $sql = "SELECT COUNT(*) as no FROM members WHERE sponsor_id = '". $this->getMembershipId()."'";
        $result = \R::getAll($sql);
        return $result[0]['no'];
    }

    public function addSponsorsReferralEarning(){
        $sponsor = self::getByMembershipId($this->getSponsorId());
        $referralsCount = $sponsor->getReferralCount();
        $earning = new Earning();
        $earning->setMemberId($this->getSponsorId());
        $earning->setAmount(TinyMvc::$config['referral_earning']);
        $earning->setFoodPercentage($referralsCount > 1?30:100);
        $earning->setCashPercentage($referralsCount > 1?70:0);
        $earning->setEvent(AppService::EARNING_EVENT_REFERRAL);
        $earning->setNarration('registration');
        $earning->setRef($this->getMembershipId());
        $earning->setStatus(\Models\Status::Active);

        $earning->setDate(date('Y-m-d H:i:s'));
        return $earning->save();
    }

    protected function updateStageAndLevel(){
        $genealogy = $this->getGenealogy();
        if($this->haveCompletedStage($genealogy->getStage())){

            //get the next stage
            /** @var MatrixStage $stage */
            $stage = MatrixStage::find($genealogy->getStageId() + 1);
            $genealogy->setStageId($stage->getId());
            $genealogy->setLevelId($stage->getFirstLevel()->getId());

            //add member to the stage
            $this->addToStage($stage->getId());


            //give stage bonus
            $completed_stage = $genealogy->getStage();
            if($completed_stage->getPrize() > 0){
                $earning = new Earning();
                $earning->setMemberId($this->getMembershipId());
                $earning->setAmount($completed_stage->getPrize());
                $earning->setDate(date('Y-m-d H:is'));
                $earning->setCashPercentage(70);
                $earning->setFoodPercentage(30);
                $earning->setStatus(Status::Active);
                $earning->setEvent($completed_stage->getLabel(). ' completed');
                $earning->setNarration($completed_stage->getLabel() . ' bonus');
                $earning->setRef($completed_stage->getId());
                $earning->save();

                if($completed_stage->getMatchingBonusPercentage() > 0){

                    $earning = new Earning();
                    $earning->setMemberId($this->getSponsorId());
                    $earning->setAmount($completed_stage->getPrize() * $completed_stage->getMatchingBonusPercentage()/100);
                    $earning->setDate(date('Y-m-d H:is'));
                    $earning->setCashPercentage(70);
                    $earning->setFoodPercentage(30);
                    $earning->setStatus(Status::Active);
                    $earning->setEvent($this->getUsername().' '. $completed_stage->getLabel(). ' completed');
                    $earning->setNarration($this->getUsername().' '.$completed_stage->getLabel() . ' matching bonus');
                    $earning->setStageOfAvailability($completed_stage->getId());
                    $earning->setRef($completed_stage->getId());
                    $earning->save();
                }
            }
        }elseif($this->haveCompletedLevel($genealogy->getLevel())){
            $genealogy->setLevelId($genealogy->getLevelId()+1);
            //give level bonus
            $completed_level = $genealogy->getLevel();
            if($completed_level->getPrize() > 0){
                $earning = new Earning();
                $earning->setMemberId($this->getMembershipId());
                $earning->setAmount($completed_level->getPrize());
                $earning->setDate(date('Y-m-d H:is'));
                $earning->setCashPercentage(70);
                $earning->setFoodPercentage(30);
                $earning->setStatus(Status::Active);
                $earning->setEvent($completed_level->getLabel(). ' completed');
                $earning->setNarration($completed_level->getLabel() . ' bonus');
                $earning->setRef($completed_level->getId());
                $earning->save();

                if($completed_level->getMatchingBonusPercentage() > 0){

                    $earning = new Earning();
                    $earning->setMemberId($this->getSponsorId());
                    $earning->setAmount($completed_level->getPrize() * $completed_level->getMatchingBonusPercentage()/100);
                    $earning->setDate(date('Y-m-d H:is'));
                    $earning->setCashPercentage(70);
                    $earning->setFoodPercentage(30);
                    $earning->setStatus(Status::Active);
                    $earning->setEvent($this->getUsername().' '. $completed_level->getLabel(). ' completed');
                    $earning->setNarration($this->getUsername().' '.$completed_level->getLabel() . ' matching bonus');
                    $earning->setStageOfAvailability($completed_level->getId());
                    $earning->setRef($completed_level->getId());
                    $earning->save();
                }
            }
        }

        $genealogy->update();
    }

    protected function updateAncestorsLevel(){
        $ancestors = $this->getAncestors();

        foreach ($ancestors as $ancestor) {
            /** @var $ancestor Member */
            $ancestor->updateStageAndLevel();
        }
    }

    public function save()
    {
        if($this->getId() > 0){
            return $this->update();
        }
        //pin check
        /** @var RegistrationPin $card */
        $card = RegistrationPin::findOneBy(['pin' => $this->getRegistrationPin()]);

        if(!$card){
            return ['message' => 'Invalid registration PIN', 'success' => false];
        }
        if($card->getStatus() != Status::Active){
            return ['message' => 'This pin has been used', 'success' => false];
        }

        $sponsor = $this->getSponsor();
        if(!empty($sponsorId) && !$sponsor){
            return ['message' => 'The sponsor Id does not exist', 'success' => false];
        }

        //if no parent is specified, make sponsor the parent
        if(empty($this->getParentId())) $this->setParentId($this->getSponsorId());

        /** @var Member $parent */
        $parent = $this->getParent();
        if(!empty($parentId) && !$parent){
            return ['message' => 'The parent Id does not exist', 'success' => false];
        }

        $parent = $this->getNextFreeUpline($this->getParentId());

        $this->setStatus(Status::Active);
        //set parent id
        $this->setParentId($parent->getMembershipId());
        $this->parent = $parent;//rest the private parent in case of changes;
        //set sponsor
        if(empty($this->getSponsorId())){
            $this->setSponsorId(TinyMvc::$config['base_upline']);
        }

        $this->setLevel($parent->getLevel() + 1);

        $directDownline = count($parent->getDirectDownlines());
        $this->setLeftIndex($parent->getLeftIndex() + ($directDownline == 0? 1:3));
        $this->setRightIndex($this->getLeftIndex()+1);

        $this->setStage(1);



        if(Auth::findUserByLogin($this->getUsername())){
            return ['message' => 'The selected username is already in use', 'success' => false];
        }


        $this->setMembershipId();


        //update position for subsiquent
        $sql = "UPDATE members set left_index = left_index + 2, right_index = right_index + 2 WHERE left_index >= $this->left_index;";

        $sql .= " UPDATE members SET right_index = right_index + 2
       WHERE left_index < ".$parent->getLeftIndex()." and right_index > ".$parent->getRightIndex().";";

        $sql.= "UPDATE members SET right_index = ". ($parent->getRightIndex()+2) ." WHERE id = ". $parent->getId() .";";

        self::executeSql($sql);

        $checked = parent::save();
        if(!$checked){
            return ['message' => 'Error in creating account. Please try again later', 'success' => false];
        }

        $this->addToStage(AppConstants::STAGE_ONE);

        //add genealogy
        $genealogy = new Genealogy();
        $genealogy->setLevelId(AppConstants::STAGE_ONE_LEVEL_ONE);
        $genealogy->setMembershipId($this->getMembershipId());
        $genealogy->setStageId(AppConstants::STAGE_ONE);
        $genealogy->save();


        $checked = $this->addSponsorsReferralEarning();

        //if the member is filling the second leg then update parent
        if(count($parent->getDirectDownlines()) == 2){
            $this->updateAncestorsLevel();
        }


        if($checked === false){
            Utility::slackDebug('Member not added', 'unable to create sponsors earning');
            return ['message' => 'Error in adding member', 'success' => false];
        }

        //use the card
        $card->setStatus(Status::Pin_Used);
        $card->update();
        $usedCard = new UsedPin();
        $usedCard ->setPinId($card->getId());
        $usedCard->setMemberId($this->getMembershipId());
        $usedCard->setDate(date('Y-m-d H:i:s'));
        $usedCard->save();
        return ['message' => 'Member added', 'success' => true];
    }

    /**
     * @param $stage_id
     * @return StageMember
     */
    public function addToStage($stage_id){
        if(StageMember::findOneBy(['stage_id' => $stage_id, 'membership_id' => $this->getMembershipId()])){
            return false;
        }
        $stage_member = new StageMember();
        $stage_member->setStageId($stage_id);
        $stage_member->setFistname($this->getFirstname());
        $stage_member->setBlock($this->getLevel());
        $stage_member->setLastname($this->getLastname());
        $stage_member->setLeftIndex($this->getLeftIndex());
        $stage_member->setMembershipId($this->getMembershipId());
        $stage_member->setParentId($this->getParentId());
        $stage_member->setRightIndex($this->getRightIndex());
        $stage_member->setUsername($this->getUsername());

        $stage_member->save();

        $this->setState($stage_id);
        $this->save();

        return $stage_member;
    }

    protected $descendants = [Tree::TYPE_ALL_DOWNLINE => [], Tree::TYPE_DIRECT_DOWNLINE => [], Tree::TYPE_GENEALOGY => []];

    protected function loadDescendants($tree_type = Tree::TYPE_GENEALOGY){
        // now, retrieve all descendants of the $root node

        switch($tree_type){
            case Tree::TYPE_GENEALOGY:
                $sql = 'SELECT members.membership_id, members.parent_id, members.left_index, members.right_index, members.username, members.`level`, genealogies.stage_id FROM members '.
                    ' INNER JOIN genealogies ON genealogies.membership_id = members.membership_id WHERE left_index BETWEEN '.$this->getLeftIndex().' AND '. $this->getRightIndex().' AND members.stage = '.$this->getStage().' ORDER BY left_index ASC;';
                break;
            case Tree::TYPE_DIRECT_DOWNLINE:
                $sql = "SELECT members.membership_id, members.parent_id, members.left_index, members.right_index, members.username, members.`level`, genealogies.stage_id FROM members
                        INNER JOIN genealogies ON genealogies.membership_id = members.membership_id
                        WHERE (left_index = $this->left_index + 1 OR right_index = $this->right_index - 1)
                        OR members.id = $this->id ORDER BY left_index ASC;";
                break;
            case Tree::TYPE_ALL_DOWNLINE:
                $sql = "SELECT members.membership_id, members.parent_id, members.left_index, members.right_index, members.username, members.`level`, CONCAT(members.firstname, ' ', members.lastname) AS fullname, genealogies.stage_id FROM members INNER JOIN genealogies ON genealogies.membership_id = members.membership_id WHERE left_index BETWEEN $this->left_index AND $this->right_index ORDER BY left_index ASC;";
                break;
            default:
                return [];
        }

        //sql
        //die($sql);

        $result = \R::getAll($sql);

        $this->descendants[$tree_type] = $result;
    }

    public function getDescendants($tree_type = Tree::TYPE_GENEALOGY){
        //return StageMember::getDownlines($this, $this->getGenealogy()->getStage());

        if(count($this->descendants[$tree_type]) == 0)
            $this->loadDescendants($tree_type);
        return $this->descendants[$tree_type];
    }

    /**
     * @return array
     */
    public function getAncestors(){
        $sql = "SELECT * FROM members WHERE left_index < $this->left_index AND right_index > $this->right_index ORDER BY left_index ASC;";
        $result = \R::getAll($sql);
        $members = [];

        foreach ($result as $item) {
            $member = new Member();
            $member->init($item);
            $members[] = $member;
        }
        return $members;
    }

    /**
     * @return array
     */
    public function getFeederBoardMembers(){
        $sql = "SELECT * FROM members WHERE (left_index BETWEEN $this->left_index AND $this->right_index) AND (`level` BETWEEN $this->level+ 1 AND $this->level+2)";
        $result = \R::getAll($sql);
        $members = [];

        foreach ($result as $item) {
            $member = new Member();
            $member->init($item);
            $members[] = $member;
        }
        return $members;
    }

    public function haveCompletedStage(MatrixStage $stage){

        return StageMember::haveCompletedStage($this, $stage);

        return $this->blockIsFilled($stage->getBlock(), $stage->getCompleteLineUp());

        $block = $stage->getBlock();
        switch($block){
            case AppConstants::STAGE_ONE:
                return $this->blockIsFilled(2, 4);
            case AppConstants::STAGE_TWO:
                return $this->blockIsFilled(4, 16);
            case AppConstants::STAGE_THREE:
                return $this->blockIsFilled(6, 64);
            case AppConstants::STAGE_FOUR:
                return $this->blockIsFilled(8, 265);
            case AppConstants::STAGE_FIVE:
                return $this->blockIsFilled(10, 1024);
        }
    }

    public function haveCompletedLevel(MatrixLevel $level){
        $result = $this->blockIsFilled($level->getBlock(), $level->getCompleteLineUp());

        return $result;
    }

    public function blockIsFilled($block, $expected_count){
        $sql = "SELECT COUNT(id) AS no FROM members WHERE (left_index BETWEEN $this->left_index AND
                $this->right_index) AND (`level` = $this->level + $block)";

        $result = \R::getAll($sql);
        return $result[0]['no'] == $expected_count;
    }

    private $genealogy = null;

    /**
     * @return Genealogy|null
     */
    public function getGenealogy(){
        if($this->genealogy == null){
            $this->genealogy =  Genealogy::findOneBy(['membership_id' => $this->getMembershipId()]);
        }
        return $this->genealogy;
    }

    public function validateTransactionPin($pin){
        return $pin == $this->getTransactionPassword();
    }

    public function withdraw($amount, $type, $ref){
        try{
            $withdrawal = new Withdrawal();
            $withdrawal->setDate(date('Y-m-d H:i:s'));
            $withdrawal->setMemberId($this->getMembershipId());
            $withdrawal->setAmount($amount);
            $withdrawal->setType($type);
            $withdrawal->setRef($ref);
            $withdrawal->save();
            return $withdrawal;
        }catch (\Exception $ex){
            Utility::slackDebug('Error in withdrawal', $ex->getMessage());
            return false;
        }
    }

    private $total = null;
    public function getTotalEarning(){
        if($this->total == null){
            $sql = "SELECT SUM(amount) AS amount from earnings WHERE member_id = '".$this->getMembershipId()."'";
            $result = \R::getAll($sql);//  Model::executeSql($sql);
            $this->total = $result[0]['amount']? $result[0]['amount'] :0;
        }
        return $this->total + $this->getCashReceived();
    }

    private $withdrawal = null;
    public function getTotalWithdrawal(){
        if($this->withdrawal == null){
            $sql = "SELECT SUM(amount) AS amount from withdrawals WHERE member_id = '".$this->getMembershipId()."'";
            //$this->withdrawal = Model::executeSql($sql);
            $result = \R::getAll($sql);//  Model::executeSql($sql);
            $this->withdrawal = $result[0]['amount'] ? $result[0]['amount'] : 0;
        }
        return $this->withdrawal + $this->getCashTransferred();
    }


    private $cash_withdrawal = null;
    public function getCashWithdrawal(){
        if($this->cash_withdrawal == null){
            $sql = "SELECT SUM(amount) as amount FROM withdrawals WHERE member_id = '".$this->getMembershipId()."' AND type = 'cash'";
            $result = \R::getAll($sql);
            $this->cash_withdrawal = $result[0]['amount']? $result[0]['amount']:0;
        }
        return $this->cash_withdrawal;
    }

    private $cash_total = null;
    public function getCashTotalEarning(){
        if($this->cash_total == null){
            $sql = "SELECT SUM(amount * cash_percentage/100) AS amount from earnings WHERE member_id = '".$this->getMembershipId()."'";
            $result = \R::getAll($sql);//  Model::executeSql($sql);
            $this->cash_total = $result[0]['amount']? $result[0]['amount'] :0;
        }
        return $this->cash_total;
    }

    private $food_withdrawal = null;
    public function getFoodWithdrawal()
    {
        if($this->food_withdrawal == null){
            $sql = "SELECT SUM(amount) as amount FROM withdrawals WHERE member_id = '".$this->getMembershipId()."' AND type = 'food'";
            $result = \R::getAll($sql);
            $this->food_withdrawal = $result[0]['amount']? $result[0]['amount']:0;
        }
        return $this->food_withdrawal;
    }

    private $food_total = null;
    public function getFoodTotalEarning(){
        if($this->food_total == null){
            $sql = "SELECT SUM(amount * food_percentage/100) AS amount from earnings WHERE member_id = '".$this->getMembershipId()."'";
            $result = \R::getAll($sql);//  Model::executeSql($sql);
            $this->food_total = $result[0]['amount']? $result[0]['amount'] :0;
        }
        return $this->food_total;
    }

    private $cash_transferred = null;
    public function getCashTransferred(){
        if($this->cash_transferred == null){
            $sql = "SELECT SUM(amount) as amount FROM transfers WHERE sender_id = '".$this->getMembershipId()."'";
            $result = \R::getAll($sql);//  Model::executeSql($sql);
            $this->cash_transferred = $result[0]['amount']? $result[0]['amount'] :0;
        }
        return $this->cash_transferred;
    }

    private $cash_received = null;
    public function getCashReceived(){
        if($this->cash_received == null){
            $sql = "SELECT SUM(amount) as amount FROM transfers WHERE receiver_id = '".$this->getMembershipId()."'";
            $result = \R::getAll($sql);//  Model::executeSql($sql);
            $this->cash_received = $result[0]['amount']? $result[0]['amount'] :0;
        }
        return $this->cash_received;
    }


    public function getBalance(){
        return ($this->getTotalEarning()) - ($this->getTotalWithdrawal());
    }

    public function getFoodBalance(){
        return $this->getFoodTotalEarning() - $this->getFoodWithdrawal();
    }

    public function getCashBalance(){
        return ($this->getCashTotalEarning() + $this->getCashReceived()) - ($this->getCashWithdrawal() + $this->getCashTransferred());
    }

    function displayTree() {

        $result = $this->getDescendants();


        $tree = new Tree($this->getMembershipId(), $result, $this->getGenealogy());
        $tree->display();

    }

    /**
     * @param $membershipId
     * @return Member|null
     */
    public static function getByMembershipId($membershipId){
        return self::findOneBy(['membership_id' => $membershipId]);
    }

    /**
     * @param $username
     * @return Member|null
     */
    public static function getByUsername($username){
        return self::findOneBy(['username' => $username]);
    }



}
