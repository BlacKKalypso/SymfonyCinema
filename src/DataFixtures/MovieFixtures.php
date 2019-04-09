<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    private $artistRepository;

    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    private function getRandomArtists($nb){
        $artists = $this->artistRepository->findAll();
        shuffle($artists);
        return array_slice($artists, 0, $nb);
    }

    private  function getRandomArtist() : ?Artist {
        $artists = $this->getRandomArtists(1);

        return $artists[0] ?? null;
    }
    public function load(ObjectManager $manager)
    {
        $movies = [
          ["Mad Max: Fury Road", 2015],
          ["Kill Bill: Vol. 1", 2003],
          ["Memoirs of a Geisha", 2003],
          ["Mamá", 2013],
          ["The Conjuring", 2013],
          ["What Happened to Monday", 2017],
          ["Sweeney Todd: The Demon Barber of Fleet Street", 2007],
          ["Beetjuice", 1988],
          ["Us", 2019]
        ];

        foreach ($movies as $movie){
            $movie =new Movie($movie[0],$movie[1]);

            $director = $this->getRandomArtist();
            $movie->setDirector($director);

            $nbActors = rand(1, 10);
            $actors = $this->getRandomArtists($nbActors);
            foreach ($actors as $actor){
                $movie->addActor($actor);
            }
            $manager->persist($movie);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ArtistFixtures::class,
        );
    }
}
