<?php

function getVimeoMP4($vimeo_id) {
  $vimeo = "https://vimeo.com/" . $vimeo_id;
  $vimeo_headers = get_headers($vimeo);
  if(!$vimeo_headers || $vimeo_headers[0] == 'HTTP/1.1 404 Not Found') {
    return "Video not found!";
  }
  
  $result = file_get_contents( "http://keepvid.com/?url=http%3A%2F%2Fvimeo.com%2F" . $vimeo_id );
  preg_match_all('/https:\/\/.*pdl.vimeocdn.com\/.*[a-z0-9]"/', $result, $matches);
  $res = explode('"', $matches[0][1]);
  return $res[0];
}

if(empty($_GET['id'])){
  echo "No video id is given";
} else {
  echo getVimeoMP4($_GET['id']);
}

?>