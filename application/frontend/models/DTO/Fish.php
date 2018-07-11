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
     * Method to set the value of field fish_specie_id
     *
     * @param integer $fish_specie_id
     * @return $this
     */
    public function setFishSpecieId($fish_specie_id)
    {
        $this->fish_specie_id = $fish_specie_id;

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
     * Returns the value of field fish_specie_id
     *
     * @return integer
     */
    public function getFishSpecieId()
    {
        return $this->fish_specie_id;
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
}
