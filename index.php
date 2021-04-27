<?php
# font controller

use App\Core\Routing\Route;
use App\Core\SimpleRouter;

include "bootstrap/init.php";

// $router = new SimpleRouter();
// $router->run();

Route::get('/',function(){
  echo "welcome";
});

Route::post('/saveform',function(){
  echo "save ok";
});

var_dump( Route::routes());


