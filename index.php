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

$name = $surname = "";
$quantita = 1;
$quantitaErr = $selectErr = $nameErr = $surnameErr = "";
$check = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dati = $_POST;
    if (empty($dati["numeri"])) {
        $quantitaErr = '<div class="alert alert-danger" role="alert">Seleziona la quantità</div>';
        $check = false;
    } else
        $quantita = $dati["numeri"];
    if (empty($dati["nome"])) {
        $nameErr = '<div class="alert alert-danger" role="alert">Inserisci un nome</div>';
        $check = false;
    } else
        $name = $dati["nome"];
    if (empty($dati["cognome"])) {
        $surnameErr = '<div class="alert alert-danger" role="alert">Inserisci un cognome</div>';
        $check = false;
    } else
        $surname = $dati["cognome"];
    if (empty($dati["prodotti"]) || $dati["prodotti"] == 0) {
        $selectErr = '<div class="alert alert-danger" role="alert">Seleziona un prodotto</div>';
        $check = false;
    } else
        $select = $dati["prodotti"];
}
if (!array_key_exists("carrello", $_SESSION) || empty($_SESSION["carrello"]))
    $_SESSION["carrello"] = [];
$categorie = array(
    'Ortofrutta' => array(
        'Mela' => 1.50, 'Banana' => 0.80, 'Arancia' => 1.20, 'Uva' => 2.00, 'Fragola' => 2.50,
        'Carota' => 0.60, 'Pomodoro' => 1.00, 'Zucchina' => 1.20, 'Peperone' => 1.30, 'Insalata' => 1.80
    ),
    'Carne' => array(
        'Pollo' => 5.00, 'Manzo' => 8.50, 'Maiale' => 6.00, 'Agnello' => 10.00, 'Vitello' => 9.00,
        'Salsiccia' => 4.50, 'Prosciutto' => 7.20, 'Salame' => 6.80, 'Filetto' => 12.50, 'Cotechino' => 5.50
    ),
    'Pesce' => array(
        'Salmone' => 9.50, 'Tonno' => 8.00, 'Branzino' => 11.00, 'Merluzzo' => 7.50, 'Acciuga' => 5.80,
        'Gamberetto' => 12.00, 'Calamaro' => 6.50, 'Orata' => 10.50, 'Spigola' => 11.20, 'Sogliola' => 8.80
    ),
    'Prodotti_Freschi' => array(
        'Latte' => 1.80, 'Uova' => 2.50, 'Formaggio' => 3.50, 'Yogurt' => 1.20, 'Panna' => 1.50,
        'Burro' => 2.00, 'Pane' => 1.00, 'Pasta Fresca' => 2.50, 'Salsa Fresca' => 2.80, 'Insalata Pronta' => 3.00
    ),
    'Surgelati' => array(
        'Pizza' => 4.50, 'Gelato' => 3.00, 'Verdura Surgelata' => 2.20, 'Pesce Surgelato' => 6.80,
        'Pollo Surgelato' => 5.50, 'Patatine' => 2.00, 'Hamburger Surgelati' => 4.00, 'Frutta Surgelata' => 3.50,
        'Lasagna Surgelata' => 7.50, 'Pasticcio Surgelato' => 6.00
    )
);
?>

<body>
<div class="container">
    <h1>Acquista prodotti</h1>
    <div class="row">
        <div class="card card-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-auto">
                            <label for="nome" class="text-white">Nome</label>
                            <input type="text" class="form-control rounded-pill" placeholder="Nome" name="nome"
                                   value="<?php echo $name ?>">
                            <p><?php echo $nameErr; ?></p>
                        </div>
                        <div class="col-auto">
                            <label for="cognome" class="text-white">Cognome</label>
                            <input type="text" class="form-control rounded-pill" placeholder="Cognome" name="cognome"
                                   value="<?php echo $surname ?>">
                            <p><?php echo $surnameErr; ?></p>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row justify-content-start">
                        <div class="col-auto">
                            <label for="prodotti" class="text-white">Seleziona un prodotto</label>
                            <select class="form-select rounded-pill" aria-label="Seleziona il prodotto" name="prodotti"
                                    id="prodotti">
                                <?php
                                foreach ($categorie as $categoria => $prodotti) {
                                    echo '<option disabled class="text-center">- ' . ucfirst(str_replace('_', ' ', $categoria)) . ' -</option>';
                                    foreach ($prodotti as $prodotto => $prezzo) {
                                        echo '<option value="' . $prodotto . '">' . ucfirst($prodotto) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <p><?php echo $selectErr; ?></p>
                        </div>
                        <div class="col-auto">
                            <label for="numeri" class="text-white">Seleziona la quantità</label>
                            <input type="number" class="form-control rounded-pill" placeholder="Quantità" min="1"
                                   name="numeri" id="quantita" value="<?php echo $quantita ?>">
                            <p><?php echo $quantitaErr; ?></p>
                        </div>
                        <div class="col-auto">
                            <label for="categoria" class="text-white">Categoria</label>
                            <input type="text" class="form-control rounded-pill"
                                   value="-" name="categoria" id="categoria">
                        </div>
                        <div class="col-auto">
                            <label for="prezzoSingolo" class="text-white">Prezzo al dettaglio</label>
                            <input type="text" class="form-control rounded-pill"
                                   value="-" name="prezzoSingolo" id="prezzoSingolo">
                        </div>
                        <div class="col-auto">
                            <label for="prezzoTotale" class="text-white">Prezzo per quantità</label>
                            <input type="text" class="form-control rounded-pill"
                                   value="-" name="prezzoTotale" id="prezzoTotale">
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-auto">
                            <button title="Aggiungi al carrello" type="submit" class="btn btn-primary rounded-pill"><img
                                        src="Icon/Add.svg" alt="Aggiungi al carrello"></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($check) {
            str_replace("€", "  ", $dati["prezzoSingolo"]);
            $dati["id"] = uniqid();
            $dati["categoria"] = $_POST["categoria"];
            $dati["prezzoSingolo"] = $_POST["prezzoSingolo"];
            $dati["prezzoTotale"] = $_POST["prezzoTotale"];
            $_SESSION["carrello"][] = $dati;
            $_SESSION["carrello"][count($_SESSION["carrello"]) - 1]["prezzoSingolo"] = str_replace("€", "", $_SESSION["carrello"][count($_SESSION["carrello"]) - 1]["prezzoSingolo"]);
            $quantita = 1;
        }
    }
    ?>
    <br>
    <div class="row">
        <div class="card card-body">
            <h3 class="card-title text-white">
                Carrello
            </h3>
            <table class="table-custom text-white">
                <thead>
                <tr>
                    <th scope="col">Prodotto</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Prezzo al dettaglio</th>
                </tr>
                </thead>
                <?php
                for ($i = 0; $i < count($_SESSION["carrello"]); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["carrello"][$i]["prodotti"] . "</td>";
                    echo "<td>" . $_SESSION["carrello"][$i]["numeri"] . "</td>";
                    echo "<td>" . $_SESSION["carrello"][$i]["prezzoSingolo"] . "€</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <br>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <button type="button" onclick="location.href='secondPage.php';"
                            class="btn btn-primary rounded-pill">
                        <img
                                src="Icon/Shopping.svg" alt="Cassa"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module" src="./src/script.js"></script>

</body>
</html>