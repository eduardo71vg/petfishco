<?php

namespace PetFishCo\Frontend\Models\DTO;

use PetFishCo\Core\Mvc\BaseDTO;

class Fish extends BaseDTO
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
    protected $alias;

    /**
     *
     * @var string
     */
    protected $color;

    /**
     *
     * @var integer
     */
    protected $fins;

    /**
     *
     * @var integer
     */
    protected $fish_specie_id;

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
     *
     * @var integer
     */
    protected $deleted;

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
     * Method to set the value of field alias
     *
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Method to set the value of field color
     *
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Method to set the value of field fins
     *
     * @param integer $fins
     * @return $this
     */
    public function setFins($fins)
    {
        $this->fins = $fins;

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
     * Returns the value of field alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Returns the value of field color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Returns the value of field fins
     *
     * @return integer
     */
    public function getFins()
    {
        return $this->fins;
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
	public function getFishSpecie() {
		return $this->fish_specie_id;
	}

	/**
	 * @param string $fish_specie
	 */
	public function setFishSpecie($fish_specie) {
		$this->fish_specie = $fish_specie;
	}

	/**
	 * @return int
	 */
	public function getStock() {
		return $this->stock;
	}

	/**
	 * @param int $amount
	 */
	public function setStock($stock) {
		$this->stock = $stock;
	}


}
