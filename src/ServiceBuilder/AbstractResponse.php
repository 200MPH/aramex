<?php

/**
 * Abstract Response Object
 * 
 * This class is part of BUILDER design pattern.
 * Also ADAPTER is implemented in this class as we adapt stdClass to more
 * user (coder) friendly object.
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex\ServiceBuilder;

use thm\Aramex\Transaction;

abstract class AbstractResponse {
    
    /**
     * Response get from Aramex SOAP service
     * 
     * @var \stdClass
     */
    protected $response;
    
    /**
     * Notifiacations
     * 
     * @var array
     */
    private $notifications = [];
    
    /**
     * Constructor setting up the response property.
     * 
     * @param \stdClass $response
     */
    public function __construct(\stdClass $response)
    {
        
        $this->response = $response;
        
    }
    
    /**
     * Get data
     * Get concrete data from response object.
     * Response data object has different property name depends on request type.
     * 
     * @return mixed
     */
    abstract public function getData();
    
    /**
     * Get transaction object from response
     * 
     * @return Transaction
     */
    public function getTransaction()
    {
        
        $transaction = new Transaction();
        
        $transaction->setReference( $this->response->Transaction );
        
        return $transaction;
        
    }
    
    /**
     * Get notifications
     * 
     * @return array
     */
    public function getNotifications()
    {
        
        if(isset($this->response->Notifications->Notification)) {
            
            $this->setNotifications();
            
        }
        
        return $this->notifications;
        
    }
    
    /**
     * Check if response has errors
     * 
     * @return bool TRUE if error occure, FALSE otherwise
     */
    public function hasErrors()
    {
        
        if($this->response->HasErrors == 1) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * Set notifications comes from response - if any
     * 
     * @return void
     */
    private function setNotifications()
    {
        
        $ntfs = $this->response->Notifications->Notification;
        
        // if many notifications is in the response
        // then it's comes as stdClass[] collection - array
        if(is_array($ntfs)) {
            
            foreach($ntfs as $notify) {
                
                $this->notifications[$notify->Code] = $notify->Message;
                
            }
            
        } else {
            
            // if only one notification is in the response
            // then it's come as stdClass object
            $this->notifications[$ntfs->Code] = $ntfs->Message;
            
        }
        
    }
    
}
