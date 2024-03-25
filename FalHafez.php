<?php
header('Content-type: application/json;');
$result = file_get_contents('https://www.hafez.it/tabir/');
preg_match('/<audio\s.*?src=[\'"](.*?)[\'"].*?<\/audio>/i', $result, $matches);
preg_match_all('/<p\b[^>]*>(.*?)<\/p>/i', $result, $pMatches);
$count = count($pMatches[0]);
$pMatches[0] = array_slice($pMatches[0], 0,  $count - 2);
array_shift($pMatches[0]);
foreach ($pMatches[0] as $pTag) {
    $Fal .= "$pTag";
}
$resultWithoutPTags = preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', "$1\n", $Fal);
echo json_encode([
    'status' => 200,
    'dev' => ajcode,
    'result' => [
        'voice' => $matches[1],
        'text' => $resultWithoutPTags,
    ]
], 448);
?>
