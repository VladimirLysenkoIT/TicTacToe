<?php
session_start();

$game = isset($_SESSION["game"])? $_SESSION["game"]: null;
if(!$game || !is_object($game)) {
    $game = new XO();
}

$params = $_GET + $_POST;
if(isset($params["action"])) {
    $action = $params["action"];
    
    if($action == "step") {
        $game->doStep((int)$params["x"], (int)$params["y"]);
        
    } else if($action == "newGame") {
        $game = new XO();
    }
}
$_SESSION["game"] = $game;

