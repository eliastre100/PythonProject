<?php namespace Eliastre100\GroupsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class LeftType extends AbstractType
{

	private $userId;
    private $action;
    private $_em;
    private $name;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($this->action)
        	->add('Group', 'choice', array(
                'choices'   => $this->_em->getAllIdGroupsFromUserArray($this->userId)))
        	->add($this->name, 'submit');
        //$builder->add('dueDate', null, array('widget' => 'single_text'));
    }

    public function getName()
    {
        return 'hire';
    }

    public function __construct($userId, $action, $em_groupsuser, $name = 'Hire'){
    	$this->userId = $userId;
        $this->action = $action;
        $this->_em = $em_groupsuser;
        $this->name = $name;
    }
}