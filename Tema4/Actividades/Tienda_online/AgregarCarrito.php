<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            if (isset($_COOKIE['carrito'])) {
                $carrito = json_decode($_COOKIE['carrito'], true);

                if (array_key_exists($id, $carrito)) {
                    $carrito[$id]++;
                } else {
                    $carrito[$id] = 1;
                }
            } else {
                $carrito = [$id => 1];
            }

            setcookie('carrito', json_encode($carrito), time() + (86400 * 30), "/"); // 86400 = 1 día
            header("Location: index.php");
            exit;
        }
    }
?>
