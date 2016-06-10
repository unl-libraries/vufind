<?php

namespace VufindUNL\RecordDriver;

class SolrMarc extends \VuFind\RecordDriver\SolrMarc
{
	/**
	 * Get an array of alternate titles for the record.
	 *
	 * @return array
	 */
	public function getAltTitles()
	{
		// This is all the collected data:
		$retval = [];
	
		$retval = array_merge($retval,$this->getFieldArray('100', ['t'], false));
	
		$retval = array_merge($retval,$this->getFieldArray('130', ['a','d','f','g','k','l','n','p','s','t']));
		$retval = array_merge($retval,$this->getFieldArray('240', ['a'], false));
		$retval = array_merge($retval,$this->getFieldArray('246', ['a'], false));
	
		//$retval = array_merge($retval,$this->getFieldArray('505', ['t'], false));
	
		$retval = array_merge($retval,$this->getFieldArray('700', ['t'], false));
		$retval = array_merge($retval,$this->getFieldArray('710', ['t'], false));
		$retval = array_merge($retval,$this->getFieldArray('711', ['t'], false));
	
		$retval = array_merge($retval,$this->getFieldArray('730', ['a','d','f','g','k','l','n','p','s','t']));
		$retval = array_merge($retval,$this->getFieldArray('740', ['a'], false));
		// Remove duplicates and then send back everything we collected:
		return array_map(
				'unserialize', array_unique(array_map('serialize', $retval))
				);
	}

	
	
}

