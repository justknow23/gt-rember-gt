<?php
function readLocalFile($fileName){
    $handle = fopen($fileName, 'rb');
    $lines = [];
    while(!feof($handle)){
        $lines[] = fgets($handle);
    }
    fclose($handle);
    return $lines;
}

function readYieldFile($fileName){
    $handle = fopen($fileName, 'rb');
    while(!feof($handle)){
        yield fgets($handle);
    }
    fclose($handle);
}

function formatBytes($bytes){
    if ($bytes < 1024){
        return $bytes . "b";
    }else if($bytes < 1048576){
        return round($bytes / 1024, 2) . "kb";
    }
    return round($bytes / 1048576, 2) . "mb";
}

# 第一种
readLocalFile("./all.txt");
echo formatBytes(memory_get_peak_usage());
echo "\n";
# 第二种
$lines = readYieldFile("./all.txt");
foreach($lines as $row){
    print_r($row);
}
echo formatBytes(memory_get_peak_usage());
