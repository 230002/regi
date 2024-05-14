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
            <form action="update.php" method="post">
                <input type="text" id="display" name="price" class="w-full mb-4 px-2 py-1 border rounded" readonly>
                <button class="btn">計上</button>
            </form>
            <div class="grid grid-cols-4 gap-4">
                
                <button class="btn" onclick="addToDisplay('7')">7</button>
                <button class="btn" onclick="addToDisplay('8')">8</button>
                <button class="btn" onclick="addToDisplay('9')">9</button>
                <button class="btn" onclick="clearAll()">AC</button>
                <button class="btn" onclick="addToDisplay('4')">4</button>
                <button class="btn" onclick="addToDisplay('5')">5</button>
                <button class="btn" onclick="addToDisplay('6')">6</button>
                <button class="btn" onclick="calculate('+')">+</button>
                <button class="btn" onclick="addToDisplay('1')">1</button>
                <button class="btn" onclick="addToDisplay('2')">2</button>
                <button class="btn" onclick="addToDisplay('3')">3</button>
                <button class="btn" onclick="calculate('*')">x</button>
                <button class="btn" onclick="addToDisplay('0')">0</button>
                <button class="btn" onclick="calculateTax()">Tax</button>
                <a class="btn" href="sales/">売上</a>
                <button class="btn" onclick="calculateTotal()">=</button>
            </div>
    </div>
            <!-- <div class="mt-5">
                <a class="btn" href="sales/">売上</a>
            </div>  -->

    <script>
        var memory = "";
        var operand = "";

        function addToDisplay(value) {
            memory += value;
            updateDisplay();
        }

        function calculate(value) {
            operand = value;
            memory += value;
            updateDisplay();
        }

        function clearAll() {
            memory = "";
            updateDisplay();
        }

        function updateDisplay() {
            document.getElementById('display').value = memory;
        }

        function calculateTotal() {
            var expression = document.getElementById('display').value;
            var result = eval(expression);
            document.getElementById('display').value = result;
        
        }
        function calculateTax() {
            var inputValue = parseFloat(document.getElementById('display').value);
            if (!isNaN(inputValue)) {
                var taxAmount = inputValue * 0.1;
                var totalPrice = inputValue + taxAmount;
                document.getElementById('display').value = totalPrice.toFixed(0);
            } else {
                alert("有効な値を入力するかまたはフィールドを空白にしておいてください。");
            }
        }
    </script>

    </div>
</body>

</html>
