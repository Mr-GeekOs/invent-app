<?php

//////////////////////////////////////////////// Get domaine 
function getdomain($url) { 

	// get host name 
	$rest = substr($url, 0, 5);
	if ($rest=="https") {preg_match("/^(https:\/\/)?([^\/]+)/i", $url, $domain_only); }
	else {preg_match("/^(http:\/\/)?([^\/]+)/i", $url, $domain_only); }
	$host = str_replace("www.", "", $domain_only[2]); 
	
	if ($host == "youtube.com") {$s ="youtube";}
	else if ($host == "dailymotion.com") {$s ="dailymotion";}
	else if ($host == "vimeo.com") {$s ="vimeo";}
	else {$s ="err";}
	
	return $s; 
} 

//////////////////////////////////////////////// Valid url
function video_lecture($id,$srv)
{
	if ($srv=="youtube")
	{
		$rets = '
		<object width="480" height="360" style="z-index:-11111;">
		<param name="wmode" value="opaque">
		<param name="movie" value="http://www.youtube.com/v/'.$id.'?fs=1&amp;hl=fr_FR&amp;rel=0"></param>
    	<embed src="http://www.youtube.com/v/'.$id.'?fs=1&amp;hl=fr_FR&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="650" height="390" wmode="opaque"></embed>
</object>
				';
	}
	else if ($srv=="dailymotion")
	{ 
		$rets = '
		<object style="z-index:-11111;" width="480" height="360" data="http://www.dailymotion.com/swf/video/'.$id.'?start=null&hideInfos=0&autoplay=0&isInIframe=1&enableApi=0&_=" type="application/x-shockwave-flash">
		  <param value="http://www.dailymotion.com/swf/video/'.$id.'?start=null&hideInfos=0&autoplay=0&isInIframe=1&enableApi=0&_=" name="movie" wmode="opaque" />
		  <param name="wmode" value="opaque" />
		</object>
		';		
	}
	else if ($srv=="vimeo")
	{ 		
		$rets = '
	<object style="z-index:-11111;" height="360" width="480">
	<param name="allowscriptaccess" value="always">
	<param name="wmode" value="opaque">
	<param name="movie" 
value="http://www.vimeo.com/moogaloop.swf?clip_id='.$id.'&server=www.vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=00ADEF&fullscreen=1"> 
<embed 
src="http://www.vimeo.com/moogaloop.swf?clip_id='.$id.'&server=www.vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=00ADEF&fullscreen=1" 
type="application/x-shockwave-flash" allowfullscreen="true" 
allowscriptaccess="always" height="400" width="786" wmode="opaque"></object>
		';
	}
	else {$rets ="err";}
	
	return $rets;
}
//////////////////////////////////////////////// Get video id
function video_id($url,$srv) 
{        		
	if ($srv=="youtube")
	{ 		
		if (preg_match('%youtube\\.com/(.+)%', $url, $match)) {
                $match = $match[1];
               
			   $vars = explode("&", $match);
			   $match = $vars[0];
			    $replace = array("watch?v=", "v/", "vi/");
				$match = str_replace($replace, "", $match);
        }
     }
	 
	else if ($srv=="dailymotion")
	{
		$output = parse_url($url);
	
		// The part you want
		$url= $output['path'];
		$parts = explode('/',$url);
		$parts = explode('_',$parts[2]);
		
		$match = $parts[0];	
	}	 
	 
	 else if ($srv=="vimeo")
	 {
		$result = preg_match('/(\d+)/', $url, $matches);
    	$match = $matches[0];
	 }
	 else {$match ="err";}
	 
	 return $match;
}


//////////////////////////////////////////////// Get minauture
function lien_to_miniature($srv,$id)
{
	if ($srv=="youtube")
	{
		$mins = 'http://img.youtube.com/vi/'. $id . '/default.jpg' ;
	}
	else if ($srv=="dailymotion")
	{
		$mins = 'http://www.dailymotion.com/thumbnail/150x120/video/'. $id . '' ;
	} 
	else if ($srv=="vimeo")
	{
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
		$mins =  $hash[0]['thumbnail_small'];
	}
	else {$mins ="err";}
	
	return $mins; 
}


?>