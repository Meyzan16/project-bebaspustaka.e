<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\M_status_akhir;

class RestClient extends BaseController
{

	use ResponseTrait;

	function __construct()
    {
        $this->modal = new M_status_akhir(); 
    }

	public function index()
	{
		$data = $this->modal->findAll();
		return $this->respond($data);


	}
}
