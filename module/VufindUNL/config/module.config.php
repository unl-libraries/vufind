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
          'solrmarc' => 'VufindUNL\\RecordDriver\\Factory::getSolrMarc',
          'solrdefault' => 'VufindUNL\\RecordDriver\\Factory::getSolrDefault',
        ),
      ),
    ),
  ),
);