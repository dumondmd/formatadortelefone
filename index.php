<?php
$handle = fopen("contato.csv", "r");

$contatos = [];


while ($line = fgetcsv($handle, 1000, ",")) {
    array_push($contatos, $line[0]);
}


echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<ul>    

';
$contador = 1;
foreach ($contatos as $key => $value) {
    echo "<li>" . formatar($value, $contador++) . "</li>";
}


echo '
</ul>
</body>
</html>
';

// 6291724083
// 62 8138-1971

function formatar($val, $contador)
{
    $val = trim($val);
    $val = str_replace("(", "", $val);
    $val = str_replace(")", "", $val);
    $val = str_replace("+55", "", $val);
    $val = str_replace("+", "", $val);
    $val = str_replace("-", "", $val);
    $val = str_replace(" ", "", $val);

    if (substr($val, 0, 2) == '55') {
        $val = substr($val, 2);
    }

    if (substr($val, 0, 1) == '0') {
        $val = substr($val, 1);
    }

    if (substr($val, -9, 1) == '9' && strlen($val) > 10) {
        $pre = substr($val, 0, 2);
        $val = $pre . substr($val, 3, 9);

    }


    if (substr($val, -9, 1) == '9' && strlen($val) == 9) {
        $val = substr($val, -8, 8);

    }

    

    return $val . ',';
}



fclose($handle);
?>
