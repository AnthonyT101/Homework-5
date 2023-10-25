<!-- Author: Anthony, Malachi, Sami
Date: 10/24/2023
File: Homework 5
Purpose: Homework 5
-->

<?php
/*
  Generates Customer, Order, Product, Order_Item, Address, Warehouse, Product_Warehouse data for tables.
*/
//Address Data
//Generates Street Names
function generateStreet() {
	$file = 'street.txt';
    if (file_exists($file)) {
        $street = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($street) {
            $randomIndex = array_rand($street);
            return trim($street[$randomIndex]);
        }
    }
}
//Generates City
function generateCity() {
	$file = 'city.txt';
    if (file_exists($file)) {
        $city = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($city) {
            $randomIndex = array_rand($city);
            return trim($city[$randomIndex]);
        }
    }
}
//Generates States
function generateState() {
	$file = 'state.txt';
    if (file_exists($file)) {
        $state = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($state) {
            $randomIndex = array_rand($state);
            return trim($state[$randomIndex]);
        }
    }
}
//Generates Zip Code
function generateZip() {
	return rand(11111,99999);
}

//Product Data
//Generates Product Name
function generateProductName() {
	$file = 'productname.txt';
    if (file_exists($file)) {
        $productName = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($productName) {
            $randomIndex = array_rand($productName);
            return trim($productName[$randomIndex]);
        }
    }
}
//Generates Description
function generateProductDesc($product_Name) {
	$product_Name = $product_Name;
	return 'A wonderful ' . $product_Name . ' for you to enjoy!';
}
//Generates Weight
function generateProductWeight() {
	return rand(1,99)/10 . ' lbs';
}
//Generates Base Cost
function generateProductBaseCost() {
	$cost = rand(1,1000)/10;
	return number_format((float)$cost, 2, '.', '');
}

//Customer Data
//Generates First Name
function generateRandomFirstName() {
    $file = 'firstnames.txt';
    if (file_exists($file)) {
        $names = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($names) {
            $randomIndex = array_rand($names);
            return trim($names[$randomIndex]);
        }
    }
}
//Generates Last Names
function generateRandomLastName() {
    $file = 'lastnames.txt';
    if (file_exists($file)) {
        $names = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($names) {
            $randomIndex = array_rand($names);
            return trim($names[$randomIndex]);
        }
    }
}
//Generates Email
function generateRandomEmail() {
	$domains = ["@gmail.com", "@yahoo.com", "@hotmail.com"];
	return $domains[array_rand($domains)];
}
//Generates Phone Number
function generateRandomPhone() {
	return rand(100,999) . "-" . rand(100,999) . '-' . rand(1000,9999);
}

//Order_Item data
//Generates Random Quantity
function generateRandomQuant() {
	return rand(1,100);
}

//Warehouse data
//Generates Warehouse Names
function generateWarehouseNames() {
    $file = 'warehousenames.txt';
    if (file_exists($file)) {
        $names = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($names) {
            $randomIndex = array_rand($names);
            return trim($names[$randomIndex]);
        }
    }
}

/*
  Puts data into the data.sql file
*/
$file = fopen('data.sql', 'w');

//Generating Address Data to data.sql - 150
for($i = 1; $i <= 150; $i++) {
	
	$street = rand(100,9999) . ' ' . generateStreet();
	$city = generateCity();
	$state = generateState();
	$zip = generateZip();
	$address = $street . ', ' . $city . ', ' . $state . ' ' . $zip;
	$addressID = $i;
	
	$insertAddressData = "INSERT INTO address (address_id, street_address, city, state, postal_code) VALUES ('$addressID', '$street', '$city', '$state', '$zip');";
    fwrite($file, $insertAddressData . PHP_EOL);
}

//Generating Customer Data to data.sql - 100
for($i = 1; $i <= 100; $i++) {
	$fName = generateRandomFirstName();
	$lName = generateRandomLastName();
	$email = $fName . '.' . $lName . generateRandomEmail();
	$pNumber = generateRandomPhone();
	$customerID = $i;
	$addressID = $i;
	
	$insertCustomerData = "INSERT INTO customer (customer_id, first_name, last_name, email, phone, address_id) VALUES ('$customerID', '$fName', '$lName', '$email', '$pNumber', '$addressID');";
    fwrite($file, $insertCustomerData . PHP_EOL);
}
	
//Generating Order Data to data.sql - 350
for($i = 1; $i <= 350; $i++) {
	$customerID = $i;
	$orderID = $i;
	$addressID = $i;
	
	
	$insertOrderData = "INSERT INTO `order` (order_id, customer_id, address_id) VALUES ('$orderID', '$customerID', '$addressID');";
    fwrite($file, $insertOrderData . PHP_EOL);
}

//Generating Product Data to data.sql - 750
for($i = 1; $i <= 750; $i++) {
	$productID = $i;
	$prodName = generateProductName();
	$prodDesc = generateProductDesc($prodName);
	$prodWeight = generateProductWeight();
	$prodCost = generateProductBaseCost();
	
	$insertProductData = "INSERT INTO product (product_id, product_name, description, weight, base_cost) VALUES ('$productID', '$prodName', '$prodDesc', '$prodWeight', '$prodCost');";
    fwrite($file, $insertProductData . PHP_EOL);
}

//Generating Warehouse Data to data.sql - 25
for($i = 1; $i <= 25; $i++) {
	$warehouseNames = generateWarehouseNames();
	$warehouseID = $i;
	$addressID = $i;
	
	$insertWarehouseData = "INSERT INTO warehouse (warehouse_id, name, address_id) VALUES ('$warehouseID', '$warehouseNames', '$addressID');";
    fwrite($file, $insertWarehouseData . PHP_EOL);
}

//Generating Order_Item Data to data.sql - 550
for($i = 1; $i <= 550; $i++) {
	$orderID = $i;
	$productID = $i;
	$prodCost = generateProductBaseCost();
	$quantity = generateRandomQuant();
	$test = generateRandomPhone();
	$price = $quantity * $prodCost;
	
	$insertOrderItemData = "INSERT INTO order_item (order_id, product_id, quantity, price) VALUES ('$orderID', '$productID', '$quantity', '$price');";
    fwrite($file, $insertOrderItemData . PHP_EOL);
}

//Generating Product_Warehouse Data to data.sql - 1250
for($i = 1; $i <= 1250; $i++) {
	$productID = $i;
	$warehouseID = $i;
	
	$insertProductWarehouseData = "INSERT INTO product_warehouse (product_id, warehouse_id) VALUES ('$productID', '$warehouseID');";
    fwrite($file, $insertProductWarehouseData . PHP_EOL);
}

fclose($file);

echo("data generated");

?>