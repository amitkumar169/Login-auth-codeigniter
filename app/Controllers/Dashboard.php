<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class Dashboard extends BaseController
{
    public function index()
    {   
        $userModel = new \App\Models\UserModel();
        $loggedUserId = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUserId);

        $data = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo
        ];
       return view('dashboard/index',$data);
    }
}
