<?php

namespace VufindUNL\RecordDriver;

class SolrDefault extends \VuFind\RecordDriver\SolrDefault
{

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
        /**
         * Returns one of three things: a full URL to a thumbnail preview of the record
         * if an image is available in an external system; an array of parameters to
         * send to VuFind's internal cover generator if no fixed URL exists; or false
         * if no thumbnail can be generated.
         *
         * @param string $size Size of thumbnail (small, medium or large -- small is
         * default).
         *
         * @return string|array|bool
         */
        public function getThumbnail($size = 'small')
        {
        	if (isset($this->fields['thumbnail']) && $this->fields['thumbnail']) {
        		return $this->fields['thumbnail'];
        	}
        	$arr = [
        			'author'     => mb_substr($this->getPrimaryAuthor(), 0, 300, 'utf-8'),
        			'callnumber' => $this->getCallNumber(),
        			'size'       => $size,
        			'title'      => mb_substr($this->getTitle(), 0, 300, 'utf-8')
        	];
        	if ($isbn = $this->getCleanISBN()) {
        		$arr['isbn'] = $isbn;
        	}
        	if ($issn = $this->getCleanISSN()) {
        		$arr['issn'] = $issn;
        	}
        	if ($oclc = $this->getCleanOCLCNum()) {
        		$arr['oclc'] = $oclc;
        	}
        	if ($upc = $this->getCleanUPC()) {
        		$arr['upc'] = $upc;
        	}
        	// If an ILS driver has injected extra details, check for IDs in there
        	// to fill gaps:
        	if ($ilsDetails = $this->getExtraDetail('ils_details')) {
        		foreach (['isbn', 'issn', 'oclc', 'upc'] as $key) {
        			if (!isset($arr[$key]) && isset($ilsDetails[$key])) {
        				$arr[$key] = $ilsDetails[$key];
        			}
        		}
        	}
        	$formats = $this->getFormats();
        	if (!empty($formats)) {
        		$arr['contenttype'] = $formats[0];
        		#$arr['size'] = 'medium';
        	}
        	return $arr;
        }
}
