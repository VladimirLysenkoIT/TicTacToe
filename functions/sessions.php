<?php
session_start();

$game = isset($_SESSION["game"])? $_SESSION["game"]: null;
if(!$game || !is_object($game)) {
    $game = new TicTacToe();
}

$params = $_GET + $_POST;
if(isset($params["action"])) {
    $action = $params["action"];
    
    if($action == "step") {
        $game->move((int)$params["x"], (int)$params["y"]);
        
    } else if($action == "newGame") {
        $game = new TicTacToe();
    }
}
$_SESSION["game"] = $game;