<?php

namespace App\DataFixtures;

use App\Entity\Cinema;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CinemaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cinemas = [
            ["Rialtos","Place de Cornavin 1, 1205 Genève"],
            ["Rex","None"],
            ["Balexert","Av. Louis-Casaï 27, 1211 Genève"],
            ["Bio","Rue Saint-Joseph 47, 1227 Carouge"],
            ["Chez moi à matter Netflix","Ch. Nicolas-Bigueret 22, 1219 Aïre"]
        ];

        foreach($cinemas as $cinema){
            /*
            $cinema =  new Cinema();
           $cinema->setName($cinemaName);
            */
            $manager->persist(new Cinema($cinema[0],$cinema[1]));
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
