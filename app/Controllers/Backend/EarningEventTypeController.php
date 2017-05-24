<?php
/**
 * Created by PhpStorm.
 * User: ademu
 * Date: 5/23/17
 * Time: 7:36 PM
 */

namespace Controllers\Backend;


use Models\EventType;
use Models\MatrixStage;
use Models\Role;
use Globals\AppService;

class EarningEventTypeController extends BackendBaseController
{
    public function IndexAction()
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $page_info = EventType::findAll([], $off_set, $this->page_size);

        return $this->render('index', ['page_info' => $page_info,
            'layout' => ['title' => 'Earning Events', 'currentMenu' => AppService::RouteBackendEarningEventType]]);
    }

    private function newEventForm($eventType){
        $stages = MatrixStage::findAll();
        return $this->render("add", ['stages' => $stages, 'eventType' => $eventType,
            'layout' => ['title' => 'New Earning Events', 'currentMenu' => AppService::RouteBackendEarningEventType]]);
    }

    private function manageEventForm($eventType){
        $stages = MatrixStage::findAll();
        return $this->render("manage", ['stages' => $stages, 'eventType' => $eventType,
            'layout' => ['title' => 'Manage Earning Events', 'currentMenu' => AppService::RouteBackendEarningEventType]]);
    }

    public function AddAction(){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        if($this->request->getMethod() == 'POST'){
            $stage_id = $this->get('stage_id');
            $name = $this->get('name');
            $key = $this->get('key');
            $reward = $this->get('reward');
            $sponsors_reward = $this->get('sponsors_reward');
            $description = $this->get('description');
            $descendants_count = $this->get('descendants_count');
            $right_descendant_count = $this->get('right_descendant_count');
            $left_descendant_count = $this->get('left_descendant_count');
            $requires_balanced_descendant = $this->get('requires_balanced_descendant');
            $is_multiple = $this->get('is_multiple');
            $food_percentage = $this->get('food_percentage');
            $cash_percentage = $this->get('cash_percentage');


            $eventType = new EventType();
            $eventType->setName($name);
            $eventType->setKey($key);
            $eventType->setStageId($stage_id);
            $eventType->setReward($reward);
            $eventType->setSponsorsReward($sponsors_reward);
            $eventType->setDescendantsCount($descendants_count);
            $eventType->setDescription($description);
            $eventType->setFoodPercentage($food_percentage);
            $eventType->setCashPercentage($cash_percentage);

            //dd($eventType);

            if(in_array(null, [$stage_id, $name, $key, $reward, $description, $descendants_count, $food_percentage, $cash_percentage])){
                $this->flashError("Required fields not sent");
                return $this->newEventForm($eventType);
            }

            if (EventType::findOneBy(['`key`' => $key])){
                $this->flashError("An earning event with the same key already exists");
                return $this->newEventForm($eventType);
            }
            if (EventType::findOneBy(['name' => $name])){
                $this->flashError("An earning event with the same name already exists");
                return $this->newEventForm($eventType);
            }

            if ($eventType->save()){
                $this->flashSuccess("Earning event added");
                return $this->redirectTo(AppService::RouteBackendEarningEventType);
            }else{
                $this->flashError("Error in adding earning event");
                return $this->newEventForm($eventType);
            }
        }

        $eventType = new EventType();
        return $this->newEventForm($eventType);
    }


    public function ManageAction($id){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();

        /** @var EventType $eventType */
        $eventType = EventType::findOneBy(['id' => $id]);
        if($this->request->getMethod() == 'POST'){
            $stage_id = $this->get('stage_id');
            $name = $this->get('name');
            $key = $this->get('key');
            $reward = $this->get('reward');
            $sponsors_reward = $this->get('sponsors_reward');
            $description = $this->get('description');
            $descendants_count = $this->get('descendants_count');
            $right_descendant_count = $this->get('right_descendant_count');
            $left_descendant_count = $this->get('left_descendant_count');
            $requires_balanced_descendant = $this->get('requires_balanced_descendant');
            $is_multiple = $this->get('is_multiple');
            $food_percentage = $this->get('food_percentage');
            $cash_percentage = $this->get('cash_percentage');


            $eventType->setName($name);
            $eventType->setKey($key);
            $eventType->setStageId($stage_id);
            $eventType->setReward($reward);
            $eventType->setSponsorsReward($sponsors_reward);
            $eventType->setDescendantsCount($descendants_count);
            $eventType->setDescription($description);
            $eventType->setFoodPercentage($food_percentage);
            $eventType->setCashPercentage($cash_percentage);

            //dd($eventType);

            if(in_array(null, [$stage_id, $name, $key, $reward, $description, $descendants_count, $food_percentage, $cash_percentage])){
                $this->flashError("Required fields not sent");
                return $this->manageEventForm($eventType);
            }

            if (EventType::findOneBy(['`key`' => $key])){
                $this->flashError("An earning event with the same key already exists");
                return $this->manageEventForm($eventType);
            }
            if (EventType::findOneBy(['name' => $name])){
                $this->flashError("An earning event with the same name already exists");
                return $this->manageEventForm($eventType);
            }

            if ($eventType->save()){
                $this->flashSuccess("Earning event added");
                return $this->redirectTo(AppService::RouteBackendEarningEventType);
            }else{
                $this->flashError("Error in adding earning event");
                return $this->newEventForm($eventType);
            }
        }

        return $this->manageEventForm($eventType);
    }

}