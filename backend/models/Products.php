<?php
require_once('ConnectionDB.php');
class Product {

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;

    public function __construct($id, $name, $description, $price, $stock, $category_id) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->category_id = $category_id;
    }

    public static function registerNewProduct($name, $description, $price, $stock, $categoryName) {
        $database = new ConnectionDB();
        $conn = $database->connection();

        $queryCategory = "SELECT categoryId FROM Category WHERE name = ?";
        $stmtCat = mysqli_prepare($conn, $queryCategory);
        mysqli_stmt_bind_param($stmtCat, "s", $categoryName);
        mysqli_stmt_execute($stmtCat);
        mysqli_stmt_bind_result($stmtCat, $category_id);
        mysqli_stmt_fetch($stmtCat);
        mysqli_stmt_close($stmtCat);

        $query = "INSERT INTO Product(name, description, price, stock, categoryId) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssdii", $name, $description, $price, $stock, $category_id);

        if (!mysqli_stmt_execute($stmt)) {
            header('Location: Error.php');
            exit();
        }
        header('Location: ../../../frontend/ProductHome.php');
    }

    public static function getProductById($id) {
        $database = new ConnectionDB();
        $conn = $database->connection();

        $stmt = $conn->prepare("SELECT p.*, c.name AS category 
                                      FROM product p 
                                      JOIN category c ON p.categoryId = c.categoryId 
                                      WHERE p.productId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function updateProduct($id, $name, $description, $price, $stock, $categoryId) {
    $database = new ConnectionDB();
    $conn = $database->connection();

    $query = "UPDATE Product SET name = ?, description = ?, price = ?, stock = ?, categoryId = ? WHERE productId = ?";
    $stmt = mysqli_prepare($conn, $query);

    
    mysqli_stmt_bind_param($stmt, "ssdiii", $name, $description, $price, $stock, $categoryId, $id);

    if (!mysqli_stmt_execute($stmt)) {
        
        return false;
    }

    return true;
}


    public static function deleteProduct($id) {
        $database = new ConnectionDB();
        $conn = $database->connection();

        $query = "DELETE FROM Product WHERE productId = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt); 
    }


    public static function listAllProducts() {
        $database = new ConnectionDB();
        $conn = $database->connection();

        $query = "SELECT * FROM Product";
        $result = mysqli_query($conn, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

}
?>
