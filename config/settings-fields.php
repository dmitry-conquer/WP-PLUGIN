<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

return [
  'show_results' => [
    'label'   => __( 'Show results' ),
    'type'    => 'number',
    'default' => 1,
  ],
  'post_types_to_search' => [
    'label'   => __( 'Enabled post types to search' ),
    'type'    => 'checkbox_list',
    'default' => [ 'post', 'page' ],
  ],
  'exclude_key_words' => [
    'label'   => __( 'Exclude from search' ),
    'type'    => 'textarea',
    'default' => 'thankyou, thank you',
  ],
]; 