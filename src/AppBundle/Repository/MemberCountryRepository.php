<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * 
 * @author Dragan Valjak
 *
 */
class MemberCountryRepository extends EntityRepository
{
	
	public function createAlphabeticalCountryes()
	{
		return $this->createQueryBuilder('c')
		->orderBy('c.name', 'ASC')
		->getQuery()
		->execute();
	}
}