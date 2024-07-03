# vufind
- NOTE: this project has been abandoned and no development or usage continued after last update.
- 
Contains configuration settings that need to be shared among the developers, as well as custom modules, themes and templates for a test site at the University of Nebraska - Lincoln Libraries.

Changes were made in the local folder to faciliate updates wherever possible.

This code is for version 3.1.0 of vufind.
When the library server is down, the following needs to happen:

If the library server is down:
Steps to take if the underlying database is down also (can you get to the PostgreSQL database)?

1.	Move themes/unl/templates/down_no_db.html to replace header.phtml

2.	Disable the UNLSierra driver and enable the NoILS driver in local/config/vufind/config.ini

3.	Check the local/languages/en.ini file for the ils_offline_status message, as well as ils_offline_holdings_message and ils_offline_home_message . Make sure they say what you want.

4.	Make sure in the file module/VufindUNL/src/VufindUNL/View/Helper/Root/ProxyUrl.php  __invoke function has the proxy rewrite removal in it.

5.	 In themes/unl/templates/RecordDriver/SolrDefault/result-list.phtml  around line 118, uncomment the div with the class callnumAndLocation_noILS. (or cp result-list_nodb.phtml to result-list.phtml )

6.	Disable any cron jobs that harvest the catalog

If the database is available:

1.	Move themes/unl/templates/down_db_avail.html to replace header.phtml

2.	Make sure in the file module/VufindUNL/src/VufindUNL/View/Helper/Root/ProxyUrl.php  __invoke function has the proxy rewrite removal in it.

3.	 In themes/unl/templates/RecordDriver/SolrDefault/result-list.phtml  around line 118, make sure the div with the class callnumAndLocation_noILS is commented out. (or cp result-list_updb.phtml to result-list.phtml )

4.	 You *may* be able to leave the cron jobs that harvest the catalog enabled. 

