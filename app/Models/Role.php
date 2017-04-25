<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/5/2016
 * Time: 6:57 AM
 */

namespace Models;


use Framework\Base\Model;

class Role extends Model
{
    const User = 1;
    const Admin = 2;


    protected $name;
    protected $permissions;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        return $this;
    }


}