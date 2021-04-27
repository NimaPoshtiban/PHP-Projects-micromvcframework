<?php
use \App\Core\Routing\Route;

Route::get('/',function(){
  echo "welcome";
});

Route::post('/saveform',function(){
  echo "save ok";
});
