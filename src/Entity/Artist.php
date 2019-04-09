<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *  min = 1900,
     *  max = 2050,
     *  minMessage ="Must be born after {{ limit }}",
     *  maxMessage ="Must be born before {{limit}}"
     * )
     */
    private $birthsDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Movie", mappedBy="director", orphanRemoval=true)
     */
    private $directedMovies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movie", mappedBy="actors")
     */
    private $starredMovies;


    /**
     * Artist constructor.
     * @param $lastName
     * @param $firstName
     */
    public function __construct($lastName=null, $firstName=null)
    {
        //Sert pour les champsd de base dont j'ai besoin
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->directedMovies = new ArrayCollection();
        $this->starredMovies = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthsDate(): ?int
    {
        return $this->birthsDate;
    }

    public function setBirthsDate(int $birthsDate): self
    {
        $this->birthsDate = $birthsDate;

        return $this;
    }

    /**
     * @return Collection|Cinema[]
     */
    public function getDirectedMovies(): Collection
    {
        return $this->directedMovies;
    }

    public function addDirectedMovie(Cinema $directedMovie): self
    {
        if (!$this->directedMovies->contains($directedMovie)) {
            $this->directedMovies[] = $directedMovie;
            $directedMovie->setDirector($this);
        }

        return $this;
    }

    public function removeDirectedMovie(Cinema $directedMovie): self
    {
        if ($this->directedMovies->contains($directedMovie)) {
            $this->directedMovies->removeElement($directedMovie);
            // set the owning side to null (unless already changed)
            if ($directedMovie->getDirector() === $this) {
                $directedMovie->setDirector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cinema[]
     */
    public function getStarredMovies(): Collection
    {
        return $this->starredMovies;
    }

    public function addStarredMovie(Cinema $starredMovie): self
    {
        if (!$this->starredMovies->contains($starredMovie)) {
            $this->starredMovies[] = $starredMovie;
            $starredMovie->addActor($this);
        }

        return $this;
    }

    public function removeStarredMovie(Cinema $starredMovie): self
    {
        if ($this->starredMovies->contains($starredMovie)) {
            $this->starredMovies->removeElement($starredMovie);
            $starredMovie->removeActor($this);
        }

        return $this;
    }
}
