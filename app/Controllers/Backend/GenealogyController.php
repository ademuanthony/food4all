<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/17/2016
 * Time: 5:26 AM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Globals\AppService;
use Globals\Utility;
use Models\Member;
use Models\Tree;

class GenealogyController extends BackendBaseController
{

    private function genealogyview($member, $type = Tree::TYPE_GENEALOGY /*1 = genealogy, 2 = direct downline, 3 = all downline*/){
        /** @var Member $member */
        $this->addScript('org-chart/dist/js/jquery.orgchart.js');
        $this->addScript('org-chart/dist/js/dashboard.js');

        $this->addStyle('org-chart/dist/css/jquery.orgchart.css');
        $this->addStyle('org-chart/dist/css/dashboard.css');

        $downlines = $member->getDescendants($type);

        //dd($downlines);

        $tree = new Tree($member->getMembershipId(), $downlines, $member->getGenealogy(), $type);


        return $this->render('index', ['member' => $member, 'tree' => $tree, 'type' => $type, 'layout' => ['title' => 'Genealogy', 'currentMenu' => AppService::Genealogy]]);
    }

    public function IndexAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

       /* $three = from(array(1,2,3,4,6,8,9,4,3,2,4,5))->where(function($k){return $k > 3;});
        foreach ($three as $item) {
            echo "$item <br/>";
        }
        exit();*/

        $member = Utility::getInstance()->getCurrentMember();

        //$member = Member::getByUsername('food4all');

        /*$this->addScript('jorgchart/jquery.jOrgChart.js');
        $this->addScript('jorgchart/dashboard.js');
        $this->addStyle('jorgchart/css/jquery.jOrgChart.css');
        $this->addStyle('jorgchart/css/custom.css');*/

        return $this->genealogyview($member, Tree::TYPE_GENEALOGY);
    }

    public function SearchAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $membership_id = $this->request->get('membership_id');
        $current_member = $this->getCurrentMember();
        /** @var Member $member */
        $member = Member::findOneBy(['membership_id' => $membership_id]);
        $member = $member? $member: Member::findOneBy(['username' => $membership_id]);

        if(!$member){
            $this->flashError('Result not found');
            return $this->back();
        }

        if(!($member->getLeftIndex() > $current_member->getLeftIndex() && $member->getRightIndex() < $current_member->getRightIndex())){
            $this->flashError('You can only view your downline');
            return $this->back();
        }

        //return $this->render('index', ['member' => $member]);
        return $this->genealogyview($member);
    }

    public function DirectAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $member = Utility::getInstance()->getCurrentMember();

        return $this->genealogyview($member, Tree::TYPE_DIRECT_DOWNLINE);
    }

    public function TreeAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $member = Utility::getInstance()->getCurrentMember();

        return $this->genealogyview($member, Tree::TYPE_ALL_DOWNLINE);
    }

    public function ListAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $member = Utility::getInstance()->getCurrentMember();
        $downlines = $member->getDescendants(Tree::TYPE_ALL_DOWNLINE);

        $viewData = ['member' => $member, 'downlines' => $downlines, 'layout' => ['title' => 'All Down line', 'currentMenu' => AppService::Genealogy]];
        return $this->render('list', $viewData);
    }

}