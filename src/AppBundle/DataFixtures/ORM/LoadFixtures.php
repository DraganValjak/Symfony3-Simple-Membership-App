<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;


/**
 *
 * @author Dragan Valjak
 *        
 */
class LoadFixtures implements FixtureInterface
{
	
	/**
	 * {@inheritDoc}
	 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
	 */
	public function load(ObjectManager $manager) {
		
		$objects = Fixtures::load(__DIR__.'/fixtures.yml', $manager,
            [
                'providers' => [$this]
            ]);

	}
	
	public function tShirtSize()
	{
		$genera = [
				'S','M', 'L', 'XL','XXL', 'XXL'
		];
		
		$key = array_rand($genera);
		
		return $genera[$key];
	}
	
	
    public function birthDate()
    {
    	$startStamp = strtotime(  '1971-02-28 15:00:00' );
    	$endStamp   = strtotime(  '1980-02-28 17:00:00' );
    	
    	
    	while( $endStamp >= $startStamp ){
    	
    		$genera[] = date( 'Y-m-d h:i:s', $startStamp );
    	
    		$startStamp = strtotime( '+'.mt_rand(0,100).' days', $startStamp );
    	
    	}
    	
    	$key = array_rand($genera);
    	
    	return $genera[$key];
    }
    
    
   
	
	
	
}