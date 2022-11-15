<?php

namespace App\Entities;

use \CodeIgniter\Entity;

class UserEntitiy extends Entity
{
    protected $user_name;
    protected $user_email;
    protected $user_phone;
    protected $user_password;
    protected $user_profile_picture;
    protected $user_age;
    protected $user_status;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getUserName()
    {
        return $this->attributes['user_name'];
    }

    public function getEmail()
    {
        return $this->attributes['user_email'];

    }

    public function getPhone()
    {
        return $this->attributes['user_phone'];

    }

    public function getProfiePicture()
    {
        return $this->attributes['user_profile_picture'];

    }

    public function getAge()
    {
        return $this->attributes['user_age'];

    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];

    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];

    }

    public function getDeletedAt()
    {
        return $this->attributes['deleted_at'];

    }

    public function passwordControl($password)
    {
        if (password_verify($password, $this->attributes['user_password'])) {
            return true;
        }
        return false;
    }


    public function setName($name)
    {
        $this->attributes['user_name'] = $name;
    }

    public function setEmail($email)
    {
        $this->attributes['user_email'] = $email;
    }

    public function setPhone($phone)
    {
        $firstChar =  substr($phone, 0, 1);
        if ($firstChar == 0){
            $phone = '+9' . $phone;
        }
        $this->attributes['user_phone'] = $phone;
    }

    public function setProfieLink($ppLink)
    {
        $this->attributes['user_profile_picture'] = $ppLink;
    }

    public function setAge($age)
    {
        $this->attributes['user_age'] = $age;
    }

    public function setPassword($pws)
    {
        $this->attributes['user_password'] = password_hash($pws, PASSWORD_DEFAULT);
    }
}