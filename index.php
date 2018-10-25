<?php
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');


if (($handle = fopen("produtos.csv", "r")) !== FALSE) {
    $csvs = [];
    while(! feof($handle)) {
       $csvs[] = fgetcsv($handle);
    }
    $datas = [];
    $column_names = [];
    foreach ($csvs[0] as $single_csv) {
        $column_names[] = $single_csv;
    }
    foreach ($csvs as $key => $csv) {
        if ($key === 0) {
            continue;
        }
        foreach ($column_names as $column_key => $column_name) {
            $datas[$key-1][$column_name] = $csv[$column_key];
        }
    }
    
    $json = json_encode($datas, JSON_PRETTY_PRINT);
    fclose($handle);

    $product_json = fopen("produtos.json", "w+");
 
	// Write
	$file_write = fwrite($product_json, $json);
	 
	// close file
	fclose($product_json);
}

if ($method === 'GET') {
	echo $json;
}


