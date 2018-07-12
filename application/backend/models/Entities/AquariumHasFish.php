<?php

namespace PetFishCo\Backend\Models\Entities;

use PetFishCo\Core\Mvc\BaseModel;

class AquariumHasFish extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $aquarium_instance_id;

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
	 * @var integer
	 */
	protected $stock;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     * Method to set the value of field aquarium_instance_id
     *
     * @param integer $aquarium_instance_id
     * @return $this
     */
    public function setAquariumInstanceId($aquarium_instance_id)
    {
        $this->aquarium_instance_id = $aquarium_instance_id;

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
     * Returns the value of field aquarium_instance_id
     *
     * @return integer
     */
    public function getAquariumInstanceId()
    {
        return $this->aquarium_instance_id;
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

	/**
	 * @return int
	 */
	public function getStock() {
		return $this->stock;
	}

	/**
	 * @param int $stock
	 */
	public function setStock($stock) {
		$this->stock = $stock;
	}



    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('aquarium_instance_id', 'PetFishCo\Backend\Models\Entities\Aquarium_instance', 'id', array('alias' => 'Aquarium_instance'));
        $this->belongsTo('fish_id', 'PetFishCo\Backend\Models\Entities\Fish', 'id', array('alias' => 'Fish'));
    }

    public function getSource()
    {
        return 'aquarium_has_fish';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'aquarium_instance_id' => 'aquarium_instance_id', 
            'shop_id' => 'shop_id', 
            'fish_id' => 'fish_id', 
            'stock' => 'stock',
            'created_at' => 'created_at'
        );
    }

}
