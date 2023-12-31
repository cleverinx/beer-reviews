<?php


use Beer_Reviews\Frontend;


if ( ! empty( $data ) && $data['meta']['code'] == 200 ) {

	$beer         = $data['response']['beer'];
	$show_avatar  = ! empty( $show_avatar ) ? 1 : 0;
	$show_reviews = ! empty( $show_reviews ) ? 1 : 0;

	?>

    <div class="beer-reviews">
        <div class="container">
            <div class="card">
                <div class="row beer-info ">
                    <div class="beer-label beer-label__sm">
						<?php
						if ( ! empty( $beer['brewery']['brewery_label'] ) ) {
							?>
                            <div class="logo-wrap logo-wrap__sm mx-auto">
                                <img class="beer-label__beer"
                                     src="<?php echo $beer['brewery']['brewery_label'] ?>" alt="Beer Label">
                            </div>
						<?php } ?>
                    </div>
                    <div class="beer-info-content">
                        <h3 class="display-sm m-0"><?php echo $beer['brewery']['brewery_name']; ?></h3>
                    </div>
                </div>

                <div class="row beer-info">
                    <div class="beer-label">
						<?php
						if ( ! empty( $beer['brewery']['brewery_label'] ) ) {
							?>
                            <div class="logo-wrap mx-auto">
                                <img class="beer-label__beer"
                                     src="<?php echo $beer['beer_label']; ?>" alt="Beer Label">
                            </div>
						<?php } ?>
                    </div>
                    <div class="beer-info-content">
                        <h1 class="display-sm m-0"><?php echo $beer['beer_name']; ?></h1>
                        <h3 class="subheading-sm m-0"> <?php echo $beer['beer_style']; ?></h3>
                        <div class="rating-wrap mt-1"> <?php echo Frontend::generate_star_rating( $beer['rating_score'] ); ?>
                            <span class="num-rating"><?php echo round( $beer['rating_score'], 2 ); ?>/5 (<?php echo $beer['rating_count']; ?> reviews)</span>
                        </div>

                    </div>
                </div>

                <div class="row beer-specs p-1 pb-0">

                    <div class="column stat">
                        <div class="beer-spec mb-1"><p class="tooltip subheading-sm m-0"><span class="tooltip-text">Alcohol By Volume</span><i
                                        data-lucide="beer" class="stat-icon"></i>
								<?php echo $beer['beer_abv']; ?>% ABV</p>
                        </div>
                    </div>
                    <div class="column stat">
                        <div class="beer-spec mb-1"><p class="tooltip subheading-sm m-0">
                                <span class="tooltip-text">Bitterness</span><i data-lucide="hop"
                                                                               class="stat-icon"></i> <?php echo $beer['beer_ibu']; ?>
                                IBU
                            </p></div>
                    </div>
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
            <div class="reviews-wrap card">
                <div class="row p-1"><i data-lucide="bar-chart-horizontal" class="mr-05"></i>
                    <h3 class="display-sm m-0">Latest Reviews</h3></div>

				<?php
				foreach ( $latest_reviews as $review ): ?>
                    <div class="review  p-1">
                        <div class="rating-wrap"><?php echo Frontend::generate_star_rating( $review['rating_score'] ); ?>
                            <span class="num-rating"><?php echo round( $review['rating_score'], 2 ); ?>/5</span></div>
                        <div class="m-0 review-meta">
                            <div class="user-info">
								<?php if ( $show_avatar == 1 ): ?>
                                    <div class="user-avatar">
                                        <img src="<?php echo $review['user']['user_avatar']; ?>" alt="User Avatar">
                                    </div>
								<?php endif; ?>
                                <div class="user-meta">
                                    <p class="m-0"><?php echo $review['user']['first_name'] . ' ' . $review['user']['last_name']; ?></p>
                                    <p class="date m-0">
										<?php echo date( 'F j, Y, g:i a', strtotime( $review['created_at'] ) ); ?> </p>
                                </div>
                            </div>

							<?php
							if ( $show_reviews == 1 ): ?>
                                <div class="user-comment">
                                    <p class="comment m-0">
										<?php echo $review['checkin_comment']; ?>
                                    </p>
                                </div>
							<?php endif; ?>
                        </div>
                    </div>
				<?php
				endforeach;
				?>
            </div>
        </div>
    </div>

	<?php
} else {
	echo '<div class="beer-reviews">No beer data found. Please check your API keys.</div>';
}
