<?php
if (isset($_POST['submit'])) {
    // Check if file was uploaded
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
        // Get the uploaded file
        $file = $_FILES['csvFile']['tmp_name'];

        // Open the CSV file for reading
        if (($handle = fopen($file, 'r')) !== FALSE) {
            // Read the CSV file line by line
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // Assuming CSV format: Product Name, Description, Price
                $productName = $data[0];
                $description = $data[1];
                $price = $data[2];

                // Here you would typically insert the product into your database
                // Example: insertProduct($productName, $description, $price);
                
                echo "Product: $productName, Description: $description, Price: $price <br>";
            }
            fclose($handle);
        } else {
            echo "Could not open the file.";
        }
    } else {
        echo "File upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Product Upload</title>
</head>
<body>
    <h2>Bulk Product Upload</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="csvFile">Choose CSV File:</label>
        <input type="file" name="csvFile" id="csvFile" accept=".csv" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
