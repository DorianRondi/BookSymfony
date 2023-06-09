<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager): void
    {
        $singe = new Book();
        $singe->setTitle("La planète des singes");
        $singe->setDescription("Ce roman de science-fiction est peut-être l'œuvre la plus connue de Pierre Boule. Il y décrit une société dominée par les singes, où les humains sont réduits en esclavage.");
        $singe->setAuthor($this->getReference(AuthorFixtures::PIERRE_BOULE));
        $manager->persist($singe);

        $kwai = new Book();
        $kwai->setTitle("Le pont de la rivière Kwaï");
        $kwai->setDescription("Ce célèbre roman a été adapté en un film oscarisé. Il relate l'histoire des prisonniers de guerre britanniques qui construisent un pont pour les Japonais en Birmanie pendant la Seconde Guerre mondiale.");
        $kwai->setAuthor($this->getReference(AuthorFixtures::PIERRE_BOULE));
        $manager->persist($kwai);

        $tragedie = new Book();
        $tragedie->setTitle("La naissance de la tragédie");
        $tragedie->setDescription("Dans cet ouvrage, Nietzsche explore le concept de la tragédie grecque et son rôle dans la culture grecque antique.");
        $tragedie->setAuthor($this->getReference(AuthorFixtures::FRIEDRICH_NIETZSCHE));
        $manager->persist($tragedie);

        $zara = new Book();
        $zara->setTitle("Ainsi parlait Zarathoustra");
        $zara->setDescription("Ce livre emblématique présente les idées centrales de Nietzsche à travers les discours d'un prophète fictif, Zarathoustra.");
        $zara->setAuthor($this->getReference(AuthorFixtures::FRIEDRICH_NIETZSCHE));
        $manager->persist($zara);

        $gai = new Book();
        $gai->setTitle("Le gai savoir");
        $gai->setDescription("Ce livre contient une série de courts aphorismes dans lesquels Nietzsche aborde divers sujets tels que la mort de Dieu, l'éternel retour et la volonté de puissance.");
        $gai->setAuthor($this->getReference(AuthorFixtures::FRIEDRICH_NIETZSCHE));
        $manager->persist($gai);

        $humain = new Book();
        $humain->setTitle("Humain, trop humain");
        $humain->setDescription("Cet ouvrage marque une transition dans la pensée de Nietzsche, avec une approche plus sceptique et critique de la morale et des idéaux.");
        $humain->setAuthor($this->getReference(AuthorFixtures::FRIEDRICH_NIETZSCHE));
        $manager->persist($humain);

        $antechrist = new Book();
        $antechrist->setTitle("L'Antéchrist");
        $antechrist->setDescription("Cet ouvrage constitue une critique virulente du christianisme et présente la vision de Nietzsche pour un nouvel idéal philosophique.");
        $antechrist->setAuthor($this->getReference(AuthorFixtures::FRIEDRICH_NIETZSCHE));
        $manager->persist($antechrist);

        $precieuses = new Book();
        $precieuses->setTitle("Les précieuses ridicules");
        $precieuses->setDescription("Cette comédie satirique met en scène deux jeunes femmes prétentieuses et ridicules qui se font piéger par deux hommes.");
        $precieuses->setAuthor($this->getReference(AuthorFixtures::MOLIERE));
        $manager->persist($precieuses);

        $sganarelle = new Book();
        $sganarelle->setTitle("Sganarelle ou Le Cocu imaginaire");
        $sganarelle->setDescription("Cette farce met en scène le personnage de Sganarelle, un mari jaloux qui se découvre cocu imaginaire.");
        $sganarelle->setAuthor($this->getReference(AuthorFixtures::MOLIERE));
        $manager->persist($sganarelle);

        $malade = new Book();
        $malade->setTitle("Le malade imaginaire");
        $malade->setDescription("Cette comédie est la dernière pièce de Molière. Elle met en scène le personnage d'Argan, un homme hypocondriaque, et parodie le milieu médical de l'époque.");
        $malade->setAuthor($this->getReference(AuthorFixtures::MOLIERE));
        $manager->persist($malade);

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            AuthorFixtures::class
        ];
    }
}