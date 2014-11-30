<?php namespace Eliastre100\GroupsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class HireType extends AbstractType
{

	private $userId;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('User', 'entity', array(
        		'class' => 'Eliastre100\UserBundle\Entity\User'))
        	->add('Group', 'entity', array(
        		'class' => 'Eliastre100GroupsBundle:Groups',
        		'property' => 'name',
        		'query_builder' => function(EntityRepository $er) {
			        return $er->createQueryBuilder('u')
			            ->where('u.owner = :id')
    					->setParameter('id', $this->userId);
			    }))
        	->add('Hire', 'submit');
        //$builder->add('dueDate', null, array('widget' => 'single_text'));
    }

    public function getName()
    {
        return 'hire';
    }

    public function __construct($userId){
    	$this->userId = $userId;
    }
}