<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowtimeRepository")
 */
class Showtime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\movie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $movieName;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Room", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $room_num;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Movie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_movie;

    /**
     * @ORM\Column(type="integer")
     */
    private $begin;

    /**
     * @ORM\Column(type="time")
     */
    private $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getmovieName(): ?Cinema
    {
        return $this->movieName;
    }

    public function setmovieName(Cinema $movieName): self
    {
        $this->movieName = $movieName;

        return $this;
    }

    public function getRoomNum(): ?Room
    {
        return $this->room_num;
    }

    public function setRoomNum(Room $room_num): self
    {
        $this->room_num = $room_num;

        return $this;
    }

    public function getIdMovie(): ?Cinema
    {
        return $this->id_movie;
    }

    public function setIdMovie(Movie $id_movie): self
    {
        $this->id_movie = $id_movie;

        return $this;
    }

    public function getBegin(): ?int
    {
        return $this->begin;
    }

    public function setBegin(int $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }
}
