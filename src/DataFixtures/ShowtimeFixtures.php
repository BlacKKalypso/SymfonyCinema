<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Room;
use App\Entity\Showtime;
use App\Repository\MovieRepository;
use App\Repository\RoomRepository;

class ShowtimeFixtures extends Fixture implements DependentFixtureInterface
{
    private $movieRepository;
    private $roomRepository;

    public function __construct(MovieRepository $movieRepository, RoomRepository $roomRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->roomRepository = $roomRepository;
    }

    private function getRandomMovies($nb)
    {
        $movie=$this->movieRepository->findAll();
        shuffle($movie);

        return array_slice($movie, 0, $nb);
    }

    private function getRandomMovie(): ?Movie
    {
        $movies=$this->getRandomMovies(1);

        return $movies[0] ?? null;
    }

    ////////////
    // CINEMA //
    ////////////

    private function getRandomRooms($nb)
    {
        $rooms=$this->roomRepository->findAll();
        shuffle($rooms);

        return array_slice($rooms, 0, $nb);
    }

    private function getRandomRoom(): ?Room
    {
        $room=$this->getRandomRooms(1);
        return $room[0] ?? null;
    }

    ///////////
    // hour //
    ///////////

    private function getRandomHour()
    {
        $randomHour = 0;
        $randomHourBeg = $randomHour.rand(8, 22);
        $randomhourEnd = $randomHourBeg + rand(1,3);

        $randomHours = [(int)$randomHourBeg, (int)$randomhourEnd];
        return $randomHours;
    }


    ///////////
    //       //
    ///////////

    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <= 5 ; $i++){

            $showtime = new showtime();

            $randomMovie = $this -> getRandommovie();
            $showtime -> setIdMovie($randomMovie);

            $randomRoom = $this -> getRandomroom();
            $showtime -> setRoomNum($randomRoom);

            list($randomHourStart, $randomHourEnd) = $this -> getRandomhour();
            $showtime -> setBegin($randomHourStart);
            $showtime -> setEnd($randomHourEnd);


            $manager -> persist($showtime);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            MovieFixtures::class,
        );
    }
}
