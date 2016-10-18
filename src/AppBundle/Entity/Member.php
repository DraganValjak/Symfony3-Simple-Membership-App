<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MemberRepository")
 * @ORM\Table(name="member")
 * @UniqueEntity("membershipNumber")
 * @author Dragan Valjak
 */
class Member
{
	
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var integer
	 */
	private $id;
	
	/**
	 * @ORM\OneToMany(targetEntity="MemberNote", mappedBy="member")
	 * @ORM\OrderBy({"createdAt" = "DESC"})
	 * @var ArrayCollection|GenusNote[]
	 */
	private $notes;
	
	/**
	 * @ORM\Column(type="integer", unique=true)
	 * @Assert\NotNull
	 * @Assert\NotBlank()
	 * @Assert\Type(type="integer", message="The value {{ value }} is not a valid {{ type }}")
	 * @Assert\Range(min=0, minMessage="Can not be a negative number.")
	 * @var integer
	 */
	private $membershipNumber;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 * @Assert\NotBlank()
	 * @var string
	 */
	private $firstName;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 * @Assert\NotBlank()
	 * @var string
	 */
	private $lastName;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 * @Assert\NotBlank()
	 * @var string
	 */
	private $address;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 * @Assert\NotBlank()
	 * @var string
	 */
	private $city;
	
	/**
	 * @ORM\Column(type="integer")
	 * @Assert\NotBlank()
	 * @var integer
	 */
	private $country;
	
	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 * 
	 * @var string
	 */
	private $birthDate;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 * @Assert\Email()
	 * @var string
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 * @var string
	 */
	private $tel;
	
	/**
	 * @ORM\Column(type="datetime")
	 * @Assert\NotBlank()
	 * @var string
	 */
	private $joinDate;
	
	/**
	 * @ORM\Column(type="datetime")
	 * @Assert\NotBlank()
	 * @var string 
	 */
	private $validDate;
	
	/**
	 * @ORM\Column(type="string", length=5)
	 * @Assert\Type(type="string")
	 * 
	 * @var string
	 */
	private $tShirtSize;
	
	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
    
	public function __construct()
	{
		$this->notes = new ArrayCollection();
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getMembershipNumber() {
		return $this->membershipNumber;
	}
	
	/**
	 *
	 * @param
	 *        	$membershipNumber
	 */
	public function setMembershipNumber($membershipNumber) {
		$this->membershipNumber = $membershipNumber;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getFirstName() {
		return $this->firstName;
	}
	
	/**
	 *
	 * @param
	 *        	$firstName
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getLastName() {
		return $this->lastName;
	}
	
	/**
	 *
	 * @param
	 *        	$lastName
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getAddress() {
		return $this->address;
	}
	
	/**
	 *
	 * @param
	 *        	$address
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCity() {
		return $this->city;
	}
	
	/**
	 *
	 * @param
	 *        	$city
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getCountry() {
		return $this->country;
	}
	
	/**
	 *
	 * @param
	 *        	$country
	 */
	public function setCountry($country) {
		$this->country = $country;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getBirthDate() {
		return $this->birthDate;
	}
	
	/**
	 *
	 * @param
	 *        	$birthDate
	 */
	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param
	 *        	$email
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getTel() {
		return $this->tel;
	}
	
	/**
	 *
	 * @param
	 *        	$tel
	 */
	public function setTel($tel) {
		$this->tel = $tel;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getJoinDate() {
		return $this->joinDate;
	}
	
	/**
	 *
	 * @param
	 *        	$joinDate
	 */
	public function setJoinDate($joinDate) {
		$this->joinDate = $joinDate;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getValidDate() {
		return $this->validDate;
	}
	
	/**
	 *
	 * @param
	 *        	$validDate
	 */
	public function setValidDate($validDate) {
		$this->validDate = $validDate;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getTShirtSize() {
		return $this->tShirtSize;
	}
	
	/**
	 *
	 * @param
	 *        	$tShirtSize
	 */
	public function setTShirtSize($tShirtSize) {
		$this->tShirtSize = $tShirtSize;
		return $this;
	}
	
	
	/**
	 *
	 * @return ArrayCollection|GenusNote[]
	 */
	public function getNotes() {
		return $this->notes;
	}
	
	
	
	

}