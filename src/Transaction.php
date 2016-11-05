<?php

/**
 * Aramex Transaction Object
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex;

class Transaction {
    
    /**
     * @var array
     */
    private $references = [];
    
    /**
     * Set/Add Reference
     * 
     * @param mixed|array|stdClass $value Single reference value or array contains multiple references
     * @throw AramexException
     * @return Transaction
     */
    public function setReference($value) 
    {
        
        if(is_array($value) === true) {
            
            $this->references = $value;
            
        } elseif($value instanceof \stdClass) {
            
            // set references comes from response (stdClass)
            $this->references[] = isset($value->Reference1) ? $value->Reference1 : null;
            $this->references[] = isset($value->Reference2) ? $value->Reference2 : null;
            $this->references[] = isset($value->Reference3) ? $value->Reference3 : null;
            $this->references[] = isset($value->Reference4) ? $value->Reference4 : null;
            $this->references[] = isset($value->Reference5) ? $value->Reference5 : null;
            
        } else {
            
            $this->references[] = $value;
            
        }
        
        // only 5 references allowed
        if(count($this->references) > 5) {
            
            throw new AramexException(AramexException::REFERENCE_EX);
            
        } 
        
        return $this;
        
    }
    
    /**
     * Get references
     * 
     * @return array
     */
    public function getReferences()
    {
        
        $references = [];
        $rCount = count($this->references);
        
        for($i=0; $i < $rCount; $i++) {
            
            $refNo = $i + 1;
            $key = "Reference" . $refNo;
            
            $references[$key] = $this->references[$i]; 
            
        }
        
        return $references;
        
    }
    
}
