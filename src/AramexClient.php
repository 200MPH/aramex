<?php

/**
 * Aramex Client Info
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex;

class AramexClient {
 
    /**
     * Account country code
     * 
     * @var string
     */
    private $accountCountryCode;
    
    /**
     * Account entity
     * 
     * @var string
     */
    private $accountEntity;
    
    /**
     * Account Number
     * 
     * @var int
     */
    private $accountNumber;
    
    /**
     * Account PIN
     * 
     * @var int
     */
    private $accountPin;
    
    /**
     * User name
     * 
     * @var string
     */
    private $username;
    
    /**
     * Password
     * 
     * @var string
     */
    private $password;
    
    /**
     * Service Version
     * 
     * @var string
     */
    private $version = '1.0';
    
    /**
     * Get account country code
     * 
     * @return string ISO2 country code
     */
    public function getAccountCountryCode()
    {
        
        return $this->accountCountryCode;
        
    }

    /**
     * Get account entity
     * 
     * @return string
     */
    public function getAccountEntity()
    {
        
        return $this->accountEntity;
        
    }

    /**
     * Get account number
     * 
     * @return int
     */
    public function getAccountNumber()
    {
        
        return (int)$this->accountNumber;
        
    }

    /**
     * Get account PIN
     * 
     * @return int
     */
    public function getAccountPin()
    {
        
        return (int)$this->accountPin;
        
    }

    /**
     * Get user name
     * 
     * @return string
     */
    public function getUsername()
    {
        
        return $this->username;
        
    }

    /**
     * Get password
     * 
     * @return string
     */
    public function getPassword()
    {
        
        return $this->password;
        
    }

    /**
     * Get service version
     * 
     * @return string
     */
    public function getVersion()
    {
        
        return $this->version;
        
    }

    /**
     * Set account country code - ISO2
     * 
     * @param string $accountCountryCode
     * @return Client
     */
    public function setAccountCountryCode($accountCountryCode)
    {
        
        $this->accountCountryCode = $accountCountryCode;
        return $this;
        
    }

    /**
     * Set acount entity
     * 
     * @param string $accountEntity
     * @return Client
     */
    public function setAccountEntity($accountEntity)
    {
        
        $this->accountEntity = $accountEntity;
        return $this;
        
    }

    /**
     * Set account number
     * 
     * @param int $accountNumber
     * @return Client
     */
    public function setAccountNumber($accountNumber)
    {
        
        $this->accountNumber = $accountNumber;
        return $this;
        
    }

    /**
     * Set account PIN
     * 
     * @param int $accountPin
     * @return Client
     */
    public function setAccountPin($accountPin)
    {
        
        $this->accountPin = $accountPin;
        return $this;
        
    }

    /**
     * Set username 
     * 
     * @param string $username
     * @return Client
     */
    public function setUserName($username)
    {
        
        $this->username = $username;
        return $this;
        
    }

    /**
     * Set password
     * 
     * @param string $password
     * @return Client
     */
    public function setPassword($password)
    {
        
        $this->password = $password;
        return $this;
        
    }

    /**
     * Set service version
     * 
     * @param string $version
     * @return Client
     */
    public function setVersion($version)
    {
        
        $this->version = $version;
        return $this;
        
    }
    
}
