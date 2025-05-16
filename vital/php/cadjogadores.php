<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="preloader" id="preloader">
        <div class="loader" id="loader"></div>
    </div>
</body>
<script>
        let elem_preloader = document.getElementById("preloader");
    let elem_loader = document.getElementById("loader");
    console.log("Testing... Ok");


    setTimeout(function() {
        elem_preloader.classList.remove("preloader");
        elem_loader.classList.remove("loader");
        }, 1280);
</script>
</html>