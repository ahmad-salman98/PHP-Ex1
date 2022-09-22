<?php

// ==================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ==========================================================

// MYsql


// $servername = "localhost";
// $username = "root";
// $password = "Ahmad481989";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=university", $username, $password);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
// 

use PhpMyAdmin\Sql;
use Symfony\Component\VarExporter\Internal\Values;

$servername = "localhost";
$username = "root";
$password = "Ahmad481989";
$dbname = "cars";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ==============================================

// MySQLi

if (isset($_POST["submit"])) {

    $stmt = $conn->prepare("INSERT INTO car (id, image, model,price,color) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $id, $image, $model, $price, $color);

    // set parameters and execute
    $id    = $_POST["carId"];
    $image = $_POST["carImage"];
    $model = $_POST["carModel"];
    $price = $_POST["carPrice"];
    $color = $_POST["carColor"];
    $stmt->execute();

    echo "New records created successfully";
    $id = $image = $model = $price = $color = "";
    header('Location: index.php');

    $stmt->close();
    $conn->close();
}
// ================================================

// PDO

// try {
//     // إجراء الإتصال
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     // تعديل نوع معالج الأخطاء
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // SQL إعداد القالب لجملة
//     $stmt = $conn->prepare("INSERT car  (id, model,image,price,color)
// 	VALUES (:id, :model,:image,:price,:color)");

//     // ربط المتغيرات بالقيم في القالب الذي اعددناه
//     $stmt->bindParam(':id', $id);
//     $stmt->bindParam(':model', $model);
//     $stmt->bindParam(':image', $image);
//     $stmt->bindParam(':price', $price);
//     $stmt->bindParam(':color', $color);

//     // تعريف المتغيرات ثم تنفيذ الإستعلام
//     $id    = $_POST["carId"];
//     $image = $_POST["carImage"];
//     $model = $_POST["carModel"];
//     $price = $_POST["carPrice"];
//     $color = $_POST["carColor"];
//     $stmt->execute();

//     echo "تم إضافة السجلات بنجاح";
// } catch (PDOException $e) {
//     echo  "<br>" . $e->getMessage();
// }

// إغلاق الإتصال
// $conn = null;

// ======================

// show data 

// To give the id placeholder a value

?>

<div style="display: flex; justify-content:center; width:100%">


    <form action="index.php" method="POST">
        <input type="number" name="carId" hidden>
        <br>
        <input type="url" name="carImage" placeholder="Car image" required>
        <br>
        <input type="text" name="carModel" placeholder="Car Model" required>
        <br>
        <input type="number" name="carPrice" placeholder="Price" required>
        <br>
        <input type="text" name="carColor" placeholder="Car Color" required>
        <br>
        <input type="submit" name="submit" value="Add Car">
</div>
<hr>

</form>
<?php
$query = "SELECT * FROM car";
$result = mysqli_query($conn, $query);
?>
<table border="1" width="75%" style="text-align:center ; margin:auto;">
    <tr>
        <th style="padding: 1rem ;">Car Model</th>
        <th style="padding: 1rem ;">Car Price</th>
        <th style="padding: 1rem ;">Car Color</th>
        <th style="padding: 1rem ;">Car Image</th>
    </tr>
    <?php
    while ($rows = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td> <?php echo $rows['model']; ?> </td>
            <td> <?php echo $rows['price']; ?> </td>
            <td> <?php echo $rows['color']; ?> </td>
            <td> <img src=" <?php echo $rows['image']; ?>" height="100" alt="Image not Found"> </td>
        </tr>
    <?php } ?>
</table>