<?php
namespace controllers;
 use models\Product;
 use models\Section;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\UResponse;
 use Ubiquity\utils\http\USession;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    public function initialize()
    {
        $total = USession::get('total')??0;
        $price = USession::get('price')??0;
        $this->view->setVar('price',$price);
        $this->view->setVar('total',$total);
        parent::initialize();
    }

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

    #[Route('store/add/{idProduct}/{count}', name: 'store.add')]
	public function addToCart($idProduct, $count){
        USession::start();
        $produit = DAO::getById(Product::class, $idProduct);

        $nbProd = 0;
        if(USession::get($idProduct) != null){
            $nbProd = USession::get($idProduct) + $count;
        }else{
            $nbProd = $count;
        }
        USession::set($idProduct, $nbProd);

        $price = 0;
        if(USession::get("price") != null){
            $price = USession::get("price") + $produit->getPrice() * $count;
        }else{
            $price = $produit->getPrice() * $count;
        }
        USession::set("price", $price);

        $total = 0;
        if(USession::get("total") != null){
            $total = USession::get("total") + $count;
        }else{
            $total = $count;
        }
        USession::set("total", $total);

        UResponse::header('Location', '/');
	}

    #[Route('store/all/', name: 'store.all')]
	public function allProducts(){
        $products = DAO::getAll(Product::class);
		$this->loadView('StoreController/allProducts.html',compact('products'));
	}

}
