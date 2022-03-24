<?php
namespace controllers;
 use Ubiquity\attributes\items\router\Route;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    #[Route('_default', name: 'home')]
	public function index(){
		$this->loadView("StoreController/index.html");
	}
}
