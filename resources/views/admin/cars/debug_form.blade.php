<!DOCTYPE html>
<html>
<head>
    <title>Debug Form</title>
</head>
<body style="font-family: Arial;">
<h1>SIMPLE FORM DEBUG TEST</h1>

<form id="myForm" action="/admin/cars/1" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="Test">
    <button type="submit">SUBMIT FORM</button>
</form>

<script>
console.log('PAGE LOADED');

const form = document.getElementById('myForm');
console.log('Form action:', form.action);
console.log('Form method:', form.method);

form.addEventListener('submit', function(e) {
    console.log('SUBMIT event listener called');
    console.log('Will redirect to:', form.action);
});

// Try to catch all requests
document.addEventListener('submit', function(e) {
    console.log('Global submit listener - form:', e.target);
}, true);

window.addEventListener('beforeunload', function(e) {
    console.log('Page unloading - form submitted!');
});
</script>
</body>
</html>
