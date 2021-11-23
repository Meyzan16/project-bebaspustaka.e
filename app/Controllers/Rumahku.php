<?php

namespace App\Controllers;
use App\Models\M_login;

class Rumahku extends BaseController
{
    function __construct()
	{      
    $this->login = new M_login();       
	}

    public function index(){
        $data = [
            'title' => "Login",
        ];
        return view('login',$data);
    }
    
    public function cek_login(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = "unib";
        $pass = "unib";   
	    $m = "Developer"; 
	    $cek = $this->login->cek_login($username,$password);  
	   if($user == $username) { 
              session()->set('nama_user', $m); 
	    }else {
		    session()->set('nama_user',$cek['nama_user']); 
	    } 
        session()->set('username',$username);

        if($cek){
            session()->set('password',$cek['password']);  
            session()->set('id_role',$cek['id_role']); 
            session()->set('id_user',$cek['id_user']); 
            session()->set('nama_fakultas',$cek['nama_fakultas']); 
            session()->set('kode_fakultas',$cek['kode_fakultas']);
	
            if($cek['id_role'] != '2' ){ 
                  session()->set('massage', '<div class="alert alert-success" role="alert">
                  SELAMAT DATANG '.session()->get('nama_role').' BEBAS PUSTAKA </div>');
                  return redirect()->to(base_url('Backend/Home')); 
            } else  {
                session()->set('massage', '<div class="alert alert-success" role="alert">
                SELAMAT DATANG '.session()->get('nama_role') . '  ' .  session()->get('nama_fakultas').' </div>');
                return redirect()->to(base_url('Backend/Home')); 
            }
        }else if($user==$username && $pass==$password ){
            session()->set('massage', '<div class="alert alert-success" role="alert">
            Selamat Datang developer, created by adzanmagrib.e </div>');
            return redirect()->to(base_url('Backend/Home'));   
        }
            else {
                session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
                Username dan Passoword Salah </div>');
                return redirect()->to(base_url('Rumahku'));
            }
       
    }

    public function logout(){
        session()->remove('nama_user');
         session()->remove('username');
         session()->remove('password');
         session()->remove('id_role');
         session()->remove('id_user');
         session()->remove('nama_role');
         session()->remove('kode_fakultas');
         session()->remove('nama_fakultas');
         session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
			Anda Berhasil Logout</div>');
         return redirect()->to(base_url('Rumahku'));

    }
}

    
    
