CREATE TABLE address (
    address_id INT PRIMARY KEY,
    street_address VARCHAR(100),
    city VARCHAR(100),
    state VARCHAR(100),
    postal_code VARCHAR(10)
);

CREATE TABLE customer (
    customer_id INT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    address_id INT,
    FOREIGN KEY (address_id) REFERENCES address(address_id)
);

CREATE TABLE `order` (
    order_id INT PRIMARY KEY,
    customer_id INT,
    address_id INT,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (address_id) REFERENCES address(address_id)
);

CREATE TABLE product (
    product_id INT PRIMARY KEY,
    product_name VARCHAR(100),
    description VARCHAR(255),
    weight DECIMAL(10, 2),
    base_cost DECIMAL(10, 2)
);

CREATE TABLE order_item (
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES `order`(order_id),
    FOREIGN KEY (product_id) REFERENCES product(product_id)
);

CREATE TABLE warehouse (
    warehouse_id INT PRIMARY KEY,
    name VARCHAR(100),
    address_id INT,
    FOREIGN KEY (address_id) REFERENCES address(address_id)
);

CREATE TABLE product_warehouse (
    product_id INT,
    warehouse_id INT,
    FOREIGN KEY (product_id) REFERENCES product(product_id),
    FOREIGN KEY (warehouse_id) REFERENCES warehouse(warehouse_id)
);
