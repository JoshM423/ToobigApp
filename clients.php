
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "toobig";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'id'; // Get the column to order by

// Retrieve clients data with specified ordering
$sql = "SELECT * FROM clients ORDER BY $orderBy";
$result = $connection->query($sql);

$clients = [];
if ($result->num_rows > 0) {
    // Fetch all rows and store them in the $clients array
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>Clients</h2>
        <div class="mb-3">
            <a class="btn btn-primary" href="/ToobigApp/crud/create.php" role="button">Add New Client</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><a href="/ToobigApp/clients.php?orderBy=id">ID</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=block">Block</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=lot">Lot</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=name">Name</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=email">Email</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=phone">Phone</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=previous">Previous</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=present">Present</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=consumption">Consumption</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=amount">Amount</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=unpaid">Unpaid</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=total">Total</a></th>
                    <th><a href="/ToobigApp/clients.php?orderBy=remarks">Remarks</a></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?php echo $client['id']; ?></td>
                    <td><?php echo $client['block']; ?></td>
                    <td><?php echo $client['lot']; ?></td>
                    <td><?php echo $client['name']; ?></td>
                    <td><?php echo $client['email']; ?></td>
                    <td><?php echo $client['phone']; ?></td>
                    <td><?php echo $client['previous']; ?></td>
                    <td><?php echo $client['present']; ?></td>
                    <td><?php echo $client['consumption']; ?></td>
                    <td><?php echo $client['amount']; ?></td>
                    <td><?php echo $client['unpaid']; ?></td>
                    <td><?php echo $client['total']; ?></td>
                    <td><?php echo $client['remarks']; ?></td>
                    <td>
                        <a href="/ToobigApp/edit.php?id=<?php echo $client['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="/ToobigApp/delete.php?id=<?php echo $client['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
