<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <title>Comprar</title>
</head>

<body>
    <?php require_once '../src/auxiliar.php';

    if (!\Tablas\Usuario::esta_logueado()) {
        return redirigir_login();
    }

    $carrito = unserialize(carrito());

    if (obtener_post('_testigo') !== null) {
        // Crear factura
        $pdo = conectar();
        $usuario_id = \Tablas\Usuario::logueado();
        $sent = $pdo->prepare('INSERT INTO facturas (usuario_id)
                               VALUES (:usuario_id)');
        $sent->execute([':usuario_id' => $usuario_id]);

    }

    ?>

    <div class="container mx-auto">
        <?php require_once '../src/_menu.php' ?>
        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
            <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="py-3 px-6">Descripción</th>
                    <th scope="col" class="py-3 px-6">Cantidad</th>
                    <th scope="col" class="py-3 px-6">Precio</th>
                    <th scope="col" class="py-3 px-6">Importe</th>
                </thead>
                <tbody>
                    <?php $total = 0 ?>
                    <?php foreach ($carrito->getLineas() as $id => $linea) : ?>
                        <?php
                        $articulo = $linea->getArticulo();
                        $cantidad = $linea->getCantidad();
                        $precio = $articulo->precio;
                        $importe = $cantidad * $precio;
                        $total += $importe;
                        ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6"><?= $articulo->descripcion ?></td>
                            <td class="py-4 px-6 text-center"><?= $cantidad ?></td>
                            <td class="py-4 px-6 text-center">
                                <?= number_format($precio, 2, ',', ' ') . ' €' ?>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <?= number_format($importe, 2, ',', ' ') . ' €' ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <td></td>
                    <td></td>
                    <td class="text-right">Importe:</td>
                    <td><?= number_format($total, 2, ',', ' ') . ' €' ?></td>
                </tfoot>
            </table>
            <form action="" method="POST" class="mx-auto flex mt-4">
                <input type="hidden" name="_testigo" value="1">
                <button type="submit" href="" class="mx-auto focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Realizar pedido</button>
            </form>
        </div>
    </div>
    <script src="/js/flowbite/flowbite.js"></script>
</body>

</html>
