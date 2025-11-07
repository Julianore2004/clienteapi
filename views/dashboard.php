<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . '/../config/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'views/login.php');
    exit();
}
require_once __DIR__ . '/include/header.php';
?>
<style>
    /* Estilos globales */
    .container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    .dashboard-container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    /* Bienvenida */
    .dashboard-welcome {
        text-align: center;
        margin-bottom: 2rem;
    }
    .dashboard-welcome h2 {
        color: #2c3e50;
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    .dashboard-welcome p {
        color: #7f8c8d;
        font-size: 1.1rem;
    }
    /* Acciones rápidas */
    .quick-actions {
        margin-bottom: 2rem;
    }
    .quick-actions h3 {
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }
    .btn-container {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    /* Botones */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-primary {
        background-color: #3498db;
        color: white;
    }
    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }
    /* Información de sesión */
    .session-info {
        background: #f7f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid #3498db;
    }
    .session-info h4 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    .session-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    .session-item strong {
        display: block;
        margin-bottom: 0.25rem;
        color: #7f8c8d;
    }
    /* Animación */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div class="container fade-in">
    <div class="dashboard-container">
        <!-- Bienvenida -->
        <div class="dashboard-welcome">
            <h2>¡Hola, <?php echo htmlspecialchars($_SESSION['nombre_completo'] ?? $_SESSION['username']); ?>!</h2>
            <p>Bienvenido a tu panel de cliente.</p>
        </div>

        <!-- Acciones rápidas -->
        <div class="quick-actions">
            <h3><i class="fas fa-rocket"></i> Acciones Rápidas</h3>
            <div class="btn-container">
                <a href="<?php echo BASE_URL; ?>views/tokens_list.php" class="btn btn-primary">
                    <i class="fas fa-key"></i> Mis Tokens API
                </a>
                  <!-- ... otros botones ... -->
       <a href="<?php echo BASE_URL; ?>api_cliente/" class="btn btn-primary" target="_blank">
    <i class="fas fa-external-link-alt"></i> Probar API Cliente
</a>
            </div>
        </div>

       
    </div>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>
