<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 5:58 PM
 */

namespace Framework\Base;


use Doctrine\ORM\EntityManager;
use Framework\Languages\Inflect;
use Framework\Pagination\PageInfo;
use Framework\TinyMvc;
use \R;
use RedBeanPHP\OODBBean;

class Model
{
    protected $id;

    public function getId(){
        return $this->id;
    }

    protected function setId($id){
        $this->id = $id;
        return $this;
    }

    public function init(array $data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData(){
        return get_object_vars($this);
    }

    public static function executeSql($sql, array $bindings = []){
        return R::exec($sql, $bindings);
    }

    public static function beginTransaction(){
        R::begin();
        //self::getDb()->getConnection()->beginTransaction();
    }

    public static function commit(){
        R::commit();
        //self::flush();
        //self::getDb()->getConnection()->commit();
    }

    public static function rollBack(){
        R::rollback();
        //self::getDb()->getConnection()->rollBack();
    }

    public static function persist($object){
        R::store($object);
        //self::getDb()->persist($object);
    }

    public static function flush(){
        self::commit();
        //self::getDb()->flush();
    }

    protected function getTablePrefix(){
        return '';
    }

    protected function getTableName(){
        $list = explode('\\', get_called_class());
        $table = (new static())->getTablePrefix(). strtolower($list[count($list) - 1]);

        return Inflect::pluralize($table);
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    protected function loadBean(){
        return $this->getId() > 0? R::load($this->getTableName(), $this->getId()): R::dispense($this->getTableName());
    }

    public function save(){
        $fields = R::inspect($this->getTableName());

        $bean = $this->loadBean();

        foreach ($fields as $field => $value) {
            if($field == 'id') continue;
            $bean->{$field} = $this->{$field};
        }
        $this->id = R::store($bean);

        //self::getDb()->persist($this);
        //self::getDb()->flush();
        return $this;
    }

    public function update(){
        $fields = R::inspect((new static())->getTableName());
        $bean = $this->loadBean();

        foreach ($fields as $field => $value) {
            if($field == 'id') continue;
            $bean->{$field} = $this->{$field};
        }

        R::store($bean);

        return $this;
    }

    public function delete(){
        R::trash($this->loadBean());

        //self::getDb()->remove($this);
        //self::getDb()->flush();
        //return $this;
    }



    public static function getClassName() {
        return get_called_class();
    }

    /** @return  EntityManager */
    public static function getDb(){
        return TinyMvc::$config['db'];
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public static function getRepository(){
        $repository = self::getDb()->getRepository(self::getClassName());
        return $repository;
    }

    /**
     * @param $sql
     * @param array $bindings
     * @return int
     */
    public static function runSql($sql, array $bindings = []){
        if(count($bindings) > 0){
            return R::exec($sql, $bindings);
        }else{
            return R::exec($sql);
        }
    }

    /**
     * @param OODBBean $bean
     * @return Model
     */
    protected static function getObjFromBean($bean){
        if(!$bean) return $bean;

        $data = [];
        $fields = R::inspect((new static())->getTableName());

        foreach ($fields as $field => $value) {
            $data[$field] = $bean->{$field};
        }

        /** @var Model $obj */
        $obj = new static();
        return $obj->init($data);
    }

    protected static function buildCondition($criteria, $glue = "AND"){
        $where = [];
        $bind = [];
        if(!array_key_exists('conditions', $criteria)){
            if(is_array($criteria)){
                foreach ($criteria as $key => $value) {
                    $where[] = $value == null? "$key IS NULL": "$key = ?";
                    if($value != null)
                        $bind[] = $value;
                }
                $where = implode(" $glue ", $where);
            }else{
                $where = $criteria;
            }
        }else{
            $where = $criteria['conditions'];
            $bind = $criteria['bind'];
        }
        return ['where' => $where, 'bind' => $bind];
    }
    /**
     * @param $id
     * @return null|Model
     */
    public static function find($id){
        $bean = R::load((new static())->getTableName(), $id);
        return self::getObjFromBean($bean);

        //return self::getRepository()->find($id);
    }

    /**
     * @param array|string $criteria
     * @return null|Model
     */
    public static function findOneBy($criteria){

        $condition = self::buildCondition($criteria);


        $bean = R::findOne((new static())->getTableName(), $condition['where'], $condition['bind']);

       return self::getObjFromBean($bean);

        //return self::getRepository()->findOneBy($criteria);
    }

    /**
     * @param array|string $filter_by
     */
    public static function count($filter_by){

        $condition = self::buildCondition($filter_by);

        $total_record = R::count((new static())->getTableName(), $condition['where'], $condition['bind']);
        return $total_record;
    }

    public static function getCount($parameters){
        $where = is_array($parameters)?$parameters[0]:$parameters;
        $bind = is_array($parameters) && array_key_exists('bind', $parameters)?$parameters['bind']:[];
        $total_record = R::count((new static())->getTableName(), $where, $bind);
        return $total_record;
    }

    /**
     * @return PageInfo|array
     */
    public static function findAll($filter_by = [],$offset = 0, $count = 0, $fetch_with = [], $order_by = 'id', $order_direction = 'DESC'){
        $condition = self::buildCondition($filter_by);
        $where = $condition['where'];

        //build join conditions
        $where .= " ORDER BY $order_by $order_direction";

        if($count > 0){
            $where .= " LIMIT $offset, $count";
        }


        $beans = R::findAll((new static())->getTableName(), $where, $condition['bind']);
        $objs = [];

        foreach ($beans as $bean) {
            $objs[] = self::getObjFromBean($bean);
        }



        $total_record = self::count($filter_by);


        return $count == 0? $objs: new PageInfo($objs, $count, $offset, $total_record);

        //return self::getRepository()->findAll();
    }

    /**
     * @param array|string $filter_by
     * @return array
     */
/*    public static function findBy($filter_by){

        $where = self::buildCriteria($filter_by);

        $beans = R::find(self::getTableName(), $where);
        $objs = [];

        foreach ($beans as $bean) {
            $objs[] = self::getObjFromBean($bean);
        }

        return $objs;

        //return self::getRepository()->findBy($criteria);
    }*/
}