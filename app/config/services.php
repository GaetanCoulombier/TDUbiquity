<?php
use Ubiquity\controllers\Router;

\Ubiquity\cache\CacheManager::startProd($config);
\Ubiquity\orm\DAO::start();
Router::start();
//Router::addRoute("_default", "controllers\\StoreController");
\Ubiquity\assets\AssetsManager::start($config);
