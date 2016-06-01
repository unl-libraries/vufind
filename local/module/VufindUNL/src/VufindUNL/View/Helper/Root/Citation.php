<?php

namespace VufindUNL\View\Helper\Root;

class Citation extends \VuFind\View\Helper\Root\Citation
{
        
    /**
     * Get Harvard citation.
     *
     * This function assigns all the necessary variables and then returns a Harvard
     * citation. 
     *
     * @return string
     */
    public function getCitationHarvard()
    {
    	$harvard = [
    			'title' => $this->getAPATitle(),
    			'authors' => $this->getAPAAuthors()
    	];
    	
    
    	// Behave differently for books vs. journals:
    	$partial = $this->getView()->plugin('partial');
    	if (empty($this->details['journal'])) {
    		$harvard['publisher'] = $this->getPublisher();
    		$harvard['year'] = $this->getYear();
    		return $partial('Citation/harvard.phtml', $harvard);
    	} else {
    		// Add other journal-specific details:
    		$harvard['pageRange'] = $this->getPageRange();
    		$harvard['journal'] =  $this->capitalizeTitle($this->details['journal']);
    		$harvard['year'] = $this->getYear();
    		$harvard['volumeAndNo'] = $this->getMLANumberAndDate($volNumSeparator);
    		return $partial('Citation/harvard-article.phtml', $harvard);
    	}
    }
    
    /**
     * Construct volume and numbering for Harvard citation style
     * 
     * @return $string
     */
    protected function getVolNumber(){
    	$vol = $this->driver->tryMethod('getContainerVolume');
    	$num = $this->driver->tryMethod('getContainerIssue');
    	if (!empty($vol) && !empty($num)){
    		//vol. 58, no. 2
    		return $volNum = "vol. ".$vol.", "."no. ".$num;
    	}
    	elseif(!empty($vol)) return "vol. ".$vol;
    	elseif (!empty($num)) return "no. ".$num;
    	else return "";
    }

  }
