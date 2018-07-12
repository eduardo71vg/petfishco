<?php

namespace PetFishCo\Frontend\Models\DTO;

use PetFishCo\Core\Mvc\BaseDTO;

class AquariumInstance extends BaseDTO
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $amount;

    /**
     *
     * @var integer
     */
    protected $shop_id;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at;

    /**
     *
     * @var integer
     */
    protected $aquarium_id;

	/**
	 *
	 * @var integer
	 */
	protected $capacity;

	/**
	 *
	 * @var string
	 */
	protected $aquarium_shape;

	/**
	 *
	 * @var string
	 */
	protected $aquarium_material;

	/**
	 * @return int
	 */
	public function getCapacity() {
		return $this->capacity;
	}

	/**
	 * @param int $capacity
	 */
	public function setCapacity($capacity) {
		$this->capacity = $capacity;
	}

	/**
	 * @return string
	 */
	public function getAquariumShape() {
		return $this->aquarium_shape;
	}

	/**
	 * @param string $aquarium_shape
	 */
	public function setAquariumShape($aquarium_shape) {
		$this->aquarium_shape = $aquarium_shape;
	}

	/**
	 * @return string
	 */
	public function getAquariumMaterial() {
		return $this->aquarium_material;
	}

	/**
	 * @param string $aquarium_material
	 */
	public function setAquariumMaterial($aquarium_material) {
		$this->aquarium_material = $aquarium_material;
	}

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field amount
     *
     * @param string $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

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
     * Method to set the value of field updated_at
     *
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

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
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
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
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PetFishCo\Backend\Models\Entities\Aquarium_has_fish', 'aquarium_instance_id', array('alias' => 'Aquarium_has_fish'));
        $this->belongsTo('aquarium_id', 'PetFishCo\Backend\Models\Entities\Aquarium', 'id', array('alias' => 'Aquarium'));
        $this->belongsTo('shop_id', 'PetFishCo\Backend\Models\Entities\Shop', 'id', array('alias' => 'Shop'));
    }

    public function getSource()
    {
        return 'aquarium_instance';
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
            'id' => 'id', 
            'amount' => 'amount', 
            'shop_id' => 'shop_id', 
            'created_at' => 'created_at', 
            'updated_at' => 'updated_at', 
            'aquarium_id' => 'aquarium_id'
        );
    }

}
