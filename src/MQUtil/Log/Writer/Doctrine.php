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
		
		$reportId = explode(':', $event['message']);
		
    	$entity->setReportId($event['message']);
    	$entity->setUserId($reportId[0]);
    	$entity->setPriority($event['priority']);
    	$entity->setMessage(serialize($event['extra']));
    	$entity->setCreateDate($event['timestamp']);
    	
    	$this->em->persist($entity);
    	$this->em->flush();
    }
}
