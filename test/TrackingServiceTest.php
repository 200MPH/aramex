<?php

namespace test\Aramex;

use thm\Aramex\AramexClient;
use thm\Aramex\ServiceBuilder\Service\TrackingService\TrackingService;
use thm\Aramex\ServiceBuilder\Service\TrackingService\TrackingResponse;

class TrackingServiceTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @var TrackingService
     */
    private $ts;
    
    public function setUp()
    {
        
        parent::setUp();
        
        $client = new AramexClient();
        $client->setAccountCountryCode('GB')
               ->setAccountEntity('ABC')
               ->setAccountNumber(123456)
               ->setAccountPin(1234)
               ->setUserName('yourmail@domain.com')
               ->setPassword('aramex_password_here');
        
        $this->ts = new TrackingService($client);
        
    }
    
    /**
     * Test getResponse return TrackingResponse object
     */
    public function testGetResponseReturnsObject()
    {
        
        $state = $this->ts->getResponse() instanceof TrackingResponse;
        
        $this->assertTrue($state);
    
    }
    
}
