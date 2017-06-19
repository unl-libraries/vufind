<?php
namespace VufindUNL\RecordDriver;

class SolrDefault extends \VuFind\RecordDriver\SolrDefault
{
	
	/**
	 * These Solr fields should be used for snippets if available (listed in order
	 * of preference).
	 *
	 * @var array
	 */
	protected $preferredSnippetFields = [
			'title_alt','contents', 'topic'
	];
/**
	 * Return the value(s) of a solr field without using the marc tags
	 * useful for joined fields
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
			return isset($this->fields['authUsers_str']) ? $this->fields['authUsers_str'] : '';
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