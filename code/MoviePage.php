<?php
/**
 * Created by PhpStorm.
 * User: rainerspittel
 * Date: 24/07/15
 * Time: 7:03 PM
 */

class MoviePage extends Page
{

    /**
     * @var array
     *
     * The content fields for the MoviePage matches the important fields of the OpenMovie Database API.
     * The API returns mainly character strings and as at this stage no further processing is known to the
     * data, we store the data as provided by the API as varchar.
     */
    private static $db = array(
        "MovieTitle"  => "Varchar(1024)",
        "Year"        => "Varchar(10)",
        "Rated"       => "Varchar(2)",
        "Released"    => "Varchar(24)",
        "Runtime"     => "Varchar(10)",
        "Genre"       => "Varchar(1024)",
        "Director"    => "Varchar(128)",
        "Writer"      => "Varchar(1024)",
        "Actors"      => "Varchar(1024)",
        "Plot"        => "Varchar(1024)",
        "Country"     => "Varchar(128)",
        "Awards"      => "Varchar(1024)",
        "Type"        => "Varchar(128)",
        "ImdbID"      => "Varchar(128)",
        "ImdbRating"  => "Varchar(128)"
    );

    /**
     * Updates the CMS Form in the backend, generating an edit form for the movie details.
     *
     * As the Movie-page will solely show the movie details and no further content, the HTML-Content
     * editfield has been removed.
     *
     * This editform uses a new MovieAutoComplete formfield which calls the omdbAPI to retrieve datasets
     * from the web service. @See MovieAutoComplete for more details.
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        // Add Movie Fields to the Main tab in the edit form (before the content area)
        $fields->addFieldsToTab(
            'Root.Main',
            array(
                HeaderField::create('Movies'),
                MovieAutoComplete::create("SearchTerm","Search", "", 128)
                    ->setAttribute('placeholder',"Please enter a movie name to search for...")
                    ->setDescription('After choosing a movie, the details will be used as a template to complete this form.'),
                HeaderField::create('Movie Details','Movie Details',3),
                TextField::create('MovieTitle','Movie Title',$this->Title),
                FieldGroup::create(
                    array(
                        TextField::create('Runtime','Runtime',$this->Runtime),
                        TextField::create('Rated','Rated',$this->Rated)
                    )
                )->setTitle('Details'),
                FieldGroup::create(
                    array(
                        TextField::create('Country','Country',$this->Country),
                        TextField::create('Released','Released',$this->Released),
                        TextField::create('Year','Year',$this->Year)

                    )
                )->setTitle('Release Info'),
                TextField::create('Genre','Genre',$this->Genre),
                TextareaField::create('Plot','Plot',$this->Plot),
                HeaderField::create('People Involved','People Involved',3),
                TextField::create('Director','Director',$this->Director),
                TextField::create('Writer','Writer',$this->Writer),
                TextField::create('Actors','Actors',$this->Actors),
                HeaderField::create('Awards','Awards',3),
                TextareaField::create('Awards','Awards',$this->Awards),
                HiddenField::create('Type','Type',$this->Type),
                HiddenField::create('ImdbID','ImdbID',$this->ImdbID),
                HiddenField::create('ImdbRating','ImdbRating',$this->ImdbRating)
            ),'Content'
        );

        // Remove the content area (HTMLEditField)
        $fields->removeByName('Content');

        return $fields;
    }

    /**
     * Overwrites default behaviour onBeforeWrite
     *
     * This method sets the page name based on the selected MovieTitle. If no movie title exists,
     * it will retain the existing page title (and navigation labels).
     * It clears the URL Segment variable as the SiteTree::onBeforeWrite will determine a new url-segment
     * based on the new page tile (which is the movie title).
     */
    protected function onBeforeWrite()
    {
        if ($this->MovieTitle) {
            $this->Title = $this->MovieTitle;
            $this->URLSegment = '';
        }
        parent::onBeforeWrite();
    }

}

/**
 * Class MoviePage_Controller
 *
 * This controller has been created (with no further feature enhancements) to enable SS_Viewer to render
 * the MoviePage template out of the module folder.
 */
class MoviePage_Controller extends Page_Controller
{

    private static $allowed_actions = array (
    );

    public function init() {
        parent::init();
    }

}