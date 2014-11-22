<?php

namespace Eliastre100\GroupsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Users_groupsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersgroupsRepository extends EntityRepository
{
	public function getAllIdGroupsFromUser($id){
		return $this->findByUserId($id); //Return ID of all groups for a special user 
	}
}
