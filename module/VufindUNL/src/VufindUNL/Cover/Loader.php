<?php
namespace VufindUNL\Cover;
class Loader extends \VuFind\Cover\Loader
{


     /**
     * Load the user-specified "cover unavailable" graphic (or default if none
     * specified).
     *
     * @return void
     * @author Thomas Schwaerzler <vufind-tech@lists.sourceforge.net>
     */
    public function loadUnavailable()
    {
        // No setting -- use default, and don't log anything:
        if (empty($this->configuredFailImage)) {
            //return $this->loadDefaultFailImage();
            return false;
        }
        // Setting found -- get "no cover" image from config.ini:
        $noCoverImage = $this->searchTheme($this->configuredFailImage);
        // If file is blank/inaccessible, log error and display default:
        if (empty($noCoverImage) || !file_exists($noCoverImage)
            || !is_readable($noCoverImage)
        ) {
            $this->debug("Cannot access '{$this->configuredFailImage}'");
            //return $this->loadDefaultFailImage();
            return false;
        }
        try {
            // Get mime type from file extension:
            $this->contentType = $this->getContentTypeFromExtension($noCoverImage);
        } catch (\Exception $e) {
            // Log error and bail out if file lacks a known image extension:
            $this->debug($e->getMessage());
            //return $this->loadDefaultFailImage();
            return false;
        }
        // Load the image data:
        $this->image = file_get_contents($noCoverImage);
    }

}
