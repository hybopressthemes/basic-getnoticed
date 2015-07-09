<?php

printf( '<li %s>', hybrid_get_attr( 'comment' ) );

	printf( '<article>' );

		printf( '<header class="%s">', 'comment-meta clearfix' );

			echo get_avatar( $comment, apply_filters( 'hybopress_comment_gravatar_size', 48 ) );

			printf( '<cite %s>', hybrid_get_attr( 'comment-author' ) );

				echo get_comment_author_link();

			echo '</cite>';

			printf( '<span class="%s">', 'says sr-only' );

				echo __( 'says:','getnoticed' );

			echo '</span><br />';

			printf( '<a %s>', hybrid_get_attr( 'comment-permalink' ) );

				printf( '<time %s>', hybrid_get_attr( 'comment-published' ) );

					printf( __( '%1$s at %2$s', 'getnoticed' ), get_comment_date(), get_comment_time() );

				echo '</time>';

			echo '</a>';

			edit_comment_link();

		echo '</header><!-- .comment-meta -->';

		printf( '<div class="%s">', 'comment-content' );

if ( '0' == $comment->comment_approved ) {
	printf( '<p class="%s">', 'text-info text-uppercase' );

		printf( '<em class="%s">', 'comment-awaiting-moderation' );

			_e( 'Your comment is awaiting moderation.', 'getnoticed' );

		echo '</em>';

	echo '</p>';

}

			comment_text();

		echo '<!-- .comment-content -->';

		hybrid_comment_reply_link();

	echo '</article>';

/* No closing </li> is needed.  WordPress will know where to add it. */
