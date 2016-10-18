<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @author Dragan Valjak
 *
 */
class User implements UserInterface
{
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 * @var integer
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", unique=true)
	 * @var string
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $password;
	
	/**
	 * Don't persisit this with Doctrine !
	 * A non-persisted field used to create the encoded password
	 * @var string
	 */
	private $plainPassword;
	
	/**
	 * @ORM\Column(type="json_array")
	 * @var json_array
	 */
	private $roles;
	
	/**
	 *
	 * @return the integer
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Needed only by the security system!
	 * This is only used to show you who is logged in when you're debugging.
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
	 * 
	 */
	public function getUsername() {
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * Basically permissions: ['ROLE_USER']
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
	 */
	public function getRoles()
	{
		$roles = $this->roles;
	
		// give everyone ROLE_USER!
		if (!in_array('ROLE_USER', $roles)) {
			$roles[] = 'ROLE_USER';
		}
	
		return $roles;
	}
	
	public function setRoles(array $roles)
	{
		$this->roles = $roles;
	}
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
	 */
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		return $this->password = $password;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
	 */
	public function getSalt() {
		// leaving blank - I don't need/have a password!
	}


	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
	 */
	public function eraseCredentials() {
		$this->plainPassword = null;
	}
	
	public function getPlainPassword() {
		return $this->plainPassword;
		// forces the object to look "dirty" to Doctrine.
		// Avoids Doctrine *not* saving this entity, if only plainPassword changes
		$this->password = null;
	}
	
	public function setPlainPassword($plainPassword) {
		$this->plainPassword = $plainPassword;
		return $this;
	}
	
	


}