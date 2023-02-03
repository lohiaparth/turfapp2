<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Register extends Controller
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }
 
    public function save()
    {
        
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'username'      => 'required|min_length[3]|max_length[20]',
            'emailAddress'  => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'phone'         => 'required|numeric|min_length[10]|max_length[10]',
            'aadhar'        => 'required|numeric|min_length[12]|max_length[12]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'passwordCon'   => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'fullname'     => $this->request->getVar('username'),
                'email'    => $this->request->getVar('emailAddress'),
                'phonenumber'    => $this->request->getVar('phone'),
                'aadhar'    => $this->request->getVar('aadhar'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'cpassword' => $this->request->getVar('passwordCon')
            ];
            $model->save($data);
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
         
    }
 
}