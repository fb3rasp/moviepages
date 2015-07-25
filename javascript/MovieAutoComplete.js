/**
 * Register Autocomplete functions with fields.
 * This is not strictly using jQuery, like the rest of the CMS.
 */
(function($) {
    $(function() {

        // Hard-coded update form which maps the data-object selected by the user
        // to the form fields.
        //
        // @todo add abstraction so that the CMS provides the mapping based on the page's $db definition
        //
        // If field names get added/renamed or deleted in the MoviePage.getCMSFields method, please update
        // // this function as well.
        updateForm = function(data) {
            $('#Form_EditForm_Actors').val(data.Actors);
            $('#Form_EditForm_Awards').val(data.Awards);
            $('#Form_EditForm_Country').val(data.Country);
            $('#Form_EditForm_Director').val(data.Director);
            $('#Form_EditForm_Genre').val(data.Genre);
            $('#Form_EditForm_Language').val(data.Language);
            $('#Form_EditForm_Metascore').val(data.Metascore);
            $('#Form_EditForm_Plot').val(data.Plot);
            $('#Form_EditForm_Rated').val(data.Rated);
            $('#Form_EditForm_Released').val(data.Released);
            $('#Form_EditForm_Runtime').val(data.Runtime);
            $('#Form_EditForm_MovieTitle').val(data.Title);
            $('#Form_EditForm_Type').val(data.Type);

            $('#Form_EditForm_Writer').val(data.Writer);
            $('#Form_EditForm_Year').val(data.Year);

            $('#Form_EditForm_ImdbRating').val(data.imdbRating);
            $('#Form_EditForm_ImdbID').val(data.imdbID);
        };

        //
        // Load autocomplete functionality when field gets focused
        $('.field.autocomplete input.text').live('focus', function() {

            var input = $(this);

            // Prevent this field from loading itself multiple times
            if(input.attr('data-loaded') == 'true') {
                return;
            }

            input.attr('data-loaded', 'true');

            //
            // load autocomplete into this field
            input.autocomplete({
                source: function( request, response ) {
                    //
                    // call the remote API, add a wildcard to the search term (without checking if there
                    // might be a wildcard already.
                    $.ajax({
                        url: input.attr('data-source'),
                        dataType: "jsonp",
                        data: {
                            s: request.term+"*",
                            r: 'json'
                        },
                        success: function( data ) {
                            // delete the content of autocomplete-dropdown
                            if (data.Error != undefined) {
                                response ([]);
                                return;
                            }

                            // update the data list, setting the value property which will
                            // be used to populate the labels into the drop down.
                            $.each( data.Search, function(key, value) {
                                value.value = value.Title + " (" + value.Year + ")";
                            });

                            // return the data we received plus the added titles 'movie title (year)'
                            response(data.Search);
                        }
                    });
                },

                minLength: input.attr('data-min-length'),

                select: function( event, ui ) {

                    if (ui.item.imdbID == undefined) {
                        // remove invalid value, as it didn't match anything
                        input.val("");
                        input.data("autocomplete").term = "";
                        return false;
                    }

                    // Accept if item selected from list
                    if(ui.item) {
                        input.parent().find(':hidden').val(ui.item.imdbID);

                        $.ajax({
                            url: input.attr('data-source'), // 'http://www.omdbapi.com/',
                            dataType: "jsonp",
                            data: {
                                i: ui.item.imdbID,
                                plot: 'full'
                            },
                            success: function(data) {
                                updateForm(data);
                            }
                        });
                        return true;
                    }

                    // provided ui element not an item, reset the value in the textfield as
                    // the value is not from the omdb list.
                    input.val("");
                    input.data("autocomplete").term = "";
                    return false;
                }
            });
        });
    });
})(jQuery);