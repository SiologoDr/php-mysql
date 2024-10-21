<aside class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow-sm" style="width: 250px; height: 100vh;">
    <h2 class="mb-4 text-center">Panel de Control</h2>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center" href="<?=$ruta?>/" data-page="home">
                <i class="fas fa-home me-2"></i> Home
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center" href="<?=$ruta?>/cliente" data-page="cliente">
                <i class="fas fa-user me-2"></i> Clientes
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center" href="<?=$ruta?>/empleado" data-page="empleado">
                <i class="fas fa-users me-2"></i> Empleados
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center" href="<?=$ruta?>/proyecto" data-page="proyecto">
                <i class="fas fa-tasks me-2"></i> Proyectos
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center" href="<?=$ruta?>/area" data-page="area">
                <i class="fas fa-building me-2"></i> Áreas
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center" href="<?=$ruta?>/asignacion" data-page="asignacion">
                <i class="fas fa-clipboard-list me-2"></i> Asignación
            </a>
        </li>
    </ul>
    <hr/>
    <a class="nav-link d-flex align-items-center text-danger" href="http://ds502-jhardsystex.azurewebsites.net/logout.php">
        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
    </a>
</aside>

<script>
    // Seleccionamos todos los enlaces del menú
    const navLinks = document.querySelectorAll('.nav-link');

    // Función para resaltar el enlace activo
    function setActiveLink() {
        const currentPage = window.location.pathname; // Obtiene la URL actual
        let activePage = localStorage.getItem('activePage'); // Obtener la página activa del localStorage

        // Verifica si estamos en la página principal
        if (currentPage === '<?=$ruta?>/') {
            activePage = 'home'; // Si estamos en Home, activa 'home'
            localStorage.setItem('activePage', 'home'); // Guarda en localStorage
        }

        navLinks.forEach(link => {
            if (link.dataset.page === activePage) {
                link.classList.add('active'); // Resaltar el enlace correspondiente
            } else {
                link.classList.remove('active'); // Quitar el resaltado de los demás
            }
        });
    }

    // Al hacer clic en un enlace, resaltar y guardar en localStorage
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            localStorage.setItem('activePage', link.dataset.page); // Guardar la página activa
            setActiveLink(); // Resaltar el enlace activo
        });
    });

    // Al cargar la página, resaltar el enlace activo
    document.addEventListener('DOMContentLoaded', setActiveLink);
</script>

<style>
    .nav-link.active {
        background-color: #007bff; /* Color azul para el enlace activo */
        color: white; /* Color del texto en el enlace activo */
    }
</style>
