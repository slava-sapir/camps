<?php
/**
 * Camp Reviews Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 *        This is either the post ID currently being displayed inside a query loop,
 *        or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 *
 * @package Forest_Cliff_Camps
 */
$anchor = isset($block['anchor']) ? $block['anchor'] : '';
$classes = isset($block['className']) ? $block['className'] : '';
?>

<section id="<?= esc_attr($anchor) ?>" class="schedule <?= esc_attr($classes) ?>"
         style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <?php
        // Get the selected schedule post ID from the Post Object field
        $schedule_post = get_field('schedule');

        if ($schedule_post) :
            // Define the days of the week
            $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // Initialize an array to store the schedule data
            $schedule = [];

            // Loop through each day group
            foreach ($days as $day_name) :
                $day_lower = strtolower($day_name);
                $group_field = "{$day_lower}_group";

                // Check if the group field has rows of data
                if (have_rows($group_field, $schedule_post)) :

                    // Loop through the rows of data in the repeater field
                    while (have_rows($group_field, $schedule_post)) : the_row();
                        if (have_rows('schedule_entries')) :
                            while (have_rows('schedule_entries')) : the_row();
                                $time = get_sub_field('time');
                                $formatted_time = date('g:i a', strtotime($time));
                                $activity = get_sub_field('activity');
                                $bg_color = get_sub_field('background_colour') ? get_sub_field('background_colour') : 'bg-tan';
                                $col_span = get_sub_field('column_span') ? get_sub_field('column_span') : 1;
                                $row_span = get_sub_field('row_span') ? get_sub_field('row_span') : 1;

                                // Store the activity data in the schedule array
                                if (!isset($schedule[$time])) {
                                    $schedule[$time] = [];
                                }

                                // Group activities by day under the same time
                                if (!isset($schedule[$time][$day_lower])) {
                                    $schedule[$time][$day_lower] = [];
                                }

                                $schedule[$time][$day_lower][] = [
                                    'activity'       => $activity,
                                    'bg_colour'      => $bg_color,
                                    'col_span'       => $col_span,
                                    'row_span'       => $row_span,
                                    'formatted_time' => $formatted_time,
                                ];

                            endwhile;
                        endif;
                    endwhile;
                endif;
            endforeach;

            // Sort the schedule array by time (since the time is now in H:i:s format)
            ksort($schedule);
            ?>
            <div class="schedule-grid grid">
                <div class="schedule-header">
                    <div class="time-header text-white text-center fw-bold d-flex justify-content-center align-items-center rounded-1 p-20">Time</div>
                    <?php foreach ($days as $day_name): ?>
                        <div class="day-header text-white text-center fw-bold d-flex justify-content-center align-items-center rounded-1 p-20"><?= $day_name; ?></div>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($schedule as $time => $day_entries): ?>
                    <div class="schedule-row">
                        <div
                            class="time-cell text-center fw-bold d-flex justify-content-center align-items-center bg-tan rounded-1 p-20"><?= $day_entries[array_key_first($day_entries)][0]['formatted_time']; ?></div>
                        <?php foreach ($day_entries as $day_lower => $activities): ?>
                            <?php foreach ($activities as $activity_data): ?>
                                <div
                                    class="day-cell text-center d-flex justify-content-center align-items-center rounded-1 p-20 <?= $activity_data['bg_colour']; ?>"
                                    style="grid-column: span <?= $activity_data['col_span']; ?>; grid-row: span <?= $activity_data['row_span']; ?>;">
                                    <?= $activity_data['activity']; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mobile-schedule">
                <?php foreach ($days as $day_name): ?>
                    <div class="mobile-day-group">
                        <h2><?= $day_name; ?></h2>
                        <?php foreach ($schedule as $time => $day_entries): ?>
                            <?php if (isset($day_entries[strtolower($day_name)])) : ?>
                                <?php foreach ($day_entries[strtolower($day_name)] as $activity_data) : ?>
                                    <div class="mobile-entry">
                                        <div class="time"><?= $activity_data['formatted_time']; ?></div>
                                        <div class="activity"><?= $activity_data['activity']; ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php
        else :
            echo '<p>No schedule selected.</p>';
        endif;
        ?>


    </div>
</section>