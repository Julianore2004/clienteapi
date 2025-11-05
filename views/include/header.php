<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API Docentes</title>
  <style>
    /* Reset simple */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        color: #333;
    }
    /* Header */
    .app-header {
        background: #ffffff;
        border-bottom: 1px solid #e1e1e1;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .app-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #2c3e50;
    }
    /* Navegación */
    .app-nav {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }
    .nav-link {
        text-decoration: none;
        color: #2c3e50;
        font-weight: 500;
        transition: color 0.2s ease;
    }
    .nav-link:hover {
        color: #3498db;
    }
    /* Botón de logout */
    .btn-logout {
        background: #e74c3c;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s ease;
    }
    .btn-logout:hover {
        background: #c0392b;
    }
    /* Responsive */
    @media (max-width: 768px) {
        .app-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .app-nav {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            gap: 0.8rem;
        }
        .btn-logout {
            width: 100%;
            text-align: center;
        }
    }
</style>

</head>
<body>
  <header class="app-header">
    <h1 class="app-title">API Docentes 2025</h1>
    <nav class="app-nav">
      <a href="<?php echo BASE_URL; ?>views/dashboard.php" class="nav-link">Dashboard</a>
        <a href="<?php echo BASE_URL; ?>views/tokens_list.php" class="nav-link">Tokens</a>
  
     
<a href="#" onclick="logout(); return false;" class="btn-logout"> Cerrar Sesión</a>
    </nav>
  </header>

  <script>
    function logout() {
      if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
          window.location.href = '<?php echo BASE_URL; ?>logout.php';
      }
    }
  </script>
</body>
</html>