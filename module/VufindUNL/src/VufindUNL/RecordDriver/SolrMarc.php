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

	/**
	 * Return the value(s) of a solr field
	 * @return array
	 * 
	 */
	public function getSolrField($fieldName){
		return isset($this->fields[$fieldName])?$this->fields[$fieldName]:[];
	}
	
		/**
		 * Get general public notes on the record.
		 *
		 * @return array
		 */
		public function getPublicNotes()
		{
			// Not currently stored in the Solr index
			// except for eresources - custom VufindUNL
			return isset($this->fields['publicNote_str_mv']) ? $this->fields['publicNote_str_mv'] : [];
	
		}
	
		/**
		 * Get the Authorized users information as a string
		 * Part of custom module VufindUNL
		 * @return string
		 *
		 */
		public function getAuthorizedUserNote()
		{
			return (isset($this->fields['authUsers_str'])) ? $this->fields['authUsers_str'] : '';
		}
	
		/**
		 * Get an array of strings representing citation formats supported
		 * by this record's data (empty if none).  For possible legal values,
		 * see /application/themes/root/helpers/Citation.php, getCitation()
		 * method.
		 *
		 * @return array Strings representing citation formats.
		 */
		protected function getSupportedCitationFormats()
		{
			return ['APA', 'Chicago', 'MLA', 'Harvard'];
		}
		
	
	
	
}

