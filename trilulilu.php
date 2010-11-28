<?php
/*
Plugin Name: Trilulilu Embed
Plugin URI: http://www.vesavlad.co.cc/
Description: Plugin for showing embed movies and audio for the trilulilu.ro website. The actual version of the plugins supports the new link formats for video, audio and images.
Version: 0.1
Author: Vesa Vlad
Author URI: http://www.vesavlad.co.cc
*/


define ('trilulilu_VERSION', '0.1');

$triluliluembed='<div align="center"><embed src="http://embed.trilulilu.ro/::what::/::username::/::hash::.swf" type="application/x-shockwave-flash" allowFullScreen="true" wmode="transparent" width="448" height="::height::" flashvars="username=::username::&hash=::hash::&miniMode=false"></embed></div><br />';

function trilulilu_convert($content='')
{
	global $triluliluembed;

	$result=$content;
	while(ereg("\[trilu-video\].{24}[a-zA-Z0-9_]+\/[a-z0-9]{14}\[\/trilu-video\]",$result,$videoid))
	{			
		$video = substr($videoid[0], 37, -14);
		list($tuser,$thash)=explode("/",$video);
		$replace_str=str_replace("::hash::",$thash,$triluliluembed);	
		$replace_str=str_replace("::username::",$tuser,$replace_str);	
		$replace_str=str_replace("::height::",386,$replace_str);	
		$replace_str=str_replace("::what::","video",$replace_str);	
		$result = str_replace($videoid[0],$replace_str,$result);
	}
	while(ereg("\[trilu-audio\].{24}[a-zA-Z0-9_]+\/[a-z0-9]{14}\[\/trilu-audio\]",$result,$videoid))
	{			
		$video = substr($videoid[0], 37, -14);
		list($tuser,$thash)=explode("/",$video);
		$replace_str=str_replace("::hash::",$thash,$triluliluembed);	
		$replace_str=str_replace("::username::",$tuser,$replace_str);	
		$replace_str=str_replace("::height::",80,$replace_str);	
		$replace_str=str_replace("::what::","audio",$replace_str);
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


add_filter('the_content', 'trilulilu_convert');
?>
