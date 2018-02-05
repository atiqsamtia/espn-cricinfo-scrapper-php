<?php
/**
 * Created by Atiq.
 * Prject: ESPNScrapper
 * Date: 2/5/2018
 * Time: 4:01 AM
 */

require_once "vendor/autoload.php";

$players = new \ESPNScrapper\Players();


header("content-Type:application/json");

$list = $players->getPlayersList(7,\ESPNScrapper\Players::$T20);

$all = array();

foreach ($list as $p){
    $all[] = $players->getPlayerProfile($p->getPlayerId());
}

echo json_encode($all);