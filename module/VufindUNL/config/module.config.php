<?php

return array (
  'vufind' => 
  array (
    'plugin_managers' => 
    array (
      'recorddriver' => 
      array (
        'factories' => 
        array (
           'solrdefault' =>'VufindUNL\\RecordDriver\\Factory::getSolrDefault',
          'solrmarc' => 'VufindUNL\\RecordDriver\\Factory::getSolrMarc',          
        ),
      ),
    ),
  ),
//   'controllers' => 
//   array (
//     'invokables' => 
//     array (
//       'cover' => 'VufindUNL\\Controller\\CoverController',
//     ),
//   ),
);