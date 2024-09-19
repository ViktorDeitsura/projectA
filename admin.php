<?php
require_once 'App/Domain/Users/UserEntity.php'; use App\Domain\Users\UserEntity;

$user = new UserEntity();
if (!$user->isAdmin) die('Доступ закрыт');
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="allert-cont col-3"></div>
        <div class="row">
            <h1>Админка</h1>
        </div>
        <div class="row">
            <div class="col-12 mt-4 mb-2">
                <h2>Добавление товара</h2>
            </div>
            <div class="col-12">
                <form action="App/Application/AdminService.php" method="POST" id="adminForm" onsubmit="return;">
                    <div class="col-12 mb-4">
                        <label class="form-label" for="productName">Название товара:</label>
                        <input type="text" name="prod-name" class="form-control" id="productName">
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="productPrice">Цена:</label>
                        <input type="number" name="prod-price" class="form-control" id="productPrice" min="1">
                    </div>
                    <div class="col-12 mb-4">
                        <h5>Тариф</h5>
                        <div class="col-12 mt-2 tarif-list d-none" id="tarifList"></div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="tarifDayCount">Кол-во дней:</label>
                                <input type="number" name="tarif-count" class="form-control" id="tarifDayCount" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="tarifPrice">Цена:</label>
                                <input type="number" name="tarif-price" class="form-control" id="tarifPrice" min="1">
                            </div>
                            <div class="col-3">
                                <div class="btn btn-primary mt-2" id="tarifAdd">Добавить</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Добавить товар</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/admin.js"></script>
</body>
</html>