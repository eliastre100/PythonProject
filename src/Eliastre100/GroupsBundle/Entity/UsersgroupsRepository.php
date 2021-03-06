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

    public function getAllIdGroupsFromUserArray($id){
        $groups = $this->getAllIdGroupsFromUser($id);
        $groupsRepo = $this->_em->getRepository('Eliastre100GroupsBundle:Groups');
        $groupsArray = array();
        foreach ($groups as $k => $v) {
            $groupsArray[$v->getGroupId()] = $groupsRepo->findById($v->getGroupId())[0]->getName(); 
        }
        return $groupsArray;
    }

	public function isIfInGroup($userId, $groupId){
		$return = $this->createQueryBuilder('p')
    		->where('p.groupId = :groupid')
    			->setParameter('groupid', $groupId)
    		->andWhere('p.userId = :userid')
    			->setParameter('userid', $userId)
    		->getQuery()
    		->getResult();
    	if(empty($return['0'])){
    		return false;
    	}else{
    		return true;
    	}
	}

    public function userInGroup($userId, $groupId){
        return $this->createQueryBuilder('p')
            ->where('p.groupId = :groupid')
                ->setParameter('groupid', $groupId)
            ->andWhere('p.userId = :userid')
                ->setParameter('userid', $userId)
            ->getQuery()
            ->getResult();
    }

    public function userFromGroup($groupId){
        return $this->createQueryBuilder('p')
            ->where('p.groupId = :groupid')
                ->setParameter('groupid', $groupId)
            ->getQuery()
            ->getResult();
    }
}
