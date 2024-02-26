<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de <?php echo e($commerce->name); ?> en CiudadGPS</title>
</head>
<body>
<script>

    function getMobileOperatingSystem() {
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    
        if (/android/i.test(userAgent)) {
            return "Android";
        }
    
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "iOS";
        }
    
        return "unknown";
    }
    
    function openApp (){
        if(getMobileOperatingSystem() == "Android" || getMobileOperatingSystem() == "iOS"){
           window.location.href = 'ciudadgps://catalogo/<?php echo e($commerce->id); ?>';
           setTimeout(function () { window.location.href = "https://ciudadgps.com/catalogo-de-productos/<?php echo e($commerce->id); ?>"; }, 3000);
        }
    }
    
    openApp();
    </script>
</body>
</html><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/public/commerces/shareCatalogo.blade.php ENDPATH**/ ?>