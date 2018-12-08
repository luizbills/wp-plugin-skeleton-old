<?php
/**
 * @version 1.1.1
 */

if ( ! defined( 'WPINC') ) exit(1);

$defaults = [
	'class' => '',
	'message' => 'Empty message'
];
$data = array_merge( $defaults, $data );
?>

<div class="notice <?php echo esc_attr( $data['class'] ); ?>">
	<p><?php echo $data['message']; ?></p>
</div>
