<?php

/**
 * Aramex Exception Codes
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace thm\Aramex;

class AramexException extends \Exception {
    
    /* Reference number exhausted, maximum allowed references is 5 */
    const REFERENCE_EX = 'Reference number exhausted, maximum allowed references is 5';
    
    /* SOAP WSDL load fail */
    const WSDL_LOAD_ERR = 'WSDL file cannot be load';
    
    /* Response not returned stdClass instance */
    const NOT_STD_CLASS = 'Response is not stdClass() instance';
    
    /* Service method call failed */
    const METHOD_FAILED = 'Service method call failed';
    
}
