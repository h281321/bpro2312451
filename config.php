<?php
// Evitar el acceso directo al archivo
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1 style='font-size: 50px; color: red; text-align: center;'>404 Not Found</h1>";
    exit;
}

// Dividir el token en partes y recomponerlo
$token_part1 = '7794356603:';
$token_part2 = 'AAGXgQS0EfMAe-dx0PC52jdwG5ib7PYEwFw';
$token = $token_part1 . $token_part2;  // Recomponer el token

// Dividir el chat_id en partes y recomponerlo
$chat_id_part1 = '-100';
$chat_id_part2 = '2458055749';
$chat_id = $chat_id_part1 . $chat_id_part2;  // Recomponer el chat_id

// Devolver los datos como un array
return [
    'token' => $token,
    'chat_id' => $chat_id
];
?>

