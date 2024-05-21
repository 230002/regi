<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS Calculator</title>
    <!-- Tailwind CSSのCDNリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="bg-gray-200 flex justify-center items-center h-screen">
        <div class="calculator bg-white rounded p-8 shadow-md">
        <form id="calculator-form" action="update.php" method="post">
                <input type="text" id="display" name="price" class="w-full mb-4 px-2 py-1 border rounded" readonly>
                <button class="btn border w-12 h-8 mb-4">計上</button>
            </form>
            <div class="grid grid-cols-4 gap-4">
            <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('7')">7</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('8')">8</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('9')">9</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="clearAll()">AC</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('4')">4</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('5')">5</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('6')">6</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="calculate('+')">+</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('1')">1</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('2')">2</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('3')">3</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="calculate('*')">x</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="addToDisplay('0')">0</button>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="calculateTax()">Tax</button>
                <a class="btn border w-12 h-8 flex justify-center items-center" href="sales/">売上</a>
                <button class="btn border w-12 h-8 flex justify-center items-center" onclick="calculateTotal()">=</button>
            </div>
        </div>

        <script>
            window.onload = function() {
                var display = document.getElementById('display');
                var savedValue = localStorage.getItem('displayValue');
                if (savedValue) {
                    display.value = savedValue;
                }
            };

            function addToDisplay(value) {
                var display = document.getElementById('display');
                display.value += value;
                // データをローカルストレージに保存
                localStorage.setItem('displayValue', display.value);
            }

            function calculate(operator) {
                var display = document.getElementById('display');
                // "=" を最初に入力したときは計算を行わず、何も表示しない
                if (operator === "=" && display.value === "") {
                    return;
                }
                // 直前の文字が計算記号の場合はエラー文を表示して計算しない
                var lastChar = display.value.slice(-1);
                if (['+', '-', '*', '/'].includes(lastChar)) {
                    alert("連続して計算記号を入力することはできません");
                    return;
                }
                display.value += operator;
                // データをローカルストレージに保存
                localStorage.setItem('displayValue', display.value);
            }

            function clearAll() {
                var display = document.getElementById('display');
                display.value = "";
                // ローカルストレージからデータを削除
                localStorage.removeItem('displayValue');
            }

            function clearDisplay() {
                var display = document.getElementById('display');
                display.value = "";
                // ローカルストレージからデータを削除
                localStorage.removeItem('displayValue');
            }

            function calculateTotal() {
                var display = document.getElementById('display');
                var expression = display.value;
                // "=" を最初に入力したときは計算を行わず、何も表示しない
                if (expression === "") {
                    return;
                }
                var result = eval(expression);
                display.value = result.toFixed(0); // 小数点以下を表示しないように変更
                // データをローカルストレージに保存
                localStorage.setItem('displayValue', result.toFixed(0));
            }

            function calculateTax() {
                var display = document.getElementById('display');
                var inputValue = parseFloat(display.value);
                if (!isNaN(inputValue)) {
                    var taxAmount = inputValue * 0.1;
                    var totalPrice = inputValue + taxAmount;
                    display.value = totalPrice.toFixed(0);
                    // データをローカルストレージに保存
                    localStorage.setItem('displayValue', totalPrice.toFixed(0));
                } else {
                    alert("有効な値を入力するかまたはフィールドを空白にしておいてください。");
                }
            }
        // フォーム送信後にディスプレイをクリア
        document.getElementById('calculator-form').addEventListener('submit', function(event) {
            event.preventDefault(); // デフォルトのフォーム送信を防ぐ

            // データを送信するためにAjaxを使用
            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    clearDisplay(); // ディスプレイをクリア
                }
            };
            xhr.send(formData);
        });

        // ページが再読み込みされたときにディスプレイをクリア
        window.addEventListener('pageshow', function(event) {
            var display = document.getElementById('display');
            display.value = "";
            // ローカルストレージからデータを削除
            localStorage.removeItem('displayValue');
        });
        </script>

    </div>
</body>

</html>
