<?php
/**
 *
 * Boots up all the information necessary to output the search function for the inLine theme.
 *
 * @package inLine
 *
 */
 
add_action( 'inline_search_form', 'inline_do_search_form' );
/**
 *
 * This takes care of the WordPress search functionality.
 *
 * The following filters are added to this function by default:
 *
 * inline_search_text
 *
 * @since 1.0
 *
 */
function inline_do_search_form() {

	$search_text = 'Type your search and hit enter';
	apply_filters( 'inline_search_text', __( $search_text, 'inline' ) ); ?>

	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>"> 
		<input type="text" value="<?php echo $search_text; ?>" name="s" id="s" onblur="if ( this.value == '' ) { this.value = '<?php echo $search_text; ?>'; }" onfocus="if ( this.value == '<?php echo $search_text; ?>' ) { this.value = ''; }" />
		<input type="hidden" id="searchsubmit" /> 
	</form>

<?php }

/**
 *
 * This is added to the inline_alternate_loop hook if no search results are displayed for a query.
 *
 * The following filters are added to this function by default:
 *
 * inline_query_no_results_text
 *
 * @since 1.0
 *
 */
function inline_search_no_results() {

	echo '<div class="retry">';
		echo '<p>';
			echo apply_filters( 'inline_query_no_results_text', __( 'We are sorry, but it seems that your search has returned no results. Please try again using the search form below.', 'inline' ) );
		echo '</p>';
		
		get_search_form();
		
	echo '</div><!--end .retry-->';

}