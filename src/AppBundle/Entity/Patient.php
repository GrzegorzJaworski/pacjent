<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Jaworski
 * Date: 18.03.2018
 * Time: 21:18
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="patient")
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     * @Assert\Length(
     *      min = 11,
     *      max = 11,
     *      minMessage = "PESEL must be {{ limit }} characters long",
     *      maxMessage = "PESEL must be {{ limit }} characters long"
     * )
     */
    private $pesel;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDay;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $patientId;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 6,
     *      max = 6,
     *      minMessage = "Zip code must be {{ limit }} characters long",
     *      maxMessage = "Zip code must be {{ limit }} characters long"
     * )
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDelte = false;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Packet", inversedBy="patients", orphanRemoval=true, cascade={"persist"})
     */
    private $packets;

    public function __construct()
    {
        $this->packets = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * @param mixed $pesel
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;
    }

    /**
     * @return mixed
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param mixed $birthDay
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
    }

    /**
     * @return mixed
     */
    public function getPatientId()
    {
        return $this->patientId;
    }

    /**
     * @param mixed $patientId
     */
    public function setPatientId($patientId)
    {
        $this->patientId = $patientId;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getisDelte()
    {
        return $this->isDelte;
    }

    /**
     * @param mixed $isDelte
     */
    public function setIsDelte($isDelte)
    {
        $this->isDelte = $isDelte;
    }

    /**
     * @return ArrayCollection|Packet
     */
    public function getPackets()
    {
        return $this->packets;
    }

    /**
     * @param mixed $packets
     */
    public function setPackets($packets)
    {
        $this->packets = $packets;
    }

    /**
     * @param Packet $packet
     */
    public function addPacket(Packet $packet)
    {
        $packet->addPatient($this);
        $this->packets[] = $packet;
    }

    public function removePacket(Packet $packet)
    {
        $this->packets->removeElement($packet);
        $packet->removePatient($this);
    }
}