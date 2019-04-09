<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artists = [
            ["Woody", "Allen"],
            ["Burton", "Tim"],
            ["Douglas", "Micheal"],
            ["Nicholson", "Jack"],
            ["Deep", "Johnny"],
            ["Bonham Carter", "helena"],
            ["Green", "eva"],
            ["Rapace", "Noomi"],
            ["Botet", "Javier"],
            ["Wan", "James"],
            ["Hiddleston", "Tom"],
            ["Muschietti", "Andy"],
            ["Marshall", "Rob"],
            ["Zhang", "Ziyi"],
            ["Tarantino", "Quentin"],
            ["Thurman", "Uma"],
            ["Willis", "Bruce"],
            ["Miller", "George"],
            ["Hardy", "Tom"],
            ["Theron", "Charlize"],
            ["Taylor", "Aaron"]
        ];

        foreach ($artists as $artist) {
            $artist = new Artist($artist[0], $artist[1]);
            $artist->setBirthsDate(rand(1950, 2000));
            $manager->persist($artist);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
