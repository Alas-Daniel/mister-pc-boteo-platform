<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . $_SESSION['usuario']['rol'] . '/inicio');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/landing/head.php'; ?>

<body class="bg-secondary">

<section class="min-vh-100 d-flex justify-content-center align-items-center">
    <div class="bg-white rounded p-5 w-100" style="max-width:480px;">

        <!-- Logo -->
        <figure class="text-center mb-4">
            <a href="<?= BASE_URL ?>">
                <img src="https://res.cloudinary.com/drztldzvn/image/upload/v1753133485/logo-mr-pc_l1rh9t.png"
                     class="img-fluid" style="max-width:140px;" alt="Logo Mister PC Boteo">
            </a>
        </figure>

        <!-- Título -->
        <div class="text-center mb-4">
            <h1 class="h4 fw-bold">Iniciar Sesión</h1>
            <p class="text-muted small">Accede con tus credenciales</p>
        </div>

        <!-- Error dinámico -->
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- Formulario -->
        <form method="POST" action="<?= BASE_URL ?>login/auth" class="needs-validation" novalidate>            
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required minlength="6">
                <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>
</section>

<!-- Validación Bootstrap -->
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

</body>
</html>
