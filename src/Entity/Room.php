<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomNum;

    /**
     * @ORM\Column(type="integer", nullable= true)
     */
    private $airConditioned;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cinema", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cinema;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNum(): ?int
    {
        return $this->roomNum;
    }

    public function setRoomNum(int $roomNum): self
    {
        $this->roomNum = $roomNum;

        return $this;
    }

    public function getAirConditioned(): ?int
    {
        return $this->airConditioned;
    }

    public function setAirConditioned(int $airConditioned): self
    {
        $this->airConditioned = $airConditioned;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCinema(): ?Cinema
    {
        return $this->cinema;
    }

    public function setCinema(?Cinema $cinema): self
    {
        $this->cinema = $cinema;

        return $this;
    }
}
