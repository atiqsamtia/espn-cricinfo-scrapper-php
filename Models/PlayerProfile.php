<?php
/**
 * Created by Atiq.
 * Prject: ESPNScrapper
 * Date: 2/5/2018
 * Time: 5:06 AM
 */

namespace ESPNScrapper\Models;


class PlayerProfile implements \JsonSerializable
{
    private $playerId;
    private $playerName;
    private $born;
    private $age;
    private $teams;
    private $nick;
    private $type;
    private $battingStyle;
    private $bowlingStyle;
    private $photoUrl;

    /**
     * PlayerProfile constructor.
     * @param $playerId
     */
    public function __construct($playerId)
    {
        $this->playerId = $playerId;
    }

    /**
     * @return mixed
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @param mixed $playerId
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
    }

    /**
     * @return mixed
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @param mixed $playerName
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = str_replace('&nbsp;', '', trim($playerName));
    }

    /**
     * @return mixed
     */
    public function getBorn()
    {
        return $this->born;
    }

    /**
     * @param mixed $born
     */
    public function setBorn($born)
    {
        $this->born = trim($born);
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = trim($age);
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     */
    public function setTeams($teams)
    {
        if(count($teams) > 0)
        $teams[0] = str_replace('Major teams ', '', $teams[0]);

        $this->teams = $teams;
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param mixed $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getBattingStyle()
    {
        return $this->battingStyle;
    }

    /**
     * @param mixed $battingStyle
     */
    public function setBattingStyle($battingStyle)
    {
        $this->battingStyle = $battingStyle;
    }

    /**
     * @return mixed
     */
    public function getBowlingStyle()
    {
        return $this->bowlingStyle;
    }

    /**
     * @param mixed $bowlingStyle
     */
    public function setBowlingStyle($bowlingStyle)
    {
        $this->bowlingStyle = $bowlingStyle;
    }

    /**
     * @return mixed
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * @param mixed $photoUrl
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;
    }





    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}