<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\MemberNote;
use AppBundle\Entity\Member;

/**
 * 
 * @author Dragan Valjak
 *
 */
class MemberNoteRepository  extends  EntityRepository
{
	
	/**
	 * Find all notes il last 3 month
	 * @return MemberNote
	 */
	public function findAllNotesInTreeMonths()
	{
		return $this->createQueryBuilder ( 'member_note' )
		->andWhere ( 'member_note.createdAt > :givenDate' )
		->setParameter ( 'givenDate', new \DateTime ( '-3 months' ) )
		->leftJoin('member_note.member', 'member')
		->getQuery ()
		->execute ();
	}
	
	
	/**
	 * Find all notes for given Member
	 * @param Member $member
	 * @return object MemberNote
	 */
	public function findAllNotesForMember(Member $member)
	{
		return $this->createQueryBuilder('member_note')
		->andWhere('member_note.member = :member')
		->setParameter('member', $member)
		->orderBy('member_note.createdAt', 'DESC')
		->getQuery()
		->execute();
		
	}
	
	public function findAllRestNotesForMember(Member $member, MemberNote $memberNote)
	{
		return $this->createQueryBuilder('member_notes')
		->andWhere('member_notes.member = :member')
		->setParameter('member', $member)
		->andWhere('member_notes.id != :memberNote')
		->setParameter('memberNote', $memberNote)
		->orderBy('member_notes.createdAt', 'DESC')
		->getQuery()
		->execute();
	}
}