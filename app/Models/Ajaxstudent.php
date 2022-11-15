<?php

namespace App\Models;

use CodeIgniter\Model;

class Ajaxstudent extends Model
{

    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'phone', 'course'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function insertData($name, $email, $phone, $course)
    {
        $sql = "INSERT INTO `students` ( `name`, `email`, `phone`, `course`) VALUES ('$name' , '$email' , '$phone' , '$course' )";
        $query = $this->db->query($sql);
        return $query;

    }

}