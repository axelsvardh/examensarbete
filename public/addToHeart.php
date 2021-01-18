<?php
// include '../src/config.php';

// try {
//   $query = "SELECT * FROM offices";
//   $stmt = $conn->query($query);
//   $office_specs = $stmt->fetchall();
//   }   catch (\PDOException $e) {
//   throw new \PDOException($e->getMessage(), (int) $e->getCode());
//   }

// if(!empty($_POST['hej'])) {
//         $productId = (int) $_POST['productId'];

//         try{
//             $query = "
//                 SELECT * FROM office
//                 WHERE id = :id;
//                 ";
//             $stmt = $dbconnect->prepare($query);
//             $stmt->bindValue(':id', $productId);
//             $stmt->execute();
//             $product = $stmt->fetch();
//         } catch (\PDOException $e) {
//             throw new \PDOException($e->getMessage(), (int) $e->getCode());
//         }
        
//         if ($product) {
//             $product = array_merge($product, ['quantity' => $quantity]);
//             $productItem = [$productId => $product];
//         }

//         if (empty($_SESSION['items'])) {
//             $_SESSION['items'] = $productItem;
//         } else {
//             if (isset($_SESSION['items'][$productId])) {
//                 $_SESSION['items'][$productId]['quantity'] += $quantity;
//             } else {
//                 $_SESSION['items'] += $productItem;
//             }
//         } 
//     }

//     // header('Location: fav-page.php');
//     exit;
    include ('../src/config.php');




    if (!empty('office_id')) {
        $office_id = (int) $_POST['office_id'];


        try {

            $query = "SELECT * FROM office_specs WHERE office_id = :id;";

            $stmt = $conn->prepare($query);
            $stmt->bindvalue(':id', $_POST['office_id']);
            $stmt->execute();
            $office_specs = $stmt->fetch();
        }   catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }

        if ($office_specs) {


            $hearts = [$office_id => $office_specs];


            if (empty($_SESSION['hearts'])) {
                $_SESSION['hearts'] = $office_fav;
            } else {
                //$_SESSION['hearts'] = $office_fav;
                 if (isset($_SESSION['hearts'][$office_id])) {
                    $_SESSION['hearts'][$office_id] += $quantity;
                 } else {
                    $_SESSION['hearts'] += $office_fav;
                 }
            }




        }
    }

    header('Location: heart-page.php');
    exit;

?>

