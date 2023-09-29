<h1>Beer Reviews Frontend</h1>
<?php
if ( ! empty( $data ) ) {
	$beer = $data['response']['beer'];

	?>

    <div class="beer-reviews">

        <div class="beer-info container">


            <div class="row">

                <h2>Brewery Name: <?php echo $beer['brewery']['brewery_name']; ?></h2>
				<?php
				if ( ! empty( $beer['brewery']['brewery_label'] ) ) {
					echo '<img src="' . $beer['brewery']['brewery_label'] . '" alt="Brewery Logo">';
				}
				?>
            </div>
            <div class="row">
                <h2>Beer Name: <?php echo $beer['beer_name']; ?></h2>
				<?php
				if ( ! empty( $beer['beer_label'] ) ) {
					echo '<img src="' . $beer['beer_label'] . '" alt="Beer Label">';
				}
				?>
            </div>
            <div class="row">

                <div>Beer Style: <?php echo $beer['beer_style']; ?></div>
                <div>Alcohol Content: <?php echo $beer['beer_abv']; ?> </div>
                <div>IBU (Bitterness): <?php echo $beer['beer_ibu']; ?></div>
                <div>Average Rating (out of 5): <?php echo $beer['rating_score']; ?></div>

            </div>


        </div>
		<?php

		$reviews = $beer['checkins']['items'];

		$latest_reviews = [];

		// Filter out reviews with a 0 rating score and collect the latest 10 reviews.
		foreach ( $reviews as $review ) {
			if ( $review['rating_score'] > 0 ) {
				$latest_reviews[] = $review;
			}

			// Limit to the latest 10 reviews.
			if ( count( $latest_reviews ) >= 10 ) {
				break;
			}
		}
		?>
        <h3>Checkins for the Beer:</h3>'
        <div class="reviews-wrap">'
			<?php
			foreach ( $latest_reviews as $review ): ?>
                <div class="review">
                    <p class="">
                        Name: <?php echo $review['user']['first_name'] . ' ' . $review['user']['last_name']; ?> </p>
                    <p class="">Date: <?php echo date( 'F j, Y, g:i a', strtotime( $review['created_at'] ) ); ?> </p>
                    <div class="review-rating">Rating: <?php echo $review['rating_score']; ?> </div>
                </div>
			<?php
			endforeach;
			?>
        </div>
    </div>

	<?php
} else {
	echo '<div class="beer-reviews">No data found.</div>';
}
