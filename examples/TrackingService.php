<?php

/**
 * Tracking Service usage example
 *
 * @author Wojciech Brozyna <wojciech.brozyna@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

use thm\Aramex\AramexClient;
use thm\Aramex\ServiceBuilder\Service\TrackingService\TrackingService;
use thm\Aramex\AramexException;

/* Very simple */
try {
            
    $client = new AramexClient();
    $client->setAccountCountryCode('GB')
           ->setAccountEntity('ABC')
           ->setAccountNumber(123456)
           ->setAccountPin(1234)
           ->setUserName('yourmail@domain.com')
           ->setPassword('aramex_password_here');

    $ts = new TrackingService($client);
    $ts->setShipments( array('Ship111111111', 'Ship22222222', 'Ship3333333') )
       ->sendRequest();

    // return tracking collection
    var_dump($ts->getResponse()->getTracks());
    
    // get whole object
    var_dump($ts->getResponse());
    
    // catch errors
    var_dump($ts->getResponse()->hasErrors());
    var_dump($ts->getResponse()->getNotifications());
    

} catch (AramexException $ae) {

    var_dump($ae->getMessage());

}

/* Set transaction references*/
try {
            
    $client = new AramexClient();
    $client->setAccountCountryCode('GB')
           ->setAccountEntity('ABC')
           ->setAccountNumber(123456)
           ->setAccountPin(1234)
           ->setUserName('yourmail@domain.com')
           ->setPassword('aramex_password_here');

    $transaction = new Transaction();
    // max 5 references
    $transaction->setReference(123)
                ->setReference(456)
                ->setReference(789);

    $ts = new TrackingService($client);
    $ts->setTransaction($transaction)
       ->setShipments( array($this->order->getCarrierShipRef()) );

    // return tracking collection
    var_dump($ts->getResponse()->getTracks());

    // get transaction references
    var_dump($ts->getResponse()
                ->getTransaction()
                ->getReferences());

} catch (AramexException $ae) {

    var_dump($ae->getMessage());

}

/* Get latest tracking update only */
try {
            
    $client = new AramexClient();
    $client->setAccountCountryCode('GB')
           ->setAccountEntity('ABC')
           ->setAccountNumber(123456)
           ->setAccountPin(1234)
           ->setUserName('yourmail@domain.com')
           ->setPassword('aramex_password_here');

    $ts = new TrackingService($client);
    $ts->getLastTrackingUpdateOnly()
       ->setShipments( array('Ship111111111', 'Ship22222222', 'Ship3333333') )
       ->sendRequest();

    // return tracking collection
    var_dump($ts->getResponse()->getTracks());
    
    // get whole object
    var_dump($ts->getResponse());
    
    // catch errors
    var_dump($ts->getResponse()->hasErrors());
    var_dump($ts->getResponse()->getNotifications());
    
} catch (AramexException $ae) {

    var_dump($ae->getMessage());

}