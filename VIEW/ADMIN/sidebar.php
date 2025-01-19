            <!-- 
            <a href="admin.php?action=MenuEmpleado">EMPLEADOS</a>
            <a href="admin.php?action=contratos">CONTRATOS</a>
            <a href="admin.php?action=MenuReserva">RESERVAS</a>
            <a href="admin.php?action=MenuMaquinaria">MAQUINARIAS</a>
            <a href="admin.php?action=MenuMantenimiento">MANTENIMINETO</a>
            <a href="admin.php?action=salir">SALIR</a>
 -->


<nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="IMAGENES/logo.png" class="logo" alt="">
      <h3 class="hide">Panel</h3>
    </div>

    <div class="search">
      <i class='bx bx-search'></i>
      <input type="text" class="hide" placeholder="Quick Search ...">
    </div>

    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <!-- OPCIONES DEL MENU -->
        <!-- <li class="tooltip-element" data-tooltip="0">
          <a href="#" class="active" data-active="0">
          <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Inicio</span>
          </a>
        </li> -->
        <li class="tooltip-element" data-tooltip="1">
          <a href="admin.php?action=MenuContrato" data-active="1">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Contratos</span>
          </a>
        </li>

        <li class="tooltip-element" data-tooltip="2">
          <a href="admin.php?action=MenuReserva" data-active="2">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Reservas</span>
          </a>
        </li>

        <li class="tooltip-element" data-tooltip="3">
          <a href="admin.php?action=MenuMaquinaria" data-active="3">
            <div class="icon">
              <i class='bx bx-book-content'></i>
              <i class='bx bxs-book-content'></i>
            </div>
            <span class="link hide">Maquinarias</span>
          </a>
        </li>

        <li class="tooltip-element" data-tooltip="4">
          <a href="admin.php?action=MenuModelo3D" data-active="4">
            <div class="icon">
              <i class='bx bx-cube'></i>
              <i class='bx bxs-cube'></i>
            </div>
            <span class="link hide">Modelos 3D</span>
          </a>
        </li>

      </ul>

      <h4 class="hide">Empresa</h4>

      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="admin.php?action=MenuEmpleado" data-active="4">
            <div class="icon">
              <i class='bx bx-notepad'></i>
              <i class='bx bxs-notepad'></i>
            </div>
            <span class="link hide">Empleados</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="admin.php?action=MenuMantenimiento" data-active="5">
            <div class="icon">
              <i class='bx bx-wrench'></i>
              <i class='bx bxs-wrench'></i>
            </div>
            <span class="link hide">Mantenimiento</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
        <a href="admin.php?action=MenuCliente" data-active="6">
            <div class="icon">
                <i class='bx bx-user'></i>
                <i class='bx bxs-user'></i>
            </div>
            <span class="link hide">Clientes</span>
        </a>
        </li>
        
        <div class="tooltip">
          <span class="show">Empleados</span>
          <span>Mantenimiento</span>
          <span>Clientes</span>
        </div>
      </ul>
    </div>

    <div class="sidebar-footer">
  <a href="#" class="account tooltip-element" data-tooltip="0">
    <i class='bx bx-user'></i>
  </a>
  <div class="admin-user tooltip-element" data-tooltip="1">
    <div class="admin-profile hide">
      <img src="IMAGENES/face-1.png" alt="">
      <div class="admin-info">
        <h3>Huallpa Maron</h3>
        <h5>Admin</h5>
      </div>
    </div>
    <a href="salir.php" class="log-out">
      <i class='bx bx-log-out'></i>
    </a>
  </div>
  <div class="tooltip">
    <span class="show">Huallpa Maron</span>
    <span>Logout</span>
  </div>
</div>
</nav>
