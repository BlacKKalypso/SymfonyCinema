<?php

namespace App\DataFixtures;

use App\Entity\Room;
use App\Repository\CinemaRepository;
use App\Repository\MovieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository, CinemaRepository $cinemaRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->cinemaRepository = $cinemaRepository;
    }

    private function getRandomMovies($nb){
        $moviesTitle = $this->movieRepository->findAll();
        shuffle($moviesTitle);
        return array_slice($moviesTitle, 0, $nb);
    }

    public function load(ObjectManager $manager)
    {
        $cinemas = $this->cinemaRepository->findAll();

        foreach($cinemas as $cinema){
            for($i = 1; $i<=15; $i++) {
                $room = new Room();
                $room->setRoomNum($i);
                $room->setCinema($cinema);
                $room->setAirConditioned(rand(0,1));
                $room->setCapacity(rand(300, 600));
                $manager->persist($room);
            }

        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
