<!DOCTYPE html>
<html>
<head>
    <title>Edit Test</title>
</head>
<body>
<h1>FORM TEST - NO LAYOUT</h1>

<form id="testForm" action="/admin/cars/1" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="Test Car">
    <button type="button" onclick="handleClick()">SUBMIT</button>
</form>

<script>
console.log('=== SCRIPT LOADED ===');

function handleClick() {
    console.log('[INLINE] onClick fired!');
    const form = document.getElementById('testForm');
    console.log('[INLINE] Form:', form);
    if (form) {
        console.log('[INLINE] Submitting form...');
        form.submit();
    }
}

// Also test with addEventListener
const form = document.getElementById('testForm');
console.log('Form found via getElementById:', !!form);

if (form) {
    form.addEventListener('submit', function(e) {
        console.log('[LISTENER] Form submit detected!');
    });
}
</script>
</body>
</html>
