<?php try {
    $pdo = new PDO('mysql:host=10.30.2.23;dbname=pb_db_digitalization', 'pb-dbtest', 'P@ss#w0rd1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check accessible databases
    $stmt = $pdo->query("SHOW DATABASES");
    $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<pre>";
    print_r($databases);
    echo "</pre>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
    ?>