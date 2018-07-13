<?php

namespace PetFishCo\Frontend\Models\DTO;

use PetFishCo\Core\Mvc\BaseDTO;
use PetFishCo\Frontend\Helpers\UnitsConverter;

class Aquarium extends BaseDTO
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $capacity;

    /**
     *
     * @var integer
     */
    protected $shop_id;

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
	 *
	 * @var int
	 */
	protected $aquarium_shape_id;

	/**
	 *
	 * @var int
	 */
	protected $aquarium_material_id;

	/**
	 *
	 * @var int
	 */
	protected $amount;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var integer
     */
    protected $deleted;

	/**
	 * @return int
	 */
	public function getAquariumShapeId() {
		return $this->aquarium_shape_id;
	}

	/**
	 * @param int $aquarium_shape_id
	 */
	public function setAquariumShapeId($aquarium_shape_id) {
		$this->aquarium_shape_id = $aquarium_shape_id;
	}

	/**
	 * @return int
	 */
	public function getAquariumMaterialId() {
		return $this->aquarium_material_id;
	}

	/**
	 * @param int $aquarium_material_id
	 */
	public function setAquariumMaterialId($aquarium_material_id) {
		$this->aquarium_material_id = $aquarium_material_id;
	}

	/**
	 * @return int
	 */
	public function getAmount() {
		return $this->amount;
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
     * Method to set the value of field capacity
     *
     * @param integer $capacity
     * @return $this
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

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
     * Method to set the value of field deleted
     *
     * @param integer $deleted
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

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
     * Returns the value of field capacity
     *
	 *
	 * @return string
	 */
    public function getCapacity()
    {
    	return $this->capacity;
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
     * Returns the value of field deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
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



}
