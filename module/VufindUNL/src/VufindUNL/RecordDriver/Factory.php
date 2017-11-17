<?php

namespace VufindUNL\RecordDriver;
use \Zend\ServiceManager\ServiceManager;

class Factory
{

	/**
	 * Factory for SolrDefault record driver.
	 *
	 * @param ServiceManager $sm Service manager.
	 *
	 * @return SolrDefault
	 */
	public static function getSolrDefault(ServiceManager $sm)
	{
		$driver = new \VufindUNL\RecordDriver\SolrDefault(
				$sm->getServiceLocator()->get('VuFind\Config')->get('config'),
				null,
				$sm->getServiceLocator()->get('VuFind\Config')->get('searches')
				);
		$driver->attachSearchService($sm->getServiceLocator()->get('VuFind\Search'));
		return $driver;
	}
	
    /**
     * Factory for SolrMarc record driver.
     * 
     * @param ServiceManager $sm Service manager.
     * 
     * @return SolrMarc
     */
    public static function getSolrMarc(ServiceManager $sm)
    {
        $driver = new \VufindUNL\RecordDriver\SolrMarc(
            $sm->getServiceLocator()->get('VuFind\Config')->get('config'),
            null,
            $sm->getServiceLocator()->get('VuFind\Config')->get('searches')
        );
        $driver->attachILS(
            $sm->getServiceLocator()->get('VuFind\ILSConnection'),
            $sm->getServiceLocator()->get('VuFind\ILSHoldLogic'),
            $sm->getServiceLocator()->get('VuFind\ILSTitleHoldLogic')
        );
        $driver->attachSearchService($sm->getServiceLocator()->get('VuFind\Search'));
        return $driver;
    }


    /**
     * Factory for EIT record driver.
     *
     * @param ServiceManager $sm Service manager.
     *
     * @return EIT
     */
    public static function getEIT(ServiceManager $sm)
    {
        $eit = $sm->getServiceLocator()->get('VuFind\Config')->get('EIT');
        return new \VufindUNL\RecordDriver\EIT(
            $sm->getServiceLocator()->get('VuFind\Config')->get('config'), $eit, $eit
        );
    }


}

