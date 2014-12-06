<?php namespace Eliastre100\GroupsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class DeleteType extends AbstractType
{

	private $userId;
    private $action;
    private $name;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($this->action)
        	->add('Group', 'entity', array(
        		'class' => 'Eliastre100GroupsBundle:Groups',
        		'property' => 'name',
        		'query_builder' => function(EntityRepository $er) {
			        return $er->createQueryBuilder('u')
			            ->where('u.owner = :id')
    					->setParameter('id', $this->userId);
			    }))
        	->add($this->name, 'submit');
        //$builder->add('dueDate', null, array('widget' => 'single_text'));
    }

    public function getName()
    {
        return 'Delete';
    }

    public function __construct($userId, $action, $name = 'Delete'){
    	$this->userId = $userId;
        $this->action = $action;
        $this->name = $name;
    }
}