<?php
namespace VufindUNL\View\Helper\Root;

/**
For future use: we will want to add a WAMproxy config to the config.ini and
then the following may work.
//         if (isset($this->config->WAMproxy->host)) {
//         	//real url is http://search.proquest.com/publication/34945 or http://somesite:port#/otherurlparams
//         	//when proxied we want http://0-search.proquest.com.library.unl.edu/publication/34945
//         	// some are stored already with the proxy information, so we need to check that
//         	if (preg_match('/'.$this->config->WAMproxy->host.'/',$url)) return $url;
//             else {
//             	//get the host and port from the url
//             	$url = 'http://'.(isset($port)?$port:'0').'-'.$host.$this->config->WAMproxy->host . $restofurl;
//             }
//         }
 */
class ProxyUrl extends \VuFind\View\Helper\Root\ProxyUrl
{

    /**
     * Apply proxy prefix to URL (if configured).
     *
     * @param string $url The raw URL to adjust
     *
     * @return string
     */
    public function __invoke($url)
    {

        $url=preg_replace('/\d*-(.+)\.library\.unl\.edu(.*)/','$1$2',$url);
        return $url;
    }
}


