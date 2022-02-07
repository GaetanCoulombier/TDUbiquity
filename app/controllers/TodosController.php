<?php

namespace controllers;

use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
 * Controller TodosController
 */
class TodosController extends \controllers\ControllerBase
{

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID = 'not saved';
    const LIST_SESSION_KEY = 'list';
    const ACTIVE_LIST_SESSION_KEY = 'active-list';

    protected $headerView = "@activeTheme/main/vHeader.html";
    protected $footerView = "@activeTheme/main/vFooter.html";

    public function initialize()
    {
        $this->loadView($this->headerView);
        $this->loadView($this->footerView);
    }

    #[Route('_default', name: 'todos.home')]
    public function index()
    {
        $list = USession::get(self::LIST_SESSION_KEY, []);
        $this->displayList($list);
    }

    #[Post(path: "add", name: 'todos.add')]
    public function addElement()
    {
        $list = USession::get(self::LIST_SESSION_KEY, []);

        $this->displayList($list);
        $this->loadView('TodosController/addElement.html');

        $newElement = URequest::post('elem');
        $list [] = $newElement;
        USession::set(self::LIST_SESSION_KEY, $list);
    }

    #[Get(path: "delete/{index}", name: 'todos.delete')]
    public function deleteElement($index)
    {

    }

    #[Post(path: "edit", name: 'todos.edit')]
    public function editElement($index)
    {

    }

    #[Get(path: "delete/{uniqid}", name: 'todos.loadList')]
    public function loadList($uniqid)
    {

    }

    #[Post(path: "loadListPost", name: 'todos.loadListPost')]
    public function loadListFromFrom()
    {

    }

    #[Get(path: "new/{force}", name: 'todos.new')]
    public function newList($force)
    {

    }

    #[Get(path: "save", name: 'todos.save')]
    public function saveList()
    {

    }

    private function displayList(mixed $list)
    {
        $this->loadView('TodosController/displayList.html', compact('list'));
    }
}
