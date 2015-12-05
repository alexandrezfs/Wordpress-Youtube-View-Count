<?php
/**
 * @package Youtube
 */
/*
Plugin Name: Youtube View Count
Description: Provide a shortcode to display youtube view counts.
Version: 1.0.0
Author: Alexandre Nguyen
Author URI: https://alexandrenguyen.fr
License: GPLv2 or later
Text Domain: youtube-view-count
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define("API_KEY", "AIzaSyDPk9S8lHLBQi1k1B5bGw4w6c__AKJeCB8");

function get_view_count($video_id) {
	$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" . $video_id . "&key=" . API_KEY);
	$json_data = json_decode($JSON, true);
	return $json_data['items'][0]['statistics']['viewCount'];
}

function get_view_count_shortcode_fn( $atts ){
	return get_view_count($atts['video_id']);
}

add_shortcode( 'youtube_views', 'get_view_count_shortcode_fn' );
