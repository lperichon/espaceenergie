<?php
#-----------------------------------------
#	RT-Theme wpml_functions.php
#	version: 1.0
#-----------------------------------------


#
# WPML match page id
#
function wpml_page_id($id){
	if(function_exists('icl_object_id')) {
		return icl_object_id($id,'page',true);
	} else {
		return $id;
	}
}


#
# WPML match categories
#
function wpml_lang_object_ids($ids_array, $type) {
	if(function_exists('icl_object_id')) {
		$res = array();
		foreach ($ids_array as $id) {
			$xlat = icl_object_id($id,$type,false);
			if(!is_null($xlat)) $res[] = $xlat;
		}
		return $res;
	} else {
		return $ids_array;
	}
}


#
# Get WPML Plugin Flags
#
function languages_list(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
	if(!empty($languages)){
		echo '<ul class="flags">';
		foreach($languages as $l){
			echo '<li>';
			if($l['country_flag_url']){
			    echo '<a href="'.$l['url'].'" title="'.$l['native_name'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a>';
			}
			echo '</li>';
		}
		echo '</ul>';
	}
}


#
#	WPML Home URL
#
function wpml_get_home_url(){
	if(function_exists('icl_get_home_url')){
	    return icl_get_home_url();
	}else{
	    return rtrim(get_bloginfo('url') , '/') . '/';
	}
}

#
#	WPML String Register
#
function wpml_register_string($context, $name, $value){
	if(function_exists('icl_register_string') && trim($value)){
		icl_register_string($context, $name, $value);
	}    
}

#
#	WPML Get Registered String
#
function wpml_t($context, $name, $original_value){
    if(function_exists('icl_t')){
        return icl_t($context, $name, $original_value);
    }else{
        return $original_value;
    }
}


#
#	String Registration
#
wpml_register_string( THEMESLUG , 'Footer Copyright Text', stripslashes(get_option(THEMESLUG.'_footer_copy')));
wpml_register_string( THEMESLUG , 'Breadcrumb Menu Text',  get_option(THEMESLUG.'_breadcrumb_text'));


?>