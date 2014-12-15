<!-- NavBar -->
<div class="navbar navbar-default" role="navigation">
   <div class="container-fluid">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#">Sistema de Pagos CM</a>
      </div>
      <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav">
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionar Pagos <b class="caret"></b></a>
               <ul class="dropdown-menu">
                  <li <?php $active=='insertar' and print 'class="active"' ?> ><a href="insertar.php">Insertar</a></li>
                  <li <?php $active=='aprobar'  and print 'class="active"' ?> ><a href="aprobar.php">Aprobar</a></li>
                  <li <?php $active=='eliminar' and print 'class="active"' ?> ><a href="eliminar.php">Eliminar</a></li>
               </ul>
            </li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ver Pagos <b class="caret"></b></a>
               <ul class="dropdown-menu">
                  <li <?php $active=='aprobados'  and print 'class="active"' ?> ><a href="aprobados.php">Aprobados</a></li>
                  <li <?php $active=='poraprobar' and print 'class="active"' ?> ><a href="poraprobar.php">Por Aprobar</a></li>
                  <li <?php $active=='rehazados'  and print 'class="active"' ?> ><a href="rechazados.php">Rechazados</a></li>
               </ul>
            </li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionar Presupuesto <b class="caret"></b></a>
               <ul class="dropdown-menu">
                  <li <?php $active=='crearpresupuesto'  and print 'class="active"' ?> ><a href="crearpresupuesto.php">Crear</a></li>
                  <li <?php $active=='reportargasto' and print 'class="active"' ?> ><a href="reportargasto.php">Actualizar</a></li>
               </ul>
            </li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ver Presupuestos <b class="caret"></b></a>
               <ul class="dropdown-menu">
                  <li <?php $active=='presupuestogeneral'  and print 'class="active"' ?> ><a href="presupuestogeneral.php">General</a></li>
                  <li <?php $active=='presupuestodetallado' and print 'class="active"' ?> ><a href="presupuestodetallado.php">Detallado</a></li>
               </ul>
            </li>
         </ul>
      </div>
      <!--/.nav-collapse -->
   </div>
   <!--/.container-fluid -->
</div>