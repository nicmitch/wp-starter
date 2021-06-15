<?php

function get_language_data(){

  if(!function_exists('icl_object_id')){
    return;
  }

  $languages = icl_get_languages('skip_missing=0&orderby=code');

  $data = array(
    'languages' => $languages,
    'current' => array(
      'language_code' => ICL_LANGUAGE_CODE,
      'index' => array_search(ICL_LANGUAGE_CODE,array_keys($languages)) + 1
    )
  );

  return $data;

}
