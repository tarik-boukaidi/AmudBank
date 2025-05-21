<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('test1')}}">
        @csrf 
    <input id='mod' name='modpass' type='password'>
    <label value="" id="val"></label>
    </form>
</body>
<script>
    let modpass=document.getElementById('mod');
    modpass.addEventListener('input', function() {
        let password = modpass.value;
        let strengthvalue = document.getElementById('val');
        let strength=0;
        if(password >= 8 )
             strength++;
        if (/\d/.test(password)) strength++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
        
        strengthvalue.innerHTML = strength;
        if (strength < 2) {
            strengthvalue.innerHTML = "Weak";
        } else if (strength == 2) {
            strengthvalue.innerHTML = "Medium";
        } else {
            strengthvalue.innerHTML = "Strong";
        }
    
    
    });
</script>
</html>