<?php

namespace PetFishCo\Frontend\Models\DTO;

use PetFishCo\Core\Mvc\BaseDTO;

class AquariumHasFish extends BaseDTO
{

    /**
     *
     * @var integer
     */
    protected $aquarium_id;

    /**
     *
     * @var integer
     */
    protected $shop_id;

    /**
     *
     * @var integer
     */
    protected $fish_id;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     * Method to set the value of field aquarium_id
     *
     * @param integer $aquarium_id
     * @return $this
     */
    public function setAquariumId($aquarium_id)
    {
        $this->aquarium_id = $aquarium_id;

        return $this;
    }

    /**
     * Method to set the value of field shop_id
     *
     * @param integer $shop_id
     * @return $this
     */
    public function setShopId($shop_id)
    {
        $this->shop_id = $shop_id;

        return $this;
    }

    /**
     * Method to set the value of field fish_id
     *
     * @param integer $fish_id
     * @return $this
     */
    public function setFishId($fish_id)
    {
        $this->fish_id = $fish_id;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Returns the value of field aquarium_id
     *
     * @return integer
     */
    public function getAquariumId()
    {
        return $this->aquarium_id;
    }

    /**
     * Returns the value of field shop_id
     *
     * @return integer
     */
    public function getShopId()
    {
        return $this->shop_id;
    }

    /**
     * Returns the value of field fish_id
     *
     * @return integer
     */
    public function getFishId()
    {
        return $this->fish_id;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }


}
