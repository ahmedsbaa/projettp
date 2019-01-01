<?php

namespace AppBundle\Repository;

class LivreRepository extends \Doctrine\ORM\EntityRepository
{

	public function AuteurBooks($id)
	{
	    $rawSql = "SELECT * from livre where livre.auteur_id = $id";

	    $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
	    $stmt->execute([]);

	    return $stmt->fetchAll();
	}
}
