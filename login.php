<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Login | ATI SPORTWEAR</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background-color:#ffffff;
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.login-card{
width:400px;
border:2px solid black;
}

.btn-dark{
background:black;
border:none;
}

.btn-dark:hover{
background:#222;
}

.form-control{
border:1px solid black;
}

</style>

</head>

<body>

<div class="card login-card p-4">

<h3 class="text-center mb-4">ATI SPORTWEAR</h3>

<form action="validar_login.php" method="POST">

<div class="mb-3">
<label class="form-label">Correo</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Contraseña</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-dark w-100">Iniciar sesión</button>

</form>

<div class="text-center mt-3">
<a href="registro.php" class="text-dark">Crear cuenta</a>
</div>

</div>

</body>
</html>
