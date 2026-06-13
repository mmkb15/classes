<?php
/* 
Create an associative array of 5 elements 
where index (key) = Country Name 
and value = Capital Name.
Sort by Country Name and Print.
*/

// Step 1: Create Associative Array
$countries = [
    "Bangladesh" => "Dhaka",
    "India"      => "New Delhi",
    "Pakistan"   => "Islamabad",
    "Sri Lanka"  => "Colombo",
    "Nepal"      => "Kathmandu"
];

// Step 2: Sort the array by Country Name (Key)
ksort($countries);   // ksort() sorts by keys

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country & Capital</title>
</head>
<body>
    <h2>Country and Their Capitals (Sorted)</h2>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Country</th>
            <th>Capital</th>
        </tr>
        
        <?php
        foreach($countries as $country => $capital) {
            echo "<tr>";
            echo "<td><b>$country</b></td>";
            echo "<td>$capital</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>