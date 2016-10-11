<?php
return array(
    'extends' => 'bootprint3',
   'helpers' => array(
        'factories' => array(
            'citation' => 'VufindUNL\View\Helper\Root\Factory::getCitation',
        	'proxyurl' => 'VufindUNL\View\Helper\Root\Factory::getProxyUrl',
	)
    )
);
