<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
           window.location.href = 'ciudadgps://<?php echo e($type); ?>/<?php echo e($user->temp_social_code); ?>'
        }
    }
    
    openApp();
    </script>
</body>
</html><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/public/users/socialLoginRedirect.blade.php ENDPATH**/ ?>