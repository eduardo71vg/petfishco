<?php

namespace PetFishCo\Backend\Models\Entities;

use PetFishCo\Core\Mvc\BaseModel;

class Shop extends BaseModel
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
    protected $name;

    /**
     *
     * @var string
     */
    protected $measure_system;

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
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field measure_system
     *
     * @param string $measure_system
     * @return $this
     */
    public function setMeasureSystem($measure_system)
    {
        $this->measure_system = $measure_system;

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
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field measure_system
     *
     * @return string
     */
    public function getMeasureSystem()
    {
        return $this->measure_system;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PetFishCo\Backend\Models\Entities\Aquarium_instance', 'shop_id', array('alias' => 'Aquarium_instance'));
    }

    public function getSource()
    {
        return 'shop';
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
            'name' => 'name', 
            'measure_system' => 'measure_system', 
            'created_at' => 'created_at', 
            'deleted' => 'deleted'
        );
    }

}
