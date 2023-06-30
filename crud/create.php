<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "toobig";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$block = "";
$lot = "";
$name = "";
$email = "";
$phone = "";
$previous = "";
$present = "";
$consumption = "";
$amount = "";
$unpaid = "";
$total = "";
$remarks = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $block = $_POST["block"];
    $lot = $_POST["lot"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $previous = $_POST["previous"];
    $present = $_POST["present"];
    $consumption = $_POST["consumption"];
    $amount = $_POST["amount"];
    if (isset($_POST["unpaid"])) {
        $unpaid = $_POST["unpaid"];
    }
    $total = $_POST["total"];
    $remarks = $_POST["remarks"];

    do {
        if (empty($block) || empty($lot) || empty($name) || empty($previous) || empty($present) || empty($consumption) || empty($amount) || empty($total)) {
            $errorMessage = "Block, Lot, Name, Prev, Pres, Cons, Amount, and Total are required";
            break;
        }

        // Check if email already exists
        $checkQuery = "SELECT COUNT(*) as count FROM clients WHERE email='$email'";
        $result = $connection->query($checkQuery);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            $errorMessage = "Email already exists!";
            break;
        }

        // Add new client to the database
        $sql =  "INSERT INTO clients (block, lot, name, email, phone, previous, present, consumption, amount, unpaid, total, remarks) " .
                "VALUES ('$block', '$lot', '$name', '$email', '$phone', '$previous', '$present', '$consumption', '$amount', '$unpaid', '$total', '$remarks')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $block = "";
        $lot = "";
        $name = "";
        $email = "";
        $phone = "";
        $previous = "";
        $present = "";
        $consumption = "";
        $amount = "";
        $unpaid = "";
        $total = "";
        $remarks = "";

        $successMessage = "Client added correctly";

        header("location: /ToobigApp/clients.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>

        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Block</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="block" value="<?php echo $block; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lot</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lot" value="<?php echo $lot; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Previous</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="previous" value="<?php echo $previous; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Present</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="present" value="<?php echo $present; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Consumption</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="consumption" value="<?php echo $consumption; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Total</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="total" value="<?php echo $total; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="remarks" value="<?php echo $remarks; ?>">
                </div>
            </div>


            <?php
            if ( !empty($successMessage) ) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/ToobigApp/clients.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>   
    
</body>
</html>