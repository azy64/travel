<?php

namespace App\DataFixtures;

use App\Entity\Transport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeTransport extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $lib = ['Car', 'Plan', 'Bus', 'Tain','Boat'];
        $prefix = 'SK';
        foreach ($lib as $value) {
            $type = new \App\Entity\TypeTransport();
            $type->setLibelle($value);
            $manager->persist($type);
        }
        $manager->flush();
        $rep = $manager->getRepository(\App\Entity\TypeTransport::class)->findAll();
        for($i=0;$i<12;$i++){
            $trans = new Transport();
            $trans->setNumber($prefix.$i);
            $t = $rep[rand(0,count($rep)-1)];
            $trans->setTypeTransport($t);
            $manager->persist($trans);
        }

        $manager->flush();
    }
}
