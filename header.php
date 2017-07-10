<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>G</b>PA</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Plasma</b>Automation</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="height: 50px;">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="height: 50px;">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                     
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height: 50px;">
                 <span class="hidden-xs"><?php echo $_SESSION['usuario']['nombre'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      <?php echo $_SESSION['usuario']['nombre'];?>
                      <small><?php echo $_SESSION['usuario']['email'];?></small>
                    </p>
                    <h1 style="color:#ffffff;"><i class="fa fa-user"></i></h1>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                    </div>
                    <div class="pull-right">
                      <a href="login/sesiones.php?cerrar-sesion" class="btn btn-default btn-flat">Cerrar sesión <i class="fa fa-power-off"></i></a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>