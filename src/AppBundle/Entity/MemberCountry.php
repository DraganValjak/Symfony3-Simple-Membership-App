<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MemberCountryRepository")
 * @ORM\Table(name="member_country")
 * @author Dragan Valjak
 *
 */
class MemberCountry 
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 * @var integer
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 * @var string
	 */
	private $name;
	
	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	public function __toString()
	{
		return $this->getName();
	}
	
}