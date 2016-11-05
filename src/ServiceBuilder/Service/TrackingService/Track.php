<?php

/**
 * Track entity which represents track details.
 * 
 * It's a part of BUILDER design pattern and also implements ADAPTER
 * pattern as we adapt stdClass to more user (coder) friendly object. 
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex\ServiceBuilder\Service\TrackingService;

class Track {
    
    /**
     * @var int
     */
    private $waybillNumber = 0;
    
    /**
     * @var string
     */
    private $updateCode;
    
    /**
     * @var string
     */
    private $updateDescription;
    
    /**
     * @var string
     */
    private $updateDateTime;
    
    /**
     * @var string
     */
    private $updateLocation;
    
    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $problemCode;
    
    /**
     * Get waybill number
     * 
     * @return int
     */
    public function getWaybillNumber()
    {
        
        return $this->waybillNumber;
        
    }
    /**
     * Get update code
     * 
     * @return string
     */
    public function getUpdateCode()
    {
        
        return $this->updateCode;
        
    }
    /**
     * Get update description
     * 
     * @return string
     */
    
    public function getUpdateDescription()
    {
        
        return $this->updateDescription;
        
    }

    /**
     * Get update date time
     * 
     * @return string
     */
    public function getUpdateDateTime()
    {
        
        $dt = str_replace('T', ' ', $this->updateDateTime);
        
        return $dt;
        
    }

    /**
     * Get update location
     * 
     * @return string
     */
    public function getUpdateLocation()
    {
        
        return $this->updateLocation;
        
    }
    
    /**
     * Get comment
     * 
     * @return string
     */
    public function getComment()
    {
        
        return $this->comment;
        
    }

    /**
     * Get problem code
     * 
     * @return string
     */
    public function getProblemCode()
    {
        
        return $this->problemCode;
        
    }

    /**
     * Set waybill number
     * 
     * @param int $waybillNumber
     */
    public function setWaybillNumber($waybillNumber)
    {
        
        $this->waybillNumber = $waybillNumber;
        
    }

    /**
     * Set update code
     * 
     * @param string $updateCode
     */
    public function setUpdateCode($updateCode)
    {
        
        $this->updateCode = $updateCode;
        
    }

    /**
     * Set update description
     * 
     * @param string $updateDescription
     */
    public function setUpdateDescription($updateDescription)
    {
        
        $this->updateDescription = $updateDescription;
        
    }

    /**
     * 
     * Set update date time
     * 
     * @param string $updateDateTime
     */
    public function setUpdateDateTime($updateDateTime)
    {
        
        $this->updateDateTime = $updateDateTime;
        
    }

    /**
     * Set update location
     * 
     * @param string $updateLocation
     */
    public function setUpdateLocation($updateLocation)
    {
        
        $this->updateLocation = $updateLocation;
        
    }

    /**
     * Set comment
     * 
     * @param string $comment
     */
    public function setComment($comment)
    {
        
        $this->comment = $comment;
        
    }

    /**
     * Set problem code
     * 
     * @param string $problemCode
     */
    public function setProblemCode($problemCode)
    {
        
        $this->problemCode = $problemCode;
        
    }

}
