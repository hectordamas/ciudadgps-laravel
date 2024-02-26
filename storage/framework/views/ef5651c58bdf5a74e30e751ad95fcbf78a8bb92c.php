<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($commerce->name); ?> en CiudadGPS</title>
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
           window.location.href = 'ciudadgps://comercios/<?php echo e($commerce->id); ?>/show';
           setTimeout(function () { window.location.href = "https://ciudadgps.com/comercios/<?php echo e($commerce->id); ?>"; }, 3000);
        }
    }
    
    openApp();
    </script>
</body>
</html><?php /**PATH I:\ciudadgps\resources\views/public/commerces/redirect.blade.php ENDPATH**/ ?>