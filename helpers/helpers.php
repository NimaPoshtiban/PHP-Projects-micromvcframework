<?php

function site_url(string $route):string{
  return $_ENV['HOST'] . $route;
}

function asset_url(string $route):string{
  return site_url("assets/" . $route);
}

function view(string $path):void
{
  $path = str_replace(".","/",$path);
  $view_full_path = BASE_PATH . "views/$path.php";
  include_once $view_full_path;
}