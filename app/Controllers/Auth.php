<?php

namespace App\Controllers;
use App\Libraries\Hash;
class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url','form']);
    }
    public function index()
    {
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function loginUser()
    {
              $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email already exists'
                    
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 5 characters long',
                    'max_length' => 'Password must not exceed 20 characters'
                ]
            ]
         
        ]);

        if(!$validation){
            return view('auth/login', [
                'validation' => $this->validator
            ]);
        }
        else
        {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            //check if user exists
            $userModel = new \App\Models\UserModel();
            $userinfo = $userModel->where('email', $email)->first();

            $checkPassword = Hash::check($password, $userinfo['password']);
            if(!$checkPassword)
            {
                session()->setFlashdata('fail', 'Password is incorrect');
                return redirect()->to('auth');
            }else
            {
                $userId = $userinfo['id'];

                session()->set('loggedUser', $userId);
                return redirect()->to('/Dashboard'); 
            }
        }
    }
   


    public function registerUser()
    {
        // $validation = $this->validate([
        //     'name' => 'required',
        //     'email' => 'required|valid_email|is_unique[users.email]',
        //     'password' => 'required|min_length[5]|max_length[20]',
        //     'passwordConf' => 'required|min_length[5]|max_length[20]|matches[password]'
        // ]);

        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name is required'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email already exists'
                    
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 5 characters long',
                    'max_length' => 'Password must not exceed 20 characters'
                ]
            ],
            'passwordConf' => [
                'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password is required',
                    'min_length' => 'Confirm Password must be at least 5 characters long',
                    'max_length' => 'Confirm Password must not exceed 20 characters',
                    'matches' => "Password and Confirm Password don't match"
                ]
            ]
        ]);

        if(!$validation){
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        //save user data 

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');    
        $passwordConf = $this->request->getPost('passwordConf');
        
        // $passwordConf = $this->request->getPost('passwordConf');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];

        //storing data
        $userModel = new \App\Models\UserModel();
        $query = $userModel->insert($data);
        if(!$query)
        {
            return redirect()->back()->with('fail', 'Something went wrong');
        }
        else{
           return redirect()->to('auth/register')->with('success','You have registered successfully');
                     }
    }
    
    //Upload user image
    public function uploadImage()
    {
        try{
                $loggedUserId = session()->get('loggedUser');
        $config['upload_path'] = getcwd().'/images';
        $imageName = $this->request->getFile('userImage')->getName();

        //if directory does not exist, create it
        if(!is_dir($config['upload_path']))
        {
            mkdir($config['upload_path'], 0777);
        }
        $img = $this->request->getFile('userImage');

        if(!$img->hasMoved() && $loggedUserId)
        {
            $img->move($config['upload_path'],$imageName);

            $data = [
              'avatar' => $imageName,
            ];
            $userModel = new \App\Models\UserModel(); 
            $userModel->update($loggedUserId, $data);

            return redirect()->to('dashboard/index')->with('notification', 'Image uploaded successfully');

        }else
        {
            return redirect()->to('dashboard/index')->with('notification', 'Image upload failed');


        }
        }
        catch(\Exception $e)
        {
          echo $e->getMessage();
        }
    
    }
    public function logout()
    {
        // session()->destroy();
        // return redirect()->to('auth');
        if(session()->has('loggedUser'))
        {
            session()->remove('loggedUser');
            // return redirect()->to('auth');
        }
               
            return redirect()->to('/auth?access=logout')->with('fail', 'You have logged out');
        
    }
}

