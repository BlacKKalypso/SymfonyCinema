<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nancy
 * Date: 03.04.2019
 * Time: 11:59
 */
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="directedMovies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $director;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", inversedBy="starredMovies")
     */
    private $actors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Showtime", mappedBy="movie_id", orphanRemoval=true)
     */
    private $showtime;

    public function __construct($title, $year)
    {
        $this->setTitle($title);
        $this->setYear($year);

        $this->actors = new ArrayCollection();
        $this->showtime = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDirector(): ?Artist
    {
        return $this->director;
    }

    public function setDirector(?Artist $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Artist $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Artist $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
        }

        return $this;
    }

    /**
     * @return Collection|Projection[]
     */
    public function getshowtime(): Collection
    {
        return $this->showtime;
    }

    public function addProjection(Projection $projection): self
    {
        if (!$this->showtime->contains($projection)) {
            $this->showtime[] = $projection;
            $projection->setMovieId($this);
        }

        return $this;
    }

    public function removeProjection(Projection $projection): self
    {
        if ($this->showtime->contains($projection)) {
            $this->showtime->removeElement($projection);
            // set the owning side to null (unless already changed)
            if ($projection->getMovieId() === $this) {
                $projection->setMovieId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }


}