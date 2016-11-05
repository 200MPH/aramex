<?php

/**
 * Tracking Result (response) Object
 * Implements abstraction from AbstractResponse
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex\ServiceBuilder\Service\TrackingService;

use thm\Aramex\ServiceBuilder\AbstractResponse;

class TrackingResponse extends AbstractResponse {
    
    /**
     * Tracks
     * Array key represents waybill/shipment number
     * 
     * @var Trac[]
     */
    private $tracks = [];
    
    /**
     * Get data
     * Get TrackingResults property from response object.
     * 
     * @return \stdClass
     */
    public function getData()
    {
        
        return $this->response->TrackingResults;
        
    }

    /**
     * Get tracks
     * 
     * @return Track[]
     */
    public function getTracks()
    {
        
        if(empty($this->tracks) === true) {
            
            $this->setTracks();
            
        }
        
        return $this->tracks;
        
    }
    
    /**
     * Set track objects
     * 
     * @return void
     */
    private function setTracks()
    {
        
        $response = $this->getData();
        
        if(isset($response->KeyValueOfstringArrayOfTrackingResultmFAkxlpY) === true) {
           
            $data = $response->KeyValueOfstringArrayOfTrackingResultmFAkxlpY;
            
            if(is_array($data) === true) {
                
                $this->setTracksFromArray();
                
            } else {
                
                $this->setTracksFromObject();
                
            }
            
        }
        
    }
    
    /**
     * Set track objects from array
     * 
     * @return void
     */
    private function setTracksFromArray()
    {
        
        $data = $this->getData();
        
        foreach($data->KeyValueOfstringArrayOfTrackingResultmFAkxlpY as $shipment) {
            
            $key = $shipment->Key;
            
            if(is_array($shipment->Value->TrackingResult) === true) {
                
                foreach($shipment->Value->TrackingResult as $track) {
                
                    $this->tracks[$key][] = $this->setTrackObject($track);
                
                }
                
            } else {
                
                $this->tracks[$key][] = $this->setTrackObject($shipment->Value->TrackingResult);
                
            }
            
        }
        
    }
    
    /**
     * Set track objects from object
     * 
     * @return void
     */
    private function setTracksFromObject()
    {
        
        $data = $this->getData();
        
        $shipment = $data->KeyValueOfstringArrayOfTrackingResultmFAkxlpY;
        
        $key = $shipment->Key;

        if(is_array($shipment->Value->TrackingResult) === true) {
        
            foreach($shipment->Value->TrackingResult as $track) {

                $this->tracks[$key][] = $this->setTrackObject($track);

            }
        
        } else {
            
            $this->tracks[$key][] = $this->setTrackObject($shipment->Value->TrackingResult);
            
        }
            
    }
    
    /**
     * Set Track object
     * 
     * @param stdClass $trackRow
     * @return Track
     */
    private function setTrackObject($trackRow) 
    {
        
        $track = new Track();
        
        $track->setWaybillNumber($trackRow->WaybillNumber);
        $track->setUpdateCode($trackRow->UpdateCode);
        $track->setUpdateDescription($trackRow->UpdateDescription);
        $track->setUpdateDateTime($trackRow->UpdateDateTime);
        $track->setUpdateLocation($trackRow->UpdateLocation);
        $track->setComment($trackRow->Comments);
        $track->setProblemCode($trackRow->ProblemCode);
        
        return $track;
        
    }
    
}
