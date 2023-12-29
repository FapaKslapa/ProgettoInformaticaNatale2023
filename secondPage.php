<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica - Marocco</title>
    <link href="https://fonts.cdnfonts.com/css/coolvetica-2" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/made-tommy-soft-outline" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/paytone-one" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/made-tommy-outline" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="./src/style.css" rel="stylesheet" type="text/css"/>
</head>
<?php
session_start();
if (!array_key_exists("carrello", $_SESSION) || empty($_SESSION["carrello"]))
    $_SESSION["carrello"] = [];
if (!array_key_exists("carrelloTotale", $_SESSION) || empty($_SESSION["carrelloTotale"]))
    $_SESSION["carrelloTotale"] = [];
$_SESSION["carrelloTotale"][] = $_SESSION["carrello"];
$_SESSION["carrello"] = [];
?>
<body>
<div class="container">
    <h1>Spesa di: Stefano Marocco</h1>
    <div class="row">
        <div class="card card-body">
            <h3 class="card-title text-white">Riepilogo</h3>
            <table class="table-custom text-white">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Prodotto</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Prezzo al dettaglio</th>
                    <th scope="col">Prezzo totale</th>
                </tr>
                </thead>
                <?php
                for ($i = 0; $i < count($_SESSION["carrelloTotale"]); $i++) {
                    for ($j = 0; $j < count($_SESSION["carrelloTotale"][$i]); $j++) {
                        echo "<tr>";
                        echo "<td>" . $_SESSION["carrelloTotale"][$i][$j]["id"] . "</td>";
                        echo "<td>" . $_SESSION["carrelloTotale"][$i][$j]["categoria"] . "</td>";
                        echo "<td>" . $_SESSION["carrelloTotale"][$i][$j]["prodotti"] . "</td>";
                        echo "<td>" . $_SESSION["carrelloTotale"][$i][$j]["numeri"] . "</td>";
                        echo "<td>" . $_SESSION["carrelloTotale"][$i][$j]["prezzoSingolo"] . "€</td>";
                        echo "<td>" . floatval($_SESSION["carrelloTotale"][$i][$j]["prezzoSingolo"]) * floatval($_SESSION["carrelloTotale"][$i][$j]["numeri"]) . "€</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <br>
            <div class="alert alert-secondary" role="alert">
                <?php
                $totale = 0;
                for ($i = 0; $i < count($_SESSION["carrelloTotale"]); $i++) {
                    for ($j = 0; $j < count($_SESSION["carrelloTotale"][$i]); $j++) {
                        $totale += floatval($_SESSION["carrelloTotale"][$i][$j]["prezzoSingolo"]) * floatval($_SESSION["carrelloTotale"][$i][$j]["numeri"]);
                    }
                }
                ?>
                <?php echo "<h3 class='text-center'>Totale: " . $totale . "€</h3>"; ?>
            </div>
            <br>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <button type="button" onclick="location.href='index.php';"
                            class="btn btn-primary rounded-pill">
                        <img
                                src="Icon/Shopping.svg" alt="Cassa"></button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
