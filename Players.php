<?php
/**
 * Created by Atiq.
 * Prject: ESPNScrapper
 * Date: 2/5/2018
 * Time: 3:49 AM
 */

namespace ESPNScrapper;



use ESPNScrapper\Models\Player;
use ESPNScrapper\Models\PlayerProfile;

class Players
{
   private $LIST_URL = "http://www.espncricinfo.com/pakistan/content/player/caps.html";
   private $SINGLE_URL = "http://www.espncricinfo.com/pakistan/content/player/";

   private $html;

   public static $TEST = 1;
   public static $ODI = 2;
   public static $T20 = 3;

    /**
     * Players constructor.
     */
    public function __construct()
    {
        $this->html = new  \simple_html_dom();
    }

    public function getPlayersList($teamId,$seriesType = Players::TEST){

        $this->html->load_file($this->LIST_URL . '?country='. $teamId .";class=". $seriesType);

        $players = array();

        foreach($this->html->find(".ciPlayername a") as $player){
            $name = $player->plaintext;
            $id =  explode('.',explode ('/',$player->href)[4])[0];
            $players[] = new Player($id, $name);
        }

        return $players;
    }

    public function getPlayerProfile($playerId){

        $this->html->load_file($this->SINGLE_URL . $playerId .".html");

        $player = new PlayerProfile($playerId);

        $player->setPlayerName($this->html->find('.ciPlayernametxt h1',0)->plaintext);

        $playerInfo = $this->html->find(".ciPlayerinformationtxt");

        $player->setBorn($playerInfo[1]->find('span',0)->plaintext);
        $player->setAge($playerInfo[2]->find('span',0)->plaintext);
        $player->setTeams(array_map('trim',explode(',',$playerInfo[3]->plaintext)));

        //TODO: Update the algo and Match the exact values according to the headings. if heading then setHeading()
        if(count($playerInfo) > 7) {
            $player->setNick($playerInfo[4]->find('span', 0)->plaintext);
            $player->setType($playerInfo[5]->find('span', 0)->plaintext);
            $player->setBattingStyle($playerInfo[6]->find('span', 0)->plaintext);
            $player->setBowlingStyle($playerInfo[7]->find('span', 0)->plaintext);
        }

        $photo = $this->html->find("#ciHomeContentlhs img",0)->src;

        $player->setPhotoUrl($this->getPhotoUrl($photo));

        return $player;
    }

    private function getPhotoUrl($photo){

        if(explode('/',$photo)[1] == "inline"){

            $url = 'http://www.espncricinfo.com' . $photo;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $url = curl_exec($ch);
            $lastUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            return $lastUrl;

        } else {
            return "no-image.png";
        }
    }


}