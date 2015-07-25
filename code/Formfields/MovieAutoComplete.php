<?php
/**
 * Created by PhpStorm.
 * User: rainerspittel
 * Date: 24/07/15
 * Time: 9:19 PM
 */

/**
 * Class MovieAutoComplete
 *
 * This class implements an Autocomplete field which is used to collect suggestions from the open movie database
 * api. This form field includes the @see MovieAutoComplete.js javascript file which handles the ajax calls to
 * the API and to update the form after the user has selected a record.
 *
 * This class is based on "tractorcow/silverstripe-autocomplete" which implements a jquery autocomplete, provinding
 * an field with can suggest results stored in the CMS (i.e. DataObjects). As we require to load the content from
 * a 3rd party system, the original form field needed to be altered significantly which resulted in this
 * MovieAutoComplete formfield. Special thanks to tractorcow.
 *
 */
class MovieAutoComplete extends TextField
{

    /**
     * @config
     * @var string
     */
    private static $suggestURL = '';

    /**
     * @return array
     */
    function getAttributes()
    {
        return array_merge(
            parent::getAttributes(), array(
                'data-source' => $this->getSuggestURL(),
                'data-min-length' => 2,
                'data-require-selection' => true,
                'autocomplete' => 'off',
                'name' => $this->getName() . '__autocomplete'
            )
        );
    }

    /**
     * Add autocomplete and text classes to the dom element.
     *
     * @return string
     */
    function Type()
    {
        return 'autocomplete text';
    }

    /**
     * Renders the autocomplete form field.
     *
     * @param array $properties
     *
     * @return string
     */
    function Field($properties = array())
    {
        // jQuery Autocomplete Requirements
        Requirements::css(THIRDPARTY_DIR . '/jquery-ui-themes/smoothness/jquery-ui.css');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-ui/jquery-ui.js');

        // init script for this field
        Requirements::javascript(MOVIE_DIR . '/javascript/MovieAutoComplete.js');

        return parent::Field($properties);
    }

    /**
     * Get the URL used to fetch Autocomplete suggestions.
     * Returns null if the built-in mechanism is used.
     *
     * @return string The URL used for suggestions.
     */
    public function getSuggestURL()
    {
        $suggestURL = $this->config()->suggestURL;

        if(!empty($suggestURL)) {
            return $suggestURL;
        }

        // Failover - Default link, in case config.yml is not configured correctly.
        return 'http://www.omdbapi.com/';
    }
} 