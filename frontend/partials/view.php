<?php


use Beer_Reviews\Frontend;

if ( ! empty( $data ) ) {
	$beer = $data['response']['beer'];

	?>

    <div class="beer-reviews">

        <div class="container">


            <div class="card">
                <div class="row padding-1-5 beer-info">

                    <div class="beer-label">
						<?php
						if ( ! empty( $beer['brewery']['brewery_label'] ) ) {
							?>
                            <div class="logo-wrap">
                                <img class="beer-label__beer"
                                     src="<?php echo $beer['brewery']['brewery_label'] ?>" alt="Beer Label">
                            </div>
						<?php } ?>
                    </div>

                    <div class="beer-info-content">

                        <p class="subheading">Brewery</p>
                        <h3 class="display-sm margin-0"><?php echo $beer['brewery']['brewery_name']; ?></h3>

                    </div>
                </div>

                <div class="row padding-1-5  beer-info">
                    <div class="beer-label">

						<?php
						if ( ! empty( $beer['brewery']['brewery_label'] ) ) {
							?>
                            <div class="logo-wrap">
                                <img class="beer-label__beer"
                                     src="<?php echo $beer['beer_label']; ?>" alt="Beer Label">
                            </div>
						<?php } ?>
                    </div>
                    <div class="beer-info-content">
                        <p class="subheading">Beer</p>

                        <h1 class="display-sm margin-0"><?php echo $beer['beer_name']; ?></h1>
                    </div>

                </div>


            <div class="row">
<div class="column">
                <div><p class="tooltip subheading margin-0">Beer Style</p><?php echo $beer['beer_style']; ?></div>
    <div><p class="tooltip subheading margin-0" ><span class="tooltip-text">Alcohol Amount</span>ABV</p> <?php echo $beer['beer_abv']; ?> </div>
    </div>
                <div class="column">
                <div><p class="tooltip subheading margin-0" ><span class="tooltip-text">Bitterness</span>IBU</p> <?php echo $beer['beer_ibu']; ?></div>
                <div><p class="tooltip subheading margin-0" >Average Rating</p> <?php echo Frontend::generate_star_rating($beer['rating_score']); ?><span><?php echo round($beer['rating_score'], 2); ?>/5</span></div>
                </div></div>
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
            <h3>Reviews:</h3>
            <div class="reviews-wrap">
				<?php
				foreach ( $latest_reviews as $review ): ?>
                    <div class="review card padding-1">
                        <div><?php echo Frontend::generate_star_rating($review['rating_score']); ?><span><?php echo round($review['rating_score'], 2); ?>/5</span></div>
                        <p class="margin-0">
                            <strong><?php echo $review['user']['first_name'] . ' ' . $review['user']['last_name']; ?></strong>
                        <span class="date">
            <?php echo date( 'F j, Y, g:i a', strtotime( $review['created_at'] ) ); ?> </span>
                        </p>

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
