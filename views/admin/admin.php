<?php

echo 'admin';


$video['url'] = ROOT_URI . 'assets/video/samplevideo.mp4';
echo '<pre>';
print_r( $video );
echo '</pre>';
echo '<pre>';
print_r( ROOT_URL );
echo '</pre>';
?>

<video id="lema-video" class="video-js vjs-default-skin lema-video-view">
    <source src="<?php echo $video['url'] ?>" type="video/mp4">
    <source src="<?php echo $video['url'] ?>" type="video/webm">
    <!-- <track kind="captions" src="http://wp.solazu.net/learnmaster/wp-content/plugins/learnmaster/front/assets/libs/videojs/examples/example-captions.vtt" srclang="en" label="English" default></track>
	<track kind="captions" src="http://wp.solazu.net/learnmaster/wp-content/plugins/learnmaster/front/assets/libs/videojs/examples/example-captions.vtt" srclang="ja" label="Japanese"></track> -->
</video>














































