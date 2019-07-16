<?php

namespace App\Controllers;

use App\Models\Task;

class PagesController extends Controller
{

	public function home()
	{

		return view('index');

	}

}