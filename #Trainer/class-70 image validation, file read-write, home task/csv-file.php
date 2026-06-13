<?php
// $file = fopen("students.csv","a+");
// fputcsv($file,[2,"Raju","70"]);
// fclose($file);

$file = fopen("students.csv","r");
// print_r(fgetcsv($file));
// print_r(fgetcsv($file));
// print_r(fgetcsv($file));
// var_dump(fgetcsv($file));

while($row = fgetcsv($file)){
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    echo "ID: {$row[0]}<br>";
    echo "Name: {$row[1]}<br>";
    echo "Batch: {$row[2]}<br>";
    echo "<br>";
}
fclose($file);
?>