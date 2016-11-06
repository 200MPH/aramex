<?php

/**
 * Aramex Tracking Service Object
 * 
 * Implements AbstractService and it's part of BUILDER design pattern
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex\ServiceBuilder\Service\TrackingService;

use thm\Aramex\ServiceBuilder\AbstractService;
use thm\Aramex\AramexException;
use SoapFault;

class TrackingService extends AbstractService {
    
    /**
     * Last tracking only flag
     * 
     * @var bool
     */
    private $lastTrackingOnly = false;
    
    /**
     * Send request to Aramex service
     * 
     * @return void
     * @throws AramexException
     */
    public function sendRequest()
    {
        
        try {
            
            $this->response = $this->soap->TrackShipments( $this->getRequestParams() );
            
        } catch(SoapFault $fault) {
            
            throw new AramexException(AramexException::METHOD_FAILED, $fault->getCode(), $fault);
            
        }
        
    }
    
    /**
     * Get response
     * 
     * @return TrackingResult
     */
    public function getResponse()
    {
        
        if(is_object($this->response) === false) {
            
            $this->response = new \stdClass();
                    
            $this->response->Transaction = null;
            $this->response->Notifications = null;
            $this->response->HasErrors = 0;
            $this->response->TrackingResults = null;
            
        }
        
        $response = new TrackingResponse( $this->response );

        return $response;
        
    }
        
    /**
     * Get last tracking update only
     * Will return latest record from tracking updates.
     * 
     * @return TrackingService
     */
    public function getLastTrackingUpdateOnly()
    {
        
        $this->lastTrackingOnly = true;
        
        return $this;
        
    }
    
    /**
     * Get WSDL file
     * 
     * @return string Path to the WSDL file
     */
    protected function getWsdl()
    {
        
        return __DIR__ . '/tracking-api.wsdl';
        
    }
    
    /**
     * Get request parameters
     * 
     * @return array
     */
    protected function getRequestParams()
    {
        
        $params = parent::getRequestParams();
        
        $params['GetLastTrackingUpdateOnly'] = $this->lastTrackingOnly;
        
        return $params;
        
    }
    
}
