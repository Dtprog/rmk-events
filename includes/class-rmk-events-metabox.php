<?php

abstract class Rmk_Events_Meta_Box
{

    /**
     * Set up and add the meta boxes.
     */
    public static function add()
    {
        $screens = ['events'];
        foreach ($screens as $screen) {
            add_meta_box(
                'event_image_id',
                'Event Image',
                [self::class, 'events_image_html'],
                $screen
            );
            add_meta_box(
                'event_date_id',
                'Event Date/Time',
                [self::class, 'events_date_html'],
                $screen
            );
            add_meta_box(
                'event_location_id',
                'Event Location',
                [self::class, 'events_box_html'],
                $screen
            );
            add_meta_box(
                'event_organiser_id',
                'Event Organiser',
                [self::class, 'events_organiser_html'],
                $screen
            );
        }
    }


    /**
     * Save the meta box selections.
     *
     * @param int $post_id The post ID.
     */
    public static function save($post_id)
    {
        if (array_key_exists('meta-image', $_POST)) {
            update_post_meta(
                $post_id,
                '_rmk_event_image_meta_key',
                sanitize_text_field($_POST['meta-image'])
            );
        }
        if (array_key_exists('event_date_field', $_POST)) {

            update_post_meta(
                $post_id,
                '_rmk_event_date_meta_key',
                $_POST['event_date_field']
            );
        }
        if (array_key_exists('event_location_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_rmk_event_meta_key',
                $_POST['event_location_field']
            );
        }
        if (array_key_exists('event_organiser_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_rmk_event_organiser_meta_key',
                $_POST['event_organiser_field']
            );
        }
    }


    /**
     * Generates the HTML for the location box.
     *
     * @param WP_Post $post The post object.
     * @return void
     */
    public static function events_box_html($post)
    {
        $value = get_post_meta($post->ID, '_rmk_event_meta_key', true);
        ?>
        <label for="event_location_field">&nbsp;</label>
        <select name="event_location_field" id="event_location_field" class="postbox">
            <option value="">Select event location...</option>
            <option value="Tallinn" <?php selected($value, 'tartu'); ?>>Tallinn</option>
            <option value="Tartu" <?php selected($value, 'tartu'); ?>>Tartu</option>
            <option value="Narva" <?php selected($value, 'narva'); ?>>Narva</option>
        </select>
        <?php
    }


    /**
     * Generates the HTML for the organiser field.
     *
     * @param WP_Post $post The post object.
     * @return void
     */
    public static function events_organiser_html($post)
    {
        $value = get_post_meta($post->ID, '_rmk_event_organiser_meta_key', true);
        ?>
        <label for="event_organiser_field">&nbsp;</label>
        <input type="text" name="event_organiser_field" id="event_organiser_field" class="postbox"
               value="<?= $value ?>"/>
        <?php
    }

    /**
     * Generates the HTML for the events date input field.
     *
     * @param WP_Post $post The post object.
     * @return void
     */
    public static function events_date_html($post)
    {
        $value = get_post_meta($post->ID, '_rmk_event_date_meta_key', true);
        ?>
        <label for="event_date_field">&nbsp;</label>
        <input type="datetime-local" name="event_date_field" id="event_date_field" class="postbox"
               value="<?= $value ?>"/>
        <?php
    }

    public static function events_image_html($post)
    {
        $image_url = get_post_meta($post->ID, '_rmk_event_image_meta_key', true);
        ?>
        <p>
            <img id="event-image-preview" src="<?php echo esc_url($image_url); ?>"
                 style="max-width: 250px; max-height: 250px; display: <?php echo $image_url ? 'block' : 'none'; ?>;">
        </p>
        <input type="hidden" name="meta-image" id="meta-image"
               value="<?php if (isset ($image_url)) echo $image_url; ?>"/>
        <input type="button" id="meta-image-button" class="button"
               value="<?php _e('Choose or Upload an Image', 'prfx-textdomain') ?>"/>
        <input type='button' class="button" value="Remove Image" id="meta-image-remove-btn"/>

        <?php
    }
}

add_action('add_meta_boxes', ['Rmk_Events_Meta_Box', 'add']);
add_action('save_post', ['Rmk_Events_Meta_Box', 'save']);
