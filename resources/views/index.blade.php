<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
<h1>Checkout Page</h1>
<form action="/checkout" method="POST">
    @csrf
    <button type="submit">Checkout</button>
</form>
</body>
</html>
