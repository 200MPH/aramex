<?php

namespace test\Aramex;

use thm\Aramex\ServiceBuilder\Service\TrackingService\TrackingResponse;
use thm\Aramex\Transaction;

/**
 * Tracking response test
 */

class TrackingResponseTest extends \PHPUnit_Framework_TestCase {
   
    /**
     * @var TrackingResponse
     */
    private $tr;
    
    /**
     * @var zstdClass
     */
    private $response;
    
    public function setUp()
    {
        
        parent::setUp();
        
        $this->response = new \stdClass();
        
        $this->response->Transaction = null;
        $this->response->Notifications = null;
        $this->response->HasErrors = 0;
        $this->response->TrackingResults = null;
        
        $this->tr = new TrackingResponse($this->response);
        
    }
    
    /**
     * Check Transaction is object
     */
    public function testIsTransactionInstance()
    {
        
        $state = $this->tr->getTransaction() instanceof Transaction;

        $this->assertTrue($state);
        
    }
    
    /**
     * Check notification is array
     */
    public function testNotificationsIsArray()
    {
        
        $state = is_array($this->tr->getNotifications());
        
        $this->assertTrue($state);
        
    }
    
    /**
     * Has errors === true
     */
    public function testHasErrorsIsTrue()
    {
        
        $this->response->HasErrors = 1;
        
        $this->tr = new TrackingResponse($this->response);
        
        $this->assertTrue($this->tr->hasErrors());
        
    }
    
    /**
     * Has errors === false
     */
    public function testHasErrorsIsFalse()
    {
        
        $this->assertFalse($this->tr->hasErrors());
        
        $this->response->HasErrors = null;
        
        $this->tr = new TrackingResponse($this->response);
        
        $this->assertFalse($this->tr->hasErrors());
        
    }
    
    /**
     * getTracks returns array
     */
    public function testGetTracksIsArray()
    {
        
        $state = is_array($this->tr->getTracks());
        
        $this->assertTrue($state);
        
    }
    
}
