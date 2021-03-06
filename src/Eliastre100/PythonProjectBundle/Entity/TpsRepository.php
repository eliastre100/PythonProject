<?php

namespace Eliastre100\PythonProjectBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Eliastre100\GroupsBundle\Entity;

class TpsRepository extends EntityRepository
{
	public function getAllGroupTps($user){
		$groupsSearch = $this->_em->getRepository('Eliastre100GroupsBundle:Usersgroups');
		$groups = $this->_em->getRepository('Eliastre100GroupsBundle:Groups');
		
		$groupesIds = $groupsSearch->getAllIdGroupsFromUser($user->getid());

		$return = array();
		foreach ($groupesIds as $key => $value) {
			$title = $groups->findById($value->getGroupId());
			$return[] = array('id' => $value->getGroupId(),
				'name' => $title['0']->getName());
		}

		return $return;
	}

	public function getGroupsFromUser($user){
		$groupsSearch = $this->_em->getRepository('Eliastre100GroupsBundle:Usersgroups');
		$groups = $this->_em->getRepository('Eliastre100GroupsBundle:Groups');
		$Tps = $this->_em->getRepository('Eliastre100PythonProjectBundle:Tps');
		$groupesIds = $groupsSearch->getAllIdGroupsFromUser($user->getid());

		foreach ($groupesIds as $key => $value) {
			$tps = $this->findByGroupe($value->getGroupId());
			$return[$value->getGroupId()] = $Tps;
		}
		return $return;
	}
}