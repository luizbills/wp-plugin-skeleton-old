<?php

namespace {{namespace}}\functions;

function get_post ( $id, $post_type = 'post' ) {
	$post = \get_post( \intval( $id ) );
	if ( $post && $post_type === $post->post_type ) {
		return $post;
	}
	return false;
}
