<?php

/**
 * Aramex Abstract Service Object
 * 
 * This class is part of BUILDER design pattern.
 * It's responsible for build request and response objects.  
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex\ServiceBuilder;

use thm\Aramex\AramexClient;
use thm\Aramex\Transaction;
use thm\Aramex\AramexException;
use SoapClient;
use SoapFault;

abstract class AbstractService {
    
    /**
     * @var Client
     */
    protected $client;
    
    /**
     * @var Transaction
     */
    protected $transaction;
    
    /**
     * @var SoapClient
     */
    protected $soap;
    
    /**
     * @var \stdClass
     */
    protected $response;
    
    /**
     * Shipments data
     * 
     * @var array
     */
    private $shipments = [];
    
    /**
     * Constructor
     * 
     * @param AramexClient $client
     * @throw AramexException
     */
    public function __construct(AramexClient $client)
    {
        
        $this->client = $client;
        
        try {
        
            $this->soap = new SoapClient( $this->getWsdl() );
            
        } catch(SoapFault $fault) {
            
            throw new AramexException(AramexException::WSDL_LOAD_ERR, $fault->getCode(), $fault);
            
        }
        
    }

    /**
     * Send request to Aramex service
     * 
     * @return void
     */
    abstract public function sendRequest();
    
    /**
     * Get response
     * 
     * @return AbstractResponse
     */
    abstract public function getResponse();
    
    /**
     * Get WSDL file
     * 
     * @return string Path to the WSDL file
     */
    abstract protected function getWsdl();

    /**
     * Set transaction
     * 
     * @param Transaction $transaction
     * @return AbstractService
     */
    public function setTransaction(Transaction $transaction)
    {
        
        $this->transaction = $transaction;
        return $this;
        
    }
    
    /**
     * Get transaction
     * 
     * @return Transaction
     */
    public function getTransaction()
    {
        
        if($this->transaction instanceof Transaction) {
            
            return $this->transaction;
            
        } else {
            
            $this->transaction = new Transaction();
            
            return $this->transaction;
            
        }
        
    }
    
    /**
     * Set shipments
     * 
     * @param array $shipments
     * @return AbstractService
     */
    public function setShipments($shipments)
    {
        
        if(empty($shipments) === false) {
            
            $this->shipments = $shipments;
            
        }
        
        return $this;
        
    }
    
    /**
     * Get service functions
     * 
     * @return array
     */
    public function getServiceFunctions()
    {
        
        return $this->soap->__getFunctions();
        
    }
    
    /**
     * Cal service function
     * 
     * @param string $function Service function name
     * @param array $args Service function arguments
     * @return mixed
     */
    public function callServiceFunction($function, $args)
    {
        
        return $this->soap->__soapCall($function, $args);
        
    }
    
    /**
     * Get request parameters
     * 
     * @return array
     */
    protected function getRequestParams()
    {
        
        $params = array(
		        'ClientInfo' => array(
					      'AccountCountryCode' => $this->client->getAccountCountryCode(),
					      'AccountEntity'      => $this->client->getAccountEntity(),
					      'AccountNumber'	   => $this->client->getAccountNumber(),
					      'AccountPin'	   => $this->client->getAccountPin(),
					      'UserName'	   => $this->client->getUsername(),
					      'Password'	   => $this->client->getPassword(),
					      'Version'		   => $this->client->getVersion()
					     ),

                        'Transaction' => $this->getTransaction()->getReferences(),
                        'Shipments'   => $this->shipments		
	);
        
        return $params;
        
    }
    
}
