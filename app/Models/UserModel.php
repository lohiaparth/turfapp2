<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'userdetails';
    protected $allowedFields = ['fullname','email','phonenumber','aadhar','password','cpassword'];
}
