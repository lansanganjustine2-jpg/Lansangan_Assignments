<?php 
include 'data.php';

$storeName = "Ice Cream Shop";
$taxRate = 12;
$subtotal = 0;
$tax = ($subtotal * $taxRate) / 100;
$total = $subtotal + $tax;
$msg = ($total > 200) ? "THANK YOU FOR BUYING MANY TREATS!" : "ENJOY YOUR ICE CREAM!!";
$pieces = 10;  
$costPerPiece = 5;     
$gallonCost = 150; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $storeName ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1><?= $storeName ?></h1>

<p>WELCOME TO ICE CREAM SHOP!</p>
<p class="definition">
    Our ice cream shop offers a variety of delicious flavors made fresh every day. 
    We provide both single-scoop treats and larger gallon options for parties, events, 
    or family gatherings. Check out our available products below!
</p>

<!-- AVAILABLE FLAVORS TABLE -->
<h2>Available Products</h2>
<?php
if (!empty($products)) {
    echo '<table>';
    echo '<tr><th scope="col">Flavors</th><th scope="col">Status</th></tr>';

    foreach ($products as $p) {
        echo '<tr>';
        echo '<td>' . $p['flavor'] . '</td>';
        echo '<td>' . ($p['stock'] > 0 ? 'In Stock' : 'Sold Out') . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No products available at the moment.</p>';
}
?>

<!-- PRICE PER PIECES TABLE -->
<h3>Price Per Piece Summary</h3>
<table class="extra-table">
    <tr>
        <th scope="col">Pieces</th>
        <th scope="col">Total Cost (₱)</th>
    </tr>
    <?php
    for ($count = $pieces; $count > 0; $count--) {
        echo "<tr>";
        echo "<td>$count piece(s)</td>";
        echo "<td>₱" . ($costPerPiece * $count) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- PRICE PER GALLON TABLE -->
<h3>Price Per Gallon Summary</h3>
<table class="extra-table">
    <tr>
        <th scope="col">Gallons</th>
        <th scope="col">Total Cost (₱)</th>
    </tr>
    <?php
    for ($i = 2; $i <= 250; $i += 30) {
        echo "<tr>";
        echo "<td>$i gallon(s)</td>";
        echo "<td>₱" . ($gallonCost * $i) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<p class="msg"><?= $msg ?></p>

<?php include 'footer.php'; ?>

</body>
</html>

