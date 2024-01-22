<?php
namespace ReviewEasy\ReviewEasyWP;

/**
 * Class to disable some dashboard widgets for saving requests
 */
class Disable_Dashboard_Widgets {

	public static function init(): void {

		if (apply_filters('review_easy_disable_wordpress_news_events_widget', true)) {
			remove_meta_box('dashboard_primary', 'dashboard', 'normal'); // Removes the 'WordPress News' widget
		}

	}
}
