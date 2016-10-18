<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Member;


/**
 *
 * @author Dragan Valjak
 *        
 */
class MemberRepository extends EntityRepository
{
	
	
	/**
	 * @param Member $member
	 * @return Member[]
	 */
	public function findAllBirthDaysInCurrentMonth() {
		
		$emConfig = $this->getEntityManager()->getConfiguration();
		$emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
		$emConfig->addCustomDatetimeFunction('STR_TO_DATE', 'DoctrineExtensions\Query\Mysql\StrToDate');
		
		return $this->createQueryBuilder ( 'mbd' ) ->select ( 'mbd' )->where ( "MONTH( STR_TO_DATE( mbd.birthDate, '%Y-%m-%d' ) ) = MONTH(CURRENT_TIMESTAMP())" )
		->orderBy('mbd.birthDate', 'DESC')
		->getQuery ()
		->execute(); 
		    
	}
	
	/**
	 * @param Member $member
	 * @return Member[]
	 */
	public function getExpiredValidDateMember()
	{
		return $this->createQueryBuilder('evm')
		->andWhere('evm.validDate < :curentDate')
		->setParameter('curentDate', new \DateTime())
		->orderBy('evm.membershipNumber', 'DESC')
		->getQuery()
		->execute();
	}
	
	
	

	
}