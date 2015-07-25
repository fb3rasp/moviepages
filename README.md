# MoviePages Module

This module extends SilverStripe CMS with the ability to show detailed movie information. OpenMovie Database will be used to retrieve information of movies and the CMS user has the ability to search for movies and store the information locally.

## Overview

This Module adds the page type 'Movie Page' which shows movie information. 

As a CMS user, you will have the ability to search for existing movie titles from OpenMovie Database. The CMS will retrieve the data and stores them locally.

Once a movie title has been entered into the search text-field, a Ajax request will be send to the OMDBAPI which then returns a JSON string.

The Open Movie Database does not require an API key.

## Installation

This module has been tested against SilverStripe 3.1.13 and requires the simple theme.

### Option 1: Create a new project

Assuming you have composer installed, create a new project via composer create-project

    sudo composer create-project silverstripe/installer [silverstripe-project]

Follow the SilverStripe installation instructions. Then add the module to your SilverStripe project

    cd [silverstripe-project]
    git clone https://github.com/fb3rasp/moviepages moviepages

Run a dev-build in the browser (or using sake via command line):

    http://localhost/[silverstripe-project]/dev/build

The new page type is now available and ready for use.

### Option 2: Require the module for an existin SilverStripe project

Change directory into the project's root directory and run the composer require command:

    cd [silverstripe-project]
    composer require fb3rasp/moviepages
    
Run a dev-build in the browser (or using sake via command line):

    http://localhost/[silverstripe-project]/dev/build

The new page type is now available and ready for use.
    
### Option 3: If you have an existing SilverStripe project

Clone this repository from github into the root folder of your SilverStripe project

    cd [silverstripe-project]
    git clone https://github.com/fb3rasp/moviepages moviepages

Run a dev-build in the browser or via command line:

    http://localhost/[silverstripe-project]/dev/build

The new page type is now available and ready for use.

### Option 4: Add repository into your project composer.json file

In case you already have a project, managed by composer, and you would like to add this module via composer, open your project composer.json file and add the following text segments to it...

#### Add the repository

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/fb3rasp/moviepages.git"
        }
    ],

#### Require the module

    "require": {
        "php": ">=5.3.2",
        [...]
        "fb3rasp/moviepages": "*"
    },

Then you change into your project folder and run a composer update to retrieve the repository.

    cd [silverstripe-project]
    composer update
    
Finally run a dev-build and then the Movie Page will be available and ready for use.

## Manual

Log into the CMS and create a new page of the page-type 'Movie Page'. After successfully creating the page type, you will
find the CMS form with a number of new fields. The page itself does not hold any content anymore and shows only the movie
information. For that reason the Content edit-field has been removed.

### Movie Page

The Movie Page stores the regular SiteTree information, like page title, navigation label and URL segment. The field Search performs a title-search on the OpenMovieDB API.
You can select one of the result entries. Then a second request will be send to retrieve the full data-set of the movie. Most of the returned information will be stored as properties of this page-instance. After the result has been populated into the form, the CMS user will have the ability to overwrite the values and publish the page likeregular pages.

The user can search multiple times and everytime, when the user selects a record, the existing values will be overwritten with the new result.

### Searching for Movies

Select the Search field in the 'Movies' section of the form and enter 'Star'. A request will be send and the top 10
results will be returned and shown in a drop down. You need to enter at least three characters before the search-request
will be send to the remote API.

When you continue to enter the movie title, you will see that the result set shows more and more relevant movies.

### Saving Movie Page

When the user saves the page (i.e. Save or Publish) the title of the movie (if entered) will become the Page's title,
navigation label and the URL segment will be updated as well.

### Viewing the Movie Page

Once the page has been published, everyone (based on the permission settings of the page) can view the content in a basic layout style.

## Developer Notes

If you would like to use the module but need to change the template, simply create a layout template in your themes/[name]/template/Layout folder and call it MoviePage.ss. This template will them be taken to render the page.

## Potential Enhancements

* Support Posters (images).
* Render template in the backend and make the form fields in the CMS hidden.
* Verify server side that the movie datafields have not been altered.
* Abstract search API so that other movie databases are supported.
* Adding Unit and Behaviour tests.

## Quality

* At the stage, no unit, function or behaviour tests have been created.
* Module has been mainly tested against Chrome and Firefox, IE10.

## Bugtracker

Bugs are tracked on github.com ([moviepages issues](https://github.com/fb3rasp/moviepages/issues))

## License

    Copyright (c) 2015, Rainer Spittel
    All rights reserved.

    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this
      list of conditions and the following disclaimer.

    * Redistributions in binary form must reproduce the above copyright notice,
      this list of conditions and the following disclaimer in the documentation
      and/or other materials provided with the distribution.

    * Neither the name of moviepages nor the names of its
      contributors may be used to endorse or promote products derived from
      this software without specific prior written permission.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

