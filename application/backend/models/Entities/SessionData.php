<?php

namespace PetFishCo\Backend\Models\Entities;

use PetFishCo\Core\Mvc\BaseModel;

class SessionData extends BaseModel
{

    /**
     *
     * @var string
     */
    protected $session_id;

    /**
     *
     * @var string
     */
    protected $data;

    /**
     *
     * @var integer
     */
    protected $created_at;

    /**
     *
     * @var integer
     */
    protected $modified_at;

    /**
     * Method to set the value of field session_id
     *
     * @param string $session_id
     * @return $this
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;

        return $this;
    }

    /**
     * Method to set the value of field data
     *
     * @param string $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param integer $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field modified_at
     *
     * @param integer $modified_at
     * @return $this
     */
    public function setModifiedAt($modified_at)
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    /**
     * Returns the value of field session_id
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Returns the value of field data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the value of field created_at
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field modified_at
     *
     * @return integer
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    public function getSource()
    {
        return 'session_data';
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
            'session_id' => 'session_id', 
            'data' => 'data', 
            'created_at' => 'created_at', 
            'modified_at' => 'modified_at'
        );
    }

}
