<?php

namespace App\Controllers;
use App\Models\M_homepage;

class Home extends BaseController
{

	function __construct()
    {
        $this->homepage = new M_homepage(); 
    }

	public function index()
	{

		$data = [
			'title' => 'BEBAS PUSTAKA',
			'homepage' => $this->homepage->getData(),
		];

		return view('mhs/v_home_page', $data);

	}
}
