<?php
/* header('Content-Type: application/json'); */
include_once 'class-user.php';
session_start();
/* if (!empty($_SESSION["kategoria"])) {
    header("Location: ../category.php");
} */


$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
/* $requestUri = strtok($_SERVER['REQUEST_URI'], '?'); //kérdőjel nélkül */

//echo "$requestUri";

// Útvonal és metódus kezelés
if ($requestMethod == 'GET' && preg_match('/\/regisztracio\/api\/category\/(\d+)/', $requestUri, $matches)) {
    $categoryId = $matches[1];
    //echo $matches[1];
    getCategory($categoryId);
} elseif ($requestMethod == 'POST' && $requestUri == '/regisztracio/api/category') {
    createCategory();
} elseif ($requestMethod == 'PUT' && preg_match('/\/regisztracio\/api\/category\/(\d+)/', $requestUri, $matches)) {
    $categoryId = $matches[1];
    updateCategory($categoryId);
} elseif ($requestMethod == 'DELETE' && preg_match('/\/regisztracio\/api\/category\/(\d+)/', $requestUri, $matches)) {
    $categoryId = $matches[1];
    deleteCategory($categoryId);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
    }

// Függvények

function getCategory($id) {
    $felh = new User();
    $category = $felh->megjelenitLista("kategoria", "nev", "ar", $id); 
    if ($category != null) {
        echo json_encode($category);
    }
    else
        echo "Nincs ilyen rekord";
}

function createCategory() {
    $felh = new User();
    $data = json_decode(file_get_contents('php://input'), true);
    $nev = $data['nev'] ?? null;
    $ar = $data['ar'] ?? null;
    // Validate the input data
    if ($nev === null || $ar === null) {
        echo json_encode(['message' => 'Invalid input']);
        return;
    }
    echo "$nev, $ar";
    $felh->beszur("kategoria", $ar, $nev);
    echo json_encode(['message' => 'Category created', 'nev' => $nev, 'ar' => $ar]);
    /* 
    try {
        $felh->beszur("kategoria", $_POST["priceU"], $_POST["nameU"]);
        $_SESSION["kategoria"] = 1;
        echo '<script>';
        echo 'window.location.reload();';
        echo '</script>'; 
    } catch (\Throwable $th) {
        echo "A név egyedi!";
    } */
}

function updateCategory($id) {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['message' => 'Category updated', 'id' => $id, 'data' => $data]);
}

function deleteCategory($id) {
    echo json_encode(['message' => 'Category deleted', 'id' => $id]);
}
