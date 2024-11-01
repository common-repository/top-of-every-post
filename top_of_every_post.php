<?php
/*
Plugin Name: Top of every post
Plugin URI: http://www.tacticaltechnique.com/wordpress/top-of-every-post/
Description: Add some content to the top of each post.
Version: 1.0
Author: Corey Salzano
Author URI: http://profiles.wordpress.org/users/salzano/
License: GPL2
*/


/*
	avoid a name collision, make sure this function is not
	already defined */

if( !function_exists("top_of_every_post")){
	function top_of_every_post($content){

	/*	there is a text file in the same directory as this script */

		$fileName = dirname(__FILE__) ."/top_of_every_post.txt";

	/*	we want to change `the_content` of posts, not pages
		and the text file must exist for this to work */

		if( !is_page( ) && file_exists( $fileName )){

		/*	open the text file and read its contents */

			$theFile = fopen( $fileName, "r");
			$msg = fread( $theFile, filesize( $fileName ));
			fclose( $theFile );

		/*	append the text file contents to the beginning of `the_content` */
			return stripslashes( $msg ) . $content;
		} else{

		/*	if `the_content` belongs to a page or our file is missing
			the result of this filter is no change to `the_content` */

			return $content;
		}
	}

	/*	add our filter function to the hook */

	add_filter('the_content', 'top_of_every_post');
}

?>