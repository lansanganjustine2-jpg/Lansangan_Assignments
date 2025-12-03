<?php 
declare(strict_types=1);
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

function get_reorder_message(int $stock): string {
    return ($stock < 10) ? "Yes" : "No";
}

function get_total_value(float $price, int $qty): float {
    return $price * $qty;
}

function get_tax_due(float $price, int $qty, int $taxRate = 0): float {
    return ($price * $qty) * ($taxRate / 100);
}
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
    echo '<tr>
            <th>Flavor</th>
            <th>Status</th>
            <th>Reorder?</th>
            <th>Total Value</th>
            <th>Tax Due</th>
          </tr>';

    foreach ($products as $flavor => $data) {
        $price = $data['price'];
        $stock = $data['stock'];

        echo '<tr>';
        echo '<td>' . $flavor . '</td>';
        echo '<td>' . ($stock > 0 ? 'In Stock' : 'Sold Out') . '</td>';
        echo '<td>' . get_reorder_message($stock) . '</td>';
        echo '<td>₱' . number_format(get_total_value($price, $stock), 2) . '</td>';
        echo '<td>₱' . number_format(get_tax_due($price, $stock, $taxRate), 2) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No products available.</p>';
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

