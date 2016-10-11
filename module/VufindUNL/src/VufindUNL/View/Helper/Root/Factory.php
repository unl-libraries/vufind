<?php

namespace VufindUNL\View\Helper\Root;

use Zend\ServiceManager\ServiceManager;
class Factory
{
    
    /**
     * Construct the Citation helper.
     *
     * @param ServiceManager $sm Service manager.
     *
     * @return Citation
     */
    public static function getCitation(ServiceManager $sm)
    {
        return new Citation($sm->getServiceLocator()->get('VuFind\DateConverter'));
    }

    /**
     * Construct the ProxyUrl helper.
     *
     * @param ServiceManager $sm Service manager.
     *
     * @return ProxyUrl
     */
    public static function getProxyUrl(ServiceManager $sm)
    {
    	return new ProxyUrl(
    			$sm->getServiceLocator()->get('VuFind\Config')->get('config')
    			);
    }
}
