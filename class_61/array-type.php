<?php
    /* 
        1. Numaric / Index Array
        2. Associative Array
        3. Multidimensional Array
    */

    #1. Numaric / Index Array
    $arr_num = array(
        "a", 
        "b", 
        true, 
        325
    );

    // echo"<pre>";
    // var_dump($arr_num);
    // var_dump($arr_num[0]);
    // echo"</pre>";

    #2. Associative Array
    $arr_assoc = [
        "name"      =>  "mmk",
        "age"       =>  30 ,
        "Address"   =>  "Dhaka",
        "Bool"   =>  false
    ];

    // echo"<pre>";
    // var_dump($arr_assoc);
    // var_dump($arr_assoc["name"]);

    // // print_r($arr_assoc);

    // echo"</pre>";



    #3. Multidimensional Array
    $arr_multi = [
        [
            ["a", "b" , "c"],
                "name" => "multi array",
            [1, 2, 3, 4],
                "de" => "Jone",
                "age" => 54,
                "email" => [
                    "e1" => "j@j1.com",
                    "e2" => "j@jd1.com",

            ],
        ],

        [
            ["a", "b" , "c"],
                "name" => "multi array",
            [1, 2, 3, 4],
                "de" => "Jone",
                "age" => 54,
                "email" => [
                    "e1" => "j@j1.com",
                    "e2" => "j@jd1.com",

            ],
        ]
    ]
    ;

     $arr_multi[0]["email"]["e1"] = "mmmursalinkhan@gmail.com";
     $arr_multi[0]["de"] = "Mursalin";
    echo"<pre>";
    echo  var_dump($arr_multi);
    echo"</pre>";
    echo "<br>";
    // echo  $arr_multi["email"]["e1"];
    //  echo "<br>";
    // echo  $arr_multi[1][1];
?>