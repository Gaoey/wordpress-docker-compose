<?php

/**
 * @package  PetShelterPlugin
 */
/*
Plugin Name: Pet Shelter Plugin
Plugin URI: 
Description: For Pet shelter intragration
Version: 1.0.0
Author: GATON
Author URI: 
License: GATON
Text Domain: pet-shelter-plugin
*/

/*
this program for integration in petshelter website
*/

defined('ABSPATH') or die('ABSPATH error');

class PetShelt
{
  function __construct()
  {
    add_action('init', array($this, 'custom_post_type'));
    add_action('init', array($this, 'update_data_from_external_api'));
  }

  function activate()
  {
    // generated a CPT
    $this->custom_post_type();
    $this->update_data_from_external_api();
    // flush rewrite rules - auto refresh plugin
    flush_rewrite_rules();
  }

  function deactivate()
  {
    // flush rewrite rules
    flush_rewrite_rules();
  }

  function custom_post_type()
  {
    register_post_type('shelter', ['public' => true, 'label' => 'Shelter']);
    register_post_type('pet', ['public' => true, 'label' => 'Pet']);
  }


  // GATON
  function update_data_from_external_api()
  {

    // global $wp_version;

    // $args = array(
    //   'timeout'     => 5,
    //   'redirection' => 5,
    //   'httpversion' => '1.0',
    //   'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
    //   'blocking'    => true,
    //   'body'        => null,
    //   'compress'    => false,
    //   'decompress'  => true,
    //   'sslverify'   => false,
    //   'stream'      => false,
    //   'filename'    => null
    // );

    $response = wp_remote_get('https://jsonplaceholder.typicode.com/posts');
    $response = json_encode($response); // Takes a mixed value and converts it to JSON string
    $data = json_decode($response); // Convert JSON string to PHP variable

    // echo_log($item);
    foreach ($data as $item) {

      // Check if post exist allready in WP
      $existing_posts = get_posts(array('post_type' => 'shelter', 'numberposts' => -1));
      $api_ids = array();
      foreach ($existing_posts as $post) {
        $id = get_post_meta($item->ID, 'api_id', true);
        array_push($api_ids, $id);
      }

      if (in_array($item->id, $api_ids)) {
        error_log('post allready exists');
      } else {

        // New post data object to set as a post
        $new_post = array(
          'post_type'     => 'shelter',
          'post_title'    => $item->title,
          'post_status'   => 'publish',
          'post_author'   => 1,
          'post_content'  => $item->body,
          'meta_input' => array(
            'api_id' => $item->id,
          )
        );

        // Insert the post into the database
        echo_log($new_post);
        wp_insert_post($new_post);
      }
    }
  }
}

if (class_exists('PetShelt')) {
  $petsheltPlugin = new PetShelt();
}

/* Echo variable
 * Description: Uses <pre> and print_r to display a variable in formated fashion
 */
function echo_log($data)
{
  if (isJson($data)) {
    $output = "<pre>" . print_r($data, true) . "</pre>";
  } else if (is_array($data)) {
    $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
  } else {
    $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
  }

  echo $output;
}

function isJson($string)
{
  json_decode($string);
  return (json_last_error() == JSON_ERROR_NONE);
}


// activation
register_activation_hook(__FILE__, array($petsheltPlugin, 'activate'));

// deactivation
register_deactivation_hook(__FILE__, array($petsheltPlugin, 'deactivate'));
