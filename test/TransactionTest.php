<?php

/**
 * Aramex Transaction Test
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 */

namespace test\Aramex;

use thm\Aramex\Transaction;
use thm\Aramex\AramexException;

class TransactionTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * Check setting up for single value
     */
    public function testSetSingle()
    {
        
        $t = new Transaction();
        $t->setReference('abc');
        
        $ref = $t->getReferences();
        
        $this->assertArrayHasKey('Reference1', $ref);
        
    }
    
    /**
     * Check setting up reference by array
     */
    public function testSetByArray()
    {
        
        $t = new Transaction();
        $t->setReference(array('123', '234', '345', '456', '567'));
        
        $ref = $t->getReferences();
        
        $this->assertArrayHasKey('Reference1', $ref);
        $this->assertArrayHasKey('Reference2', $ref);
        $this->assertArrayHasKey('Reference3', $ref);
        $this->assertArrayHasKey('Reference4', $ref);
        $this->assertArrayHasKey('Reference5', $ref);
    }
    
    /**
     * Check setting up where array to big
     */
    public function testArrayToBig()
    {
        
        $this->setExpectedException('thm\Aramex\AramexException', AramexException::REFERENCE_EX, 0);
        
        $t = new Transaction();
        $t->setReference(array('123', '234', '345', '456', '567', '678'));
        
    }
    
    /**
     * Check array count matches
     */
    public function testArraysCountMatch()
    {
        
        $t = new Transaction();
        $t->setReference(array('123', '234', '345', '456', '567',));
        
        $count = count($t->getReferences());
        
        if($count === 5) {
            
            $con = true;
            
        } else {
            
            $con = false;
            
        }
        
        $this->assertTrue($con);
        
    }
    
    /**
     * Check setting up by object
     */
    public function testSetByObject()
    {
        
        $t = new Transaction();
        
        $obj = new \stdClass();
        
        $obj->Reference1 = 'abc';
        $obj->Reference2 = 'def';
        $obj->doNotSet = 'wrong';
        
        $t->setReference($obj);
        
        $ref = $t->getReferences();
        
        $this->assertEquals('abc', $ref['Reference1']);
        $this->assertEquals('def', $ref['Reference2']);
        $this->assertEquals(null, $ref['Reference3']);
        $this->assertEquals(null, $ref['Reference4']);
        $this->assertEquals(null, $ref['Reference5']);
        
    }
    
    /**
     * Check set by empty object
     */
    public function testSetByEmptyObject()
    {
        
        $t = new Transaction();
        
        $obj = new \stdClass();
        
        $t->setReference($obj);
        
        $ref = $t->getReferences();
        
        $this->assertArrayHasKey('Reference1', $ref);
        $this->assertArrayHasKey('Reference2', $ref);
        $this->assertArrayHasKey('Reference3', $ref);
        $this->assertArrayHasKey('Reference4', $ref);
        $this->assertArrayHasKey('Reference5', $ref);
        
    }
    
}
