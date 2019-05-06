<?php
/**
 * Plugin name: bbPress Notify - Extended Template Tags
 * Description: Effectively increases the range of template tags supported by bbPress Notify.
 * Version:     0.1.0
 * Author URI:  https://codingkills.me
 * License:     GPL-3.0
 */

namespace bbPress_Notify_Extensions;

class Listener {
	public function listen() {
		add_action( 'bbp_new_reply', [ $this, 'on_new_reply' ], 1 );
	}

	public function on_new_reply( $reply_id ) {
		new Additional_Template_Tags_Handler(
			$this->get_topic_id_from_reply_id( $reply_id ),
			$reply_id
		);
	}

	private function get_topic_id_from_reply_id( $reply_id ) {
		global $wpdb;
		$reply_id = absint( $reply_id );

		// Try to use the bbPress API first of all
		$topic_id = bbp_get_reply_topic_id( $reply_id );

		if ( $topic_id ) {
			return $topic_id;
		}

		// If it is too early for the above to work (ie, no post
		// meta is yet recorded for the new reply), try an
		// alternative approach
		return (int) $wpdb->get_var( "
			SELECT post_parent
			FROM   $wpdb->posts
			WHERE  ID = $reply_id
		" );
	}
}

class Additional_Template_Tags_Handler {
	private $reply_id = 0;
	private $topic_id = 0;

	public function __construct( $topic_id, $reply_id ) {
		$this->reply_id = $reply_id;
		$this->topic_id = $topic_id;
		add_filter( 'wp_mail', [ $this, 'parse_additional_template_tags' ] );
	}

	public function parse_additional_template_tags( array $email_properties ) {
		$email_properties['message'] = $this->parse( $email_properties['message'] );
		$email_properties['subject'] = $this->parse( $email_properties['subject'] );
		return $email_properties;
	}

	private function parse( $content ) {
		$content = str_replace(
			'[topic-author]',
			bbp_get_topic_author_display_name( $this->topic_id ),
			$content
		);

		return $content;
	}
}

( new Listener )->listen();