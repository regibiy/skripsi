<!DOCTYPE html>
<html>

<head>
    <title>Contoh Penggunaan Select dan Update Nilai pada Paragraf</title>
</head>

<body>
    <select id="mySelect">
        <option value="">---</option>
        <option value="nilai1">Nilai 1</option>
        <option value="nilai2">Nilai 2</option>
        <option value="nilai3">Nilai 3</option>
    </select>

    <p id="result">Nilai yang dipilih: </p>
    <input type="text" id="test">

    <input type="number" id="myInput" readonly>
    <button id="btnInput">Toggle Readonly</button>


    <script>
        var selectElement = document.getElementById("mySelect");
        var resultElement = document.getElementById("test");
        var btnInput = document.getElementById("btnInput");

        selectElement.addEventListener("change", function() {
            var selectedValue = selectElement.value;
            resultElement.innerHTML = "Nilai yang dipilih: " + selectedValue;
            resultElement.value = selectedValue;
        });

        function toggleReadonly() {
            var input = document.getElementById("myInput");

            if (input.readOnly) {
                input.readOnly = false;
            } else {
                input.readOnly = true;
            }
        }

        btnInput.addEventListener("click", () => {
            toggleReadonly();
        })
    </script>
</body>

</html>