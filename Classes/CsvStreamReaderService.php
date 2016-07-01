<?php
namespace Gressus\Tools;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016
 *  All rights reserved
 *
 *  GRESSUS
 *
 * @category Gressus
 * @package Gressus_Tools
 ***************************************************************/


/**
 * Csv Service
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class CsvStreamReaderService {

	protected $fileHandle;
	protected $csvOptions = array(
		'delimiter' => ',',
		'enclosure' => '"',
	);

	protected $headerColumn = array();

	public function init($fileName,$csvOptions = null,$headerColumn = null){
		if(!file_exists($fileName)){
			throw new \Exception('File '.$fileName.' does not exist');
		}
		if(null !== $csvOptions){
			$this->csvOptions = $csvOptions;
		}

		$this->fileHandle = fopen($fileName, "r");
		if ($this->fileHandle === FALSE) {
			throw new \Exception('No Handle');
		}
		if(is_array($headerColumn)){
			$this->headerColumn = $headerColumn;

		}else{
			$this->headerColumn =  fgetcsv($this->fileHandle, 0, $this->csvOptions['delimiter'], $this->csvOptions['enclosure']);
		}
	}

	public function getRow(){
		$columnData = fgetcsv($this->fileHandle, 0, $this->csvOptions['delimiter'], $this->csvOptions['enclosure']);
		return $columnData;
	}

}