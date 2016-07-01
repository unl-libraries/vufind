<?php

namespace VufindUNL\RecordDriver;

class EIT extends \VuFind\RecordDriver\EIT
{
	/* citation formats allowed for EIT. */
	protected function getSupportedCitationFormats()
	{
		return ['APA', 'Chicago', 'MLA', 'Harvard'];
	}

}

