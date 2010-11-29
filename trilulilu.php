<?php
/*
Plugin Name: Trilulilu Embed
Plugin URI: http://www.vesavlad.co.cc/
Description: Plugin for showing embed movies and audio for the trilulilu.ro website. The actual version of the plugins supports the new link formats for video, audio and images.
Version: 0.2a
Author: Vesa Vlad
Author URI: http://www.vesavlad.co.cc
*/

define ('trilulilu_VERSION', '0.2a');
	
$triluliluembed='<div align="center"><embed src="http://embed.trilulilu.ro/::what::/::username::/::hash::.swf" type="application/x-shockwave-flash" allowFullScreen="true" wmode="transparent" width="::width::" height="::height::" flashvars="username=::username::&hash=::hash::&miniMode=::minimode::"></embed></div><br />';

function trilulilu_convert($content='')
{
	global $triluliluembed;
	$audio['width'] = get_option('trilulilu-audio-width');
	$audio['height'] = get_option('trilulilu-audio-height');
	$video['width']	= get_option('trilulilu-video-width');
	$video['height'] = get_option('trilulilu-video-height');
	$result=$content;
	while(ereg("\[trilu-video\].{24}[a-zA-Z0-9_]+\/[a-z0-9]{14}\[\/trilu-video\]",$result,$videoid))
	{			
		$code = substr($videoid[0], 37, -14);
		list($tuser,$thash)=explode("/",$code);
		$replace_str=str_replace("::hash::",$thash,$triluliluembed);	
		$replace_str=str_replace("::username::",$tuser,$replace_str);
		$replace_str=str_replace("::width::",$video['width'],$replace_str);	
		$replace_str=str_replace("::height::",$video['height'],$replace_str);	
		$replace_str=str_replace("::minimode::","false",$replace_str);
		$replace_str=str_replace("::what::","video",$replace_str);	
		$result = str_replace($videoid[0],$replace_str,$result);
	}
	while(ereg("\[trilu-audio\].{24}[a-zA-Z0-9_]+\/[a-z0-9]{14}\[\/trilu-audio\]",$result,$videoid))
	{			
		$video = substr($videoid[0], 37, -14);
		list($tuser,$thash)=explode("/",$video);
		$replace_str=str_replace("::hash::",$thash,$triluliluembed);	
		$replace_str=str_replace("::username::",$tuser,$replace_str);	
		$replace_str=str_replace("::width::",$audio['width'],$replace_str);	
		$replace_str=str_replace("::height::",$audio['height'],$replace_str);
		$replace_str=str_replace("::what::","audio",$replace_str);
		if($audio['height']>=80)
			$replace_str=str_replace("::minimode::","false",$replace_str);
		else
			$replace_str=str_replace("::minimode::","true",$replace_str);
		$result = str_replace($videoid[0],$replace_str,$result);
	}
	while(ereg("\[trilu-image\].{24}[a-zA-Z0-9_]+\/[a-z0-9]{14}\[\/trilu-image\]",$result,$videoid))
	{			
		$video = substr($videoid[0], 39, -16);
		list($tuser,$thash)=explode("/",$video);
		$replace_str=str_replace("::hash::",$thash,$triluliluembed);	
		$replace_str=str_replace("::username::",$tuser,$replace_str);	
		$replace_str=str_replace("::height::",386,$replace_str);	
		$replace_str=str_replace("::what::","image",$replace_str);	
		$result = str_replace($videoid[0],$replace_str,$result);
	}

	return $result;
}

//administration menu


function trilulilu_options_menu() {

  add_options_page('Trilulilu Options', 'Trilulilu Embed', 'manage_options', 'trilulilu_embed', 'trilulilu_options');

}

function trilulilu_options() {

  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

	include("_administration/functions.php");

}

add_action('admin_menu', 'trilulilu_options_menu');
add_filter('the_content', 'trilulilu_convert');
?>
