<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public const PIERRE_BOULE = "PIERRE_BOULE";
    public const MOLIERE = "MOLIERE";
    public const FRIEDRICH_NIETZSCHE = "FRIEDRICH_NIETZSCHE";

    public function load(ObjectManager $manager): void
    {
        $pb = new Author();
        $pb->setName("Pierre Boule");
        $this->addReference(self::PIERRE_BOULE,$pb);
        $manager->persist($pb);

        $jbp = new Author();
        $jbp->setName('Jean-Baptiste Poquelin "Molière"');
        $this->addReference(self::MOLIERE,$jbp);
        $manager->persist($jbp);

        $fn = new Author();
        $fn->setName("Friedrich Nietzsche");
        $this->addReference(self::FRIEDRICH_NIETZSCHE,$fn);
        $manager->persist($fn);

        $manager->flush();
    }
}
