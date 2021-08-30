 <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link elevation-4">
      <img src="{{asset('images/logo/logo7_9_122716.png')}}" alt="AdminLTE Logo" class="brand-image img-circle"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Ventas</span>
    </a>

   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/avatar/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{auth()->user()->display_name}} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon mdi mdi-view-dashboard"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="/user" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
       
             
            
              <li class="nav-item">
                <a href="/roles" class="nav-link">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="/logins" class="nav-link">
                  <i class="fas fa-sign-in-alt nav-icon"></i>
                  <p>Logins</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview menu-open ">
            <a href="#" class="nav-link active ">
              <i class="nav-icon fas fa-box"></i>
              <p>
                PRODUCTOS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-store"></i>
                  <p>
                    Inventario
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                     <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/productos/nuevo" class="nav-link">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Agregar producto</p>
                    </a>
                  </li>
                          <li class="nav-item">
                    <a href="/productos" class="nav-link">
                      <i class="fas fa-clipboard-list nav-icon"></i>
                      <p>Vista general</p>
                    </a>
                  </li>
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="fas fa-users-cog nav-icon"></i>
                      <p>
                        Opciones
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                                <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/productos/movimientos" class="nav-link">
                          <i class="fas fa-people-carry nav-icon"></i>
                          <p>Ver movimiento</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
             
            </ul>
          </li>
          
          <li class="nav-item has-treeview menu-open ">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file"></i>
              <p>
                REGISTROS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">               
               <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-shopping-basket"></i>
                  <p>
                    Ventas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                     <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/comprobantes" class="nav-link">
                      <i class="fas fa-clipboard-list nav-icon"></i>
                      <p>&nbsp Vista general</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/comprobantes/nuevo" class="nav-link">
                      <i class="fas fa-cart-plus nav-icon"></i>
                      <p>&nbsp Nueva venta</p>
                    </a>
                  </li>       
                </ul>
               </li>
               <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-hands"></i>
                  <p>
                    Compras
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/compras" class="nav-link">
                      <i class="fas fa-clipboard-list nav-icon"></i>
                      <p>&nbsp Vista general</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/compras/nuevo" class="nav-link">
                      <i class="fas fa-cart-plus nav-icon"></i>
                      <p>&nbsp Nueva compra</p>
                    </a>
                  </li>       
                </ul>
               </li>
               <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-handshake"></i>
                  <p>
                    Facturas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/comprobantes/vencimientos" class="nav-link">
                      <i class="fas fa-id-badge nav-icon"></i>
                      <p>Por cobrar</p>
                    </a>
                    <a href="/compras/pagar" class="nav-link">
                      <i class="fas fa-check nav-icon"></i>
                      <p>Por pagar</p>
                    </a>
                  </li> 
                </ul>
               </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Clientes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                     <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/clientes" class="nav-link">
                      <i class="fas fa-clipboard-list nav-icon"></i>
                      <p>&nbsp Vista general</p>
                    </a>
                  </li>
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="fas fa-user-cog nav-icon"></i>
                      <p>
                        Opciones
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                      <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/clientes/nuevo" class="nav-link">
                          <i class="fas fa-user-plus nav-icon"></i>
                          <p>&nbsp Nuevo cliente</p>
                        </a>
                      </li>
                    </ul>
     
                  </li>             
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-shipping-fast"></i>
                  <p>
                    Proveedores
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/proveedores" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>&nbsp Vista general</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-cog nav-icon"></i>
                  <p>
                    Opciones
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                           <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/proveedores/nuevo" class="nav-link">
                      <i class="fab fa-opencart nav-icon"></i>
                      <p>&nbsp Proveedor nuevo</p>
                    </a>
                  </li>
                </ul>
 
              </li>             
            </ul>
          </li>
        </ul>
      </li>
       <li class="nav-item has-treeview menu-open ">
        <a href="#" class="nav-link active ">
          <i class="nav-icon fas fa-users"></i>
          <p>
            EMPLEADOS
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-business-time"></i>
              <p>
                Empleados
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
                  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/empleados" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>&nbsp Vista general</p>
                </a>
              </li>
              <li class="nav-item">
                    <a href="/empleados/create" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>&nbsp Empleado nuevo</p>
                    </a>
                  </li>                              
            </ul>
          </li> 
        </ul>
      </li>
      <li class="nav-item has-treeview menu-open ">
        <a href="#" class="nav-link active ">
          <i class="nav-icon fab fa-paypal"></i>
          <p>
            Gastos
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store-alt"></i>
              <p>
                Gastos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/gastos" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>&nbsp Vista general</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview menu-open ">
        <a href="#" class="nav-link active ">
          <i class="nav-icon fas fa-cash-register"></i>
          <p>
            CAJAS
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-opencart"></i>
              <p>
                Apertura
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
                 <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/apertura/create" class="nav-link">
                  <i class="far fa-plus-square nav-icon"></i>
                  <p>Nueva apertura</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="/apertura" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Vista general</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon mdi mdi-cash-usd"></i>
              <p>
                Cierre
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
                 <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/cierre/create" class="nav-link">
                  <i class="far fa-plus-square nav-icon"></i>
                  <p>Nuevo cierre</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="/cierre" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Vista general</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder "></i>
              <p>
                Movimiento de caja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
              
                <li class="nav-item">
                <a href="/historial" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Vista general</p>
                </a>
              </li>
              
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->