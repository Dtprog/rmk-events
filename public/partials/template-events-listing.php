<?php
/*
 * Template Name: Events Listing
 * Description: A page template to display all future events.
 */

get_header();


$custom_query = new WP_Query(array(
    'post_type' => 'events',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => '_rmk_event_date_meta_key',
            'value' => current_time('Y-m-d H:i:s'),
            'compare' => '>',
            'type' => 'DATETIME'
        )
    )
));

echo '<div class="events-list"><H1>Active events</H1>';

if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
        $custom_query->the_post();

        $image = get_post_meta(get_the_ID(), '_rmk_event_image_meta_key', true);
        $location = get_post_meta(get_the_ID(), '_rmk_event_meta_key', true);
        $date = get_post_meta(get_the_ID(), '_rmk_event_date_meta_key', true);

        echo '<div class="event">';
        echo '<h2>' . get_the_title() . '</h2>';
        echo '<div class="meta">';
        if ($location) {
            echo '<div class="location">Where: ' . $location . '</div>';
        }
        if ($date) {
            echo '<div class="date">When: '. date('d.m.Y H:i', strtotime($date)). '</div>';
        }
        echo '</div><div class="content">';
        echo '<div class="text-content">' . get_the_content() . '</div>';
        if ($image) {
            echo '<div class="image-content"><img src="' . get_post_meta(get_the_ID(), '_rmk_event_image_meta_key', true) . '" alt="Event image"/></div>';
        }
        echo '</div></div>';
    }
} else {
    echo '<div>No posts found.</div>';
}
echo '<div>';

wp_reset_postdata();

get_footer();

