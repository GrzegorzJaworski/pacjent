<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Jaworski
 * Date: 18.03.2018
 * Time: 21:24
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="packet")
 */
class Packet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PacketType")
     */
    private $packetType;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $end;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Patient", mappedBy="packets")
     */
    private $patients;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Packet
     */
    public function getPacketType()
    {
        return $this->packetType;
    }

    /**
     * @param PacketType $packetType
     */
    public function setPacketType(PacketType $packetType)
    {
        $this->packetType = $packetType;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return ArrayCollection|Patient
     */
    public function getPatients()
    {
        return $this->patients;
    }

    /**
     * @param Patient $patient
     */
    public function addPatient(Patient $patient)
    {
        $this->patients[] = $patient;
    }

    public function removePatient(Patient $patient)
    {
        $this->patients->removeElement($patient);
        $patient->setPackets(null);
    }
}