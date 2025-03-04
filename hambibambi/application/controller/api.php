<?php

header("Content-Type: application/json");

require "../../connect.php";

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            getProduct($_GET['id']);
        } else {
            getProducts();
        }
        break;
    case 'POST':
        addProduct();
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        if (isset($_GET['id'])) {
            updateProduct($_GET['id'], $_PUT);
        } else {
            echo json_encode(["error" => "Product ID is required"]);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            deleteProduct($_GET['id']);
        } else {
            echo json_encode(["error" => "Product ID is required"]);
        }
        break;
    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}

function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

function getProduct($id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
}

function addProduct() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $sql = "INSERT INTO products (product_category_id, quantity_unit_id, product_name, price, description, picture) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisiss", $data['product_category_id'], $data['quantity_unit_id'], $data['product_name'], $data['price'], $data['description'], $data['picture']);
    $stmt->execute();
    echo json_encode(["message" => "Product added successfully", "id" => $conn->insert_id]);
}

function updateProduct($id, $data) {
    global $conn;
    $sql = "UPDATE products SET product_category_id = ?, quantity_unit_id = ?, product_name = ?, price = ?, description = ?, picture = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisissi", $data['product_category_id'], $data['quantity_unit_id'], $data['product_name'], $data['price'], $data['description'], $data['picture'], $id);
    $stmt->execute();
    echo json_encode(["message" => "Product updated successfully"]);
}

function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo json_encode(["message" => "Product deleted successfully"]);
}

$conn->close();
