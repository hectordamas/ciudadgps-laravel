<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$job->name}} en CiudadGPS</title>
</head>
<body>
<script>
    function openApp (){
        window.location.href = "ciudadgps://jobs/{{$job->id}}";
        setTimeout(function () { window.location.href = "https://ciudadgps.com/jobs/{{$job->id}}"; }, 3000);
    }
    
    openApp();
</script>
</body>
</html>