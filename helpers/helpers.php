<?php

function site_url($route){
  return $_ENV['HOST'] . $route;
}

function asset_url($route){
  return site_url("assets/" . $route);
}
