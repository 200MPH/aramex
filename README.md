ARAMEX API Client.

This package allows for tracking only for now.
However another functions still under development.
Contributors are very welcome :)

Usage:

```
use thm\Aramex\AramexClient;
use thm\Aramex\ServiceBuilder\Service\TrackingService\TrackingService;
use thm\Aramex\AramexException;

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
    $tracks = $ts->getResponse()->getTracks();
    var_dump($tracks);
    foreach($tracks as $track) {
        
        var_dump($track->getWaybillNumber());
        
    }
    
    // get whole object
    var_dump($ts->getResponse());
    
    // catch errors
    var_dump($ts->getResponse()->hasErrors());
    var_dump($ts->getResponse()->getNotifications());
    

} catch (AramexException $ae) {

    var_dump($ae->getMessage());

}
```

More examples are in ./examples folder