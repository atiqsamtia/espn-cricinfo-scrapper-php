<?php
/**
 * Created by Atiq.
 * Prject: ESPNScrapper
 * Date: 2/5/2018
 * Time: 4:06 AM
 */

namespace ESPNScrapper\Models;


class Player  implements \JsonSerializable
{
    private $playerId;
    private $playerName;

    /**
     * Player constructor.
     * @param $playerId
     * @param $playerName
     */
    public function __construct($playerId, $playerName)
    {
        $this->playerId = $playerId;
        $this->playerName = $playerName;
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
        $this->playerName = $playerName ;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}