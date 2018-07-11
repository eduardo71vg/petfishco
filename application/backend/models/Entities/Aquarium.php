<?php

namespace PetFishCo\Backend\Models\Entities;

use PetFishCo\Core\Mvc\BaseModel;

class Aquarium extends BaseModel
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
     * @var integer
     */
    protected $aquarium_shape_id;

    /**
     *
     * @var integer
     */
    protected $aquarium_material_id;

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
     * Method to set the value of field aquarium_shape_id
     *
     * @param integer $aquarium_shape_id
     * @return $this
     */
    public function setAquariumShapeId($aquarium_shape_id)
    {
        $this->aquarium_shape_id = $aquarium_shape_id;

        return $this;
    }

    /**
     * Method to set the value of field aquarium_material_id
     *
     * @param integer $aquarium_material_id
     * @return $this
     */
    public function setAcquariumMaterialId($aquarium_material_id)
    {
        $this->aquarium_material_id = $aquarium_material_id;

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
     * @return integer
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
     * Returns the value of field aquarium_shape_id
     *
     * @return integer
     */
    public function getAquariumShapeId()
    {
        return $this->aquarium_shape_id;
    }

    /**
     * Returns the value of field aquarium_material_id
     *
     * @return integer
     */
    public function getAquariumMaterialId()
    {
        return $this->aquarium_material_id;
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
        $this->hasMany('id', 'PetFishCo\Models\Entity\Aquarium_has_fish', 'aquarium_id', array('alias' => 'Aquarium_has_fish'));
        $this->belongsTo('aquarium_material_id', 'PetFishCo\Models\Entity\Aquarium_material', 'id', array('alias' => 'Acquarium_material'));
        $this->belongsTo('aquarium_shape_id', 'PetFishCo\Models\Entity\Aquarium_shape', 'id', array('alias' => 'Aquarium_shape'));
        $this->belongsTo('shop_id', 'PetFishCo\Models\Entity\Shop', 'id', array('alias' => 'Shop'));
    }

    public function getSource()
    {
        return 'aquarium';
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
            'capacity' => 'capacity', 
            'shop_id' => 'shop_id', 
            'aquarium_shape_id' => 'aquarium_shape_id', 
            'aquarium_material_id' => 'aquarium_material_id',
            'created_at' => 'created_at', 
            'deleted' => 'deleted'
        );
    }

}
