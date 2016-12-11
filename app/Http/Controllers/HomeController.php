<?php

namespace Bgreenacre\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as View;

class HomeController extends Controller
{

	protected $view;

	public function __construct(View $view)
	{
		$this->view = $view;
	}

	public function index()
	{
		return $this->view->make('theme/pages/homepage');
	}

}
