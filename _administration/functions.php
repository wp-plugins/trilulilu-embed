<?php
	if(isset($_POST['trilulilu-audio-update']))
	{
		$audio['width'] = $_POST['audio-width'];
		$audio['height']= $_POST['audio-height'];
		update_option('trilulilu-audio-width',$audio['width']);
		update_option('trilulilu-audio-height',$audio['height']);
	}
	if(isset($_POST['trilulilu-video-update']))
	{
		$video['width'] = $_POST['video-width'];
		$video['height'] = $_POST['video-height'];
		update_option('trilulilu-video-width',$video['width']);
		update_option('trilulilu-video-height',$video['height']);
	}
	$audio['width'] = get_option('trilulilu-audio-width');
	$audio['height'] = get_option('trilulilu-audio-height');
	$video['width']	= get_option('trilulilu-video-width');
	$video['height'] = get_option('trilulilu-video-height');
	function get_latest_news() {
	  wp_widget_rss_output('http://www.vesavlad.co.cc/feed', array('show_author' => 0, 'show_date' => 1, 'show_summary' => 1, 'items' => 3));
	  exit();
	}
?>
<style type="text/css">
	#trilulilu-wrap{background-color:#fff; border-radius:5px; border:1px #ccc solid; padding:5px; margin-top:35px; width:70%; float:left; margin-right:10px;}
	#trilulilu-rss-flux{background-color:#fff; border-radius:5px; border:1px solid #ccc; padding:5px; margin-top:35px; width:25%; float:left; }
	ul.trilulilu{list-style:none; margin-bottom:5px;}
	.trilulilu li{display:inline; border:1px solid #ccc; border-bottom:none; padding:5px; margin-bottom:5px;}
	.trilulilu li.inactive{background-color:#CCC;}
	.trilulilu li a{text-decoration:none; font-weight:bold;}
	#trilulilu-content{border:1px solid #ccc; float:left; width:100%;}
	#trilulilu-content .video-options{padding:15px;}
	#trilulilu-content .audio-options{padding:15px;}
	#trilulilu-content .image-options{padding:15px;}
	
	.audio-options ul{margin: 0;padding: 0;list-style-type: none;}
	.audio-options ul li{float: left; display: inline ;margin-right: 10px;padding: 5px;border: 1px solid #fff;}
	.audio-options ul li.selected{border:1px solid #ccc;}
	.audio-options ul li .title{display: block;line-height: 14px;font-size: 11px;margin-bottom: 5px;}
	.audio-options ul li .audio-big{display: block;	background: #e9eff4;	border: 1px solid #ACBBC2;	width: 75px;	height: 20px;}
	.audio-options ul li .audio-little{display: block;	background: #e9eff4;border: 1px solid #ACBBC2;	width: 75px;	height: 10px;}
	
	.video-options ul{margin: 0;padding: 0;list-style-type: none;}
	.video-options ul li{float: left; display: inline ;margin-right: 10px;padding: 5px;border: 1px solid #fff;}
	.video-options ul li.selected{border:1px solid #ccc;}
	.video-options ul li .title{display: block;line-height: 14px;font-size: 11px;margin-bottom: 5px;}
	.video-options ul li .big{display: block;	background: #e9eff4;	border: 1px solid #ACBBC2;	width: 75px;	height: 40px;}
	.video-options ul li .medium{display: block;	background: #e9eff4;border: 1px solid #ACBBC2;	width: 60px;	height: 35px;}
	.video-options ul li .little{display: block;	background: #e9eff4;	border: 1px solid #ACBBC2;	width: 50px;	height: 25px;}

</style>
<script language="javascript">
function setOption(idElement){
		/* Total Tabs above the input field (in this case there are 3 tabs: web, images, videos) */
		tot_tab = 3;
		tab		= document.getElementById('tab'+idElement);
		block   = document.getElementById('option_'+idElement); 
		for(i=1; i<=3; i++){
			if(i==idElement){
				tab.setAttribute("class","selected");
				block.style.display="block";
			} else {
				document.getElementById('tab'+i).setAttribute("class","inactive");
				document.getElementById('option_'+i).style.display="none";
			}
		}
	}
function setEmbedoption(idElement, nrElemente, type, width, height){
	option	=	document.getElementById(type+'_option'+idElement);
	//alert("s-a ales optiunea "+idElement+" tipul "+type);
	for(i=1; i<=nrElemente; i++){
		if(i==idElement){
			option.setAttribute("class","selected");
			document.getElementById('custom_'+type+'_embed_width').setAttribute("value",width);
			document.getElementById('custom_'+type+'_embed_height').setAttribute("value",height);			
		} else {
			document.getElementById(type+'_option'+i).setAttribute("class","");
		}
	}
}
</script>
<div id="trilulilu-wrap">
	<h2><img src="<?php echo $plugin_url = get_bloginfo('wpurl'); ?>/wp-content/plugins/trilulilu-embed/_administration/images/trilulilu.jpg" alt="trilululu" height="45px" style="float:right;"/>Trilulilu Embed Settings</h2>
    <hr />
    <ul class="trilulilu">
    	<li class="" id="tab1"><a href="#" onclick="javascript:setOption(1);">Audio</a></li>
        <li class="inactive" id="tab2"><a href="#" onclick="javascript:setOption(2);">Video</a></li>
        <li class="inactive" id="tab3"><a href="#" onclick="javascript:setOption(3);">Images</a></li>
    </ul>
    <div id="trilulilu-content">
    	<div id="option_1" class="audio-options" style="display:block">
        			<form method="post" action="" name="audio-form">
                    <ul id="custom_embed_size_selector" style="margin:0 auto;">
						<li id="audio_option1" onclick="javascript:setEmbedoption(1,2,'audio',448,80);">
							<span class="title">
								Big
							</span>
							<span class="audio-big"></span>
                            <input type="hidden" name="audio-big" value="1" />
						</li>
						<li id="audio_option2" onclick="javascript:setEmbedoption(2,2,'audio',448,33);">
							<span class="title">
								Little
							</span>
							<span class="audio-little"></span>
                            <input type="hidden" name="audio-little" value="1" />
						</li>	
                        <input type="hidden" name="audio-width" id="custom_audio_embed_width" value="<?php echo $audio['width'];?>"/>
                        <input type="hidden" name="audio-height" id="custom_audio_embed_height" value="<?php echo $audio['height'];?>"/>				
					</ul>
                    <div style="width:100%; display:inline-block; text-align:center;"><input type="submit" name="trilulilu-audio-update" value="Update" /></div>
                    </form>
        </div>
        <div id="option_2" class="video-options" style="display:none">
        	<div style="width:100%; display:inline-block;">
            		<form method="post" action="" name="video-form">
            		<ul>
						<li id="video_option1" onclick="javascript:setEmbedoption(1,3,'video',600,485);">
							<span class="title">
								Big<br />600x485
							</span>
							<span class="big"></span>
						</li>
						<li id="video_option2" onclick="javascript:setEmbedoption(2,3,'video',448,386);">
							<span class="title">
								Medium<br />448x386
							</span>
							<span class="medium"></span>
						</li>
						<li id="video_option3" onclick="javascript:setEmbedoption(3,3,'video',320,275);">
							<span class="title">
								Little<br />320x275
							</span>
							<span class="little"></span>
						</li>	
						<li>
							<span class="title">
								Sau alege<br />altă dimensiune:
							</span>
							<span class="custom_dimens">
								<input type="text" name="video-width" id="custom_video_embed_width" style="width:38px;" value="<?php echo $video['width'];?>" /> x 
								<input type="text" name="video-height" id="custom_video_embed_height" style="width:38px;" value="<?php echo $video['height'];?>" />
								pixeli
							</span>
						</li>							
					</ul>
                    </div>
                    <div style="width:100%; display:inline-block; text-align:center;"><input type="submit" name="trilulilu-video-update" value="Update" /></div>
                    </form>
        </div>
        <div id="option_3" class="image-options" style="display:none">For the moment there is nothing implemented in this function!</div>
    </div>
</div>
<div id="trilulilu-rss-flux">
	<?php echo get_latest_news();?>
</div>