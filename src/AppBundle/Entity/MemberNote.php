<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MemberNoteRepository")
 * @ORM\Table(name="member_note")
 * 
 * @author Dragan Valjak
 *
 */
class MemberNote
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 * @var integer 
	 */
	private $id;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Member", inversedBy="notes")
	 * @ORM\JoinColumn(nullable=false)
	 * @var object Member
	 */
	private $member;	
	/**
	 * @ORM\Column(type="integer", options={"default" = 1})
	 * @Assert\NotNull
	 * @var integer
	 */
	private $status;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 * @Assert\NotBlank
	 * @var string
	 */
	private $title;
	
	/**
	 * @ORM\Column(type="text")
	 * @Assert\NotBlank
	 * @var text 
	 */
	private $note;
	
	/**
	 * @ORM\Column(type="datetime")
	 * @Assert\NotBlank()
	 * @var \DateTime
	 */
	private $createdAt;
	
	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getMember() {
		return $this->member;
	}
	
	/**
	 *
	 * @param Member $member
	 *        	
	 */
	public function setMember(Member $member) {
		$this->member = $member;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 *
	 * @param
	 *        	$status
	 */
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 *
	 * @param
	 *        	$title
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	
	/**
	 *
	 * @return the text
	 */
	public function getNote() {
		return $this->note;
	}
	
	/**
	 *
	 * @param text $note        	
	 */
	public function setNote($note) {
		$this->note = $note;
		return $this;
	}
	
	/**
	 *
	 * @return the DateTime
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}
	
	/**
	 *
	 * @param \DateTime $createdAt        	
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
		return $this;
	}
	
	public function __toString()
	{
		return $this->member;
	}
	
	
	
	
}