<form class="search-form" action="/" method="get">
	<label for="search" hidden>Search Mixed Reef Tank</label>
	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <button type="submit" form="search-form" value="Submit">Submit</button>
</form>