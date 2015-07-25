<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
    <article>
        <h1>Movie: $Title</h1>
        <div class="content">
            <h2>
                <span>$MovieTitle</span>
                <span>($Year)</span>
            </h2>
            <div class="infobar">
                <span>Rated: $Rated</span>
                <span>Duration: $Runtime</span>
                <span>Genre: $Genre</span>
                <span>Date Published: $Released</span>
            </div>
            <div>
                <span>Rating: $ImdbRating out of 10</span>
                <span>Country: $Country</span>
            </div>
            <div>
                <h3>Description</h3>
                $Plot
            </div>
            <hr/>
            <div>
                <h3>Directors</h3>
                $Director
            </div>
            <div>
                <h3>Writer</h3>
                $Writer
            </div>
            <div>
                <h3>Actors</h3>
                $Actors
            </div>

            <hr/>
            <div>
                <h3>Awards</h3>
                $Awards
            </div>
        </div>
    </article>
    $Form
    $CommentsForm
</div>