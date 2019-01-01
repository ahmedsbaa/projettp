<?php
namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Livre;
use AppBundle\Entity\Auteur;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
class LoadFixtures implements FixtureInterface

{
	public function load(ObjectManager $manager)

	{
		for ($i = 0; $i < 20; $i++) {
			$Livre = new Livre();
			$Livre->setTitre('ahmed'.$i); 
			$Livre->setDescriptif('bns'.$i);
			$Livre->setISBN('testFixture'.$i);
			$Livre->setDateedition(new \DateTime());
			$manager->persist($Livre);
			//auteuuuuuuuuur
			$Auteur = new Auteur();
			$Auteur->setNom('auteur'.$i); 
			$Auteur->setEmail('ahmedbns@gmail.com'.$i);
			$manager->persist($Auteur);
		}
		$manager->flush();
	}


}