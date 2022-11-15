<?php

namespace App\Controllers;

use App\Models\Ajaxstudent;
use CodeIgniter\CodeIgniter;

class Home extends BaseController
{
    public function index()
    {

        return view('ajaxstudent/index');
    }


    public function store()
    {
        $student = new Ajaxstudent();


        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'course' => $this->request->getPost('course'),

        ];
        $student->save($data);
        $data = ['status' => 'Student Inserted Successfuly'];
        return $this->response->setJSON($data);


    }

    public function fetch()
    {

        $students = new Ajaxstudent();
        $data['students'] = $students->findAll();
        return $this->response->setJSON($data);


    }

    public function view()
    {
        $students = new Ajaxstudent();
        $student_id = $this->request->getPost('stud_id');
        $data['students'] = $students->find($student_id);
        return $this->response->setJSON($data);


    }

    public function edit()
    {
        $students = new Ajaxstudent();
        $student_id = $this->request->getPost('stud_id');
        $data['students'] = $students->find($student_id);
        return $this->response->setJSON($data);

    }

    public function update()
    {
        $student = new Ajaxstudent();
        $student_id = $this->request->getPost('id');
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'course' => $this->request->getPost('course'),
        ];
        $student->update($student_id,$data);
        $message = ['status'=>'Update successfuly'];
        return $this->response->setJSON($message);
    }

    public function delete(){
        $student = new Ajaxstudent();
        $student_id = $this->request->getPost('stud_id');
        $student->delete($student_id);
        $message = ['status' => 'Başarıyla silindi'];
        return $this->response->setJSON($message);
    }
}