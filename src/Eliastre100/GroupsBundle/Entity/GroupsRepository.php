<?php

namespace Eliastre100\GroupsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GroupsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GroupsRepository extends EntityRepository
{
	public function getOwnerGroups($userId){
		return $this->findByOwner($userId);
	}

	public function getOwnerGroupsArray($userId){
		$data = $this->getOwnerGroups($userId);
		$return = array();
		foreach ($data as $key => $value) {
			$return[$value->getId()] = $value->getName();
		}
		return $return;
	}

	public function testOwnerGroup($userId, $groupId){
		$return = $this->find($groupId);
		if($return->getOwner()->getId() == $userId){
			return true;
		}else{
			return false;
		}
	}
}
