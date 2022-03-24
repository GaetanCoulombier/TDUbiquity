<?php
namespace controllers;
 use models\Product;
 use models\Section;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    #[Route('_default', name: 'home')]
	public function index(){
        $sections = DAO::getAll(Section::class);
		$this->loadView("StoreController/index.html",compact('sections'));
	}

    #[Route('store/section/{idSection}', name: 'store.section')]
	public function section($idSection){
        $section = DAO::getById(Section::class, $idSection);
		$this->loadView('StoreController/section.html',compact('section'));
	}
}
