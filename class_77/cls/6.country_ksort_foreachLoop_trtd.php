<?php

$countries = [
    "USA"           => "Washington",
    "Japan"         => "Tokyo",
    "Bangladesh"    => "Dhaka",
    "Pakistan"      => "Islamabad",
    "Maldiv"        => "Katmundu"
];

$beforeSort = $countries;
ksort($countries);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1. Country Name Sort</title>
</head>
<body>
    <h2>Before Sort Country Name</h2>
    <table border=1 width=300>
        <tr>
            <th>Country</th>
            <th>Capital</th>
        </tr>
    <?php  foreach($beforeSort as $country => $capital) : ?>
        <tr>
            <td><?= $country?></td>
            <td><?= $capital?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <br>
    <h2>After Sort Country Name</h2>
    <table border=1 width=300>
        <tr>
            <th>Country</th>
            <th>Capital</th>
        </tr>
    <?php  foreach($countries as $country => $capital) : ?>
        <tr>
            <td><?= $country?></td>
            <td><?= $capital?></td>
        </tr>
    <?php endforeach; ?>
    </table>

</body>
</html>