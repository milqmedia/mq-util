<?php
	
namespace MQUtil\Service;

class Paginator 
{
	private $data;
	private $totalRows = 0;
	private $rowsPerPage = 30;
	private $currentPage = 1;
	
	public function getPaginator($totalRows, $rowsPerPage, $currentPage) {
		
		$this->totalRows = $totalRows;
		$this->rowsPerPage = $rowsPerPage;
		$this->currentPage = $currentPage;
		
		$this->setData($this->pagingInfo());

		return $this;
	}
	
	public function pagingInfo()
	{
	    $pages = ceil($this->totalRows / $this->rowsPerPage); // calc pages
	
		$start = ($this->currentPage * $this->rowsPerPage) - $this->rowsPerPage;
		
	    $data = array(); 
	    $data['start']  = ($start < 0) ? 0 : $start;
	    $data['end']	= $this->rowsPerPage;
	    $data['total']  = $pages;                   
	    $data['page'] 	= $this->currentPage;               
	
	    return $data;	
	}
	
	public function setData($data) {
		
		$this->data = $data;
	}
	
	public function next() {
		
		return ($this->data['page'] < $this->data['total']) ? $this->data['page'] + 1 : false;
	}
	
	public function prev() {
		
		return ($this->data['page'] > 1) ? $this->data['page'] - 1 : false;
	}
	
	public function current() {
		
		return $this->data['page'];
	}
	
	public function total() {
		
		return $this->data['total'];
	}
	
	public function offsetStart() {
		
		return $this->data['start'];
	}
	
	public function isLastPage() {
		
		return ($this->data['page'] == $this->data['total']);
	}
}