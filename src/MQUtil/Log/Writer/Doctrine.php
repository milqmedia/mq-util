<?php

namespace MQUtil\Log\Writer;

use Zend\Log\Writer\AbstractWriter;

class Doctrine extends AbstractWriter
{
    protected $em;

    public function __construct($doctrineEntityManager)
    {
        $this->em = $doctrineEntityManager;
    }
    
    protected function doWrite(array $event)
    {
    	$entity = new \Application\Entity\System\Log();
    	
    	$entity->setPriority($event['priority']);
    	$entity->setMessage($event['message']);
    	$entity->setCreateDate($event['timestamp']);
    	
    	$this->em->persist($entity);
    	$this->em->flush();
    	
    	return $entity;
    }
}
