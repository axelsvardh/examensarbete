<?php

// Start session
// session_start();

require('dbconnect.php');

// Turn on/off error reporting
error_reporting(-1);

// define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
// define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'

// Include functions and classes

?>


<!-- // Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('APP_URL', 'http://localhost:8080/examensarbete/public');
define('PUBLIC_PATH', APP_URL . 'public/');
define('IMG_PATH', APP_URL . 'public/img/');
define('CHECKOUT_PATH', APP_URL . 'public/checkout/');
define('PARTS_PATH', APP_URL . 'public/parts/');
define('STYLES_PATH', APP_URL . 'public/styles/');
define('JS_PATH', APP_URL . 'public/js/');
define('ROOT_PATH', __DIR__ . '/../'); // path to 'root'
define('SRC_PATH',  __DIR__ . '/'); // path to 'src/'


// Include functions and classes

function fetchAllProducts() {
    global $dbconnect;

    try {
        $query = "SELECT * FROM office;";
        $stmt = $dbconnect->query($query);
        $products= $stmt->fetchAll();
    }   catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    return $products;
}

function fetchLatestProducts() {
    global $dbconnect;

    try {
        $query = "SELECT * FROM products ORDER BY id DESC LIMIT 4;";
        $stmt = $dbconnect->query($query);
        $products = $stmt->fetchall();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    return $products;
}

function fetchSpecificProduct() {
    global $dbconnect;

    $specific_id = $_GET["productsId"]; 
    try {
        $query = "SELECT * FROM products WHERE id = $specific_id;";
        $stmt = $dbconnect->query($query);
        $products = $stmt->fetchall();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    } 
    return $products;
}

function deleteProduct() {
    global $dbconnect;

    if (isset($_POST['deleteBtn'])) {
        try {
            $query = "
            DELETE FROM products
            WHERE id = :id;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $_POST['deleteId']);
            $stmt->execute();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
}

function getUpdateId() {
    global $dbconnect;

    if(isset($_GET['updateId'])){
        try {
          $id = $_GET['updateId'];
          $query = "SELECT * FROM products
                    WHERE id = :id";
          $stmt = $dbconnect->prepare($query);
          $stmt->bindValue(':id', $_GET['updateId']);
          $stmt->execute();
          $product = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    
    
    
    $img_url = '';
    $title = '';
    $brewery = '';
    $type = '';
    $price = '';
    $description = '';
    $error = '';
    $msg = '';
    if (isset($_POST['updateProductBtn'])) {
        $img_url = trim($_POST['img_url']);
        $title = trim($_POST['title']);
        $brewery = trim($_POST['brewery']);
        $type = trim($_POST['type']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);
    
        if (empty($title)) {$error .= "<div>Titel får ej vara tom</div>";}
        if (empty($brewery)) {$error .= "<div>Bryggeri får ej vara tom</div>";}
        if (empty($type)) {$error .= "<div>Typ får ej vara tom</div>";}
        if (empty($price)) {$error .= "<div>Pris får ej vara tom</div>";}
        if (empty($img_url)) {$error .= "<div>img_url får ej vara tom</div>";}
        if (empty($description)) {$error .= "<div>Beskrivning får ej vara tom</div>";}
        if ($error) {$msg = "<div class='errors'>{$error}</div>";}
    
        if (empty($error)) {
            try {
                $query = "
                UPDATE products
                SET 
                    title = :title, 
                    brewery = :brewery, 
                    type = :type, 
                    price = :price, 
                    img_url = :img_url, 
                    description = :description
                WHERE id = :id
                ";
    
                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':img_url', $img_url);
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':brewery', $brewery);
                $stmt->bindValue(':type', $type);
                $stmt->bindValue(':price', $price);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':id', $_GET['updateId']);
                $result = $stmt->execute();
            }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
            if ($result) {
            $msg = '<div class="success">Produkten har uppdaterats!</div>';
                if(isset($_GET['updateId'])){
                    try {
                    $id = $_GET['updateId'];
                    $query = "SELECT * FROM products
                                WHERE id = :id";
                    $stmt = $dbconnect->prepare($query);
                    $stmt->bindValue(':id', $_GET['updateId']);
                    $stmt->execute();
                    $product = $stmt->fetch();
                    } catch (\PDOException $e) {
                        throw new \PDOException($e->getMessage(), (int) $e->getCode());
                    }
                }
            } 
        }
    }   
    return array($product, $msg);
}; -->
