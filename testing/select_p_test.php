<!DOCTYPE html>
<html>

<head>
    <title>Contoh Penggunaan Select dan Update Nilai pada Paragraf</title>
</head>

<body>
    <select id="mySelect">
        <option value="---">---</option>
        <option value="nilai1">Nilai 1</option>
        <option value="nilai2">Nilai 2</option>
        <option value="nilai3">Nilai 3</option>
    </select>

    <p id="result">Nilai yang dipilih: </p>

    <script>
        var selectElement = document.getElementById("mySelect");
        var resultElement = document.getElementById("result");

        selectElement.addEventListener("click", function() {
            var selectedValue = selectElement.value;
            resultElement.innerHTML = "Nilai yang dipilih: " + selectedValue;
        });
    </script>
</body>

</html>