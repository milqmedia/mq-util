<?php
	
namespace MQUtil\Service;

class Iterator
{
	private $iterator;
	
	public function getIterator($array, $currentPage) {

		$this->iterator = new \ArrayIterator($array);		
		$this->iterator->seek($currentPage);
					
		return $this;
	}
	
	public function hasNext() {
		
		$nextKey = $this->iterator->key() + 1;	
		
		return $this->iterator->offsetExists($nextKey);
	}
	
	public function nextItem() {
		
		$this->iterator->next();
		
		if($this->iterator->valid()) {
			$this->iterator->next();
			return $this->iterator->current();
		} else
			return false;
	}
	
	public function hasPrev() {
		
		$prevKey = $this->iterator->key() - 1;	
		
		return $this->iterator->offsetExists($prevKey);
	}
		
	public function prevItem() {
	
		$prevKey = $this->iterator->key() - 1;	
		
		if($this->iterator->offsetExists($prevKey)) {
			$this->iterator->seek($prevKey);
			return $this->iterator->current();	
		} else 
			return false;
	}
	
	public function currentItem() {
		
		return $this->iterator->current();
	}
	
	public function isLastItem() {
		
		return $this->iterator->valid();
	}
}