<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SisVerapaz</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  {!!Html::style('css/sisverapaz.css')!!}


  {!! Html::script('js/sisverapaz.js') !!}
  {!! Html::script('js/pruebasvue.js') !!}
  {!! Html::script('js/funcionesgenerales.js') !!}
  {!! Html::script('js/municipios.js') !!}

  <script>
    function carpeta()
        {
          var carpeta = window.location.href;
          var nombre = carpeta.split("/");
          return nombre[3];
        }
      $(document).ready(function () {


          //datatables
          var tabla = $('#example2').DataTable({
              language: {
                  processing: "Búsqueda en curso...",
                  search: "Búscar:",
                  lengthMenu: "Mostrar _MENU_ Elementos",
                  info: "Mostrando _START_ de _END_ de un total de _TOTAL_ elementos",
                  infoEmpty: "Visualizando 0 de 0 de un total de 0 elementos",
                  infoFiltered: "(Filtrado de _MAX_ elementos en total)",
                  infoPostFix: "",
                  loadingRecords: "Carga de datos en proceso..",
                  zeroRecords: "Elementos no encontrados",
                  emptyTable: "La tabla no contiene datos",
                  paginate: {
                      first: "Primero",
                      previous: "Anterior",
                      next: "siguiente",
                      last: "Último"
                  },
              },
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": false,
              "info": true,
              "autoWidth": false
          });

          var consulta = $('#consulta').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdf'

                },
                {
                    extend: 'excel'

                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            columnDefs: [ {
                targets: -1,
                visible: false
            } ],
              language: {
                  processing: "Búsqueda en curso...",
                  search: "Búscar:",
                  lengthMenu: "Mostrar _MENU_ Elementos",
                  info: "Mostrando _START_ de _END_ de un total de _TOTAL_ Elementos",
                  infoEmpty: "Visualizando 0 de 0 de un total de 0 elementos",
                  infoFiltered: "(Filtrado de _MAX_ elementos en total)",
                  infoPostFix: "",
                  loadingRecords: "Carga de datos en proceso..",
                  zeroRecords: "Elementos no encontrado",
                  emptyTable: "La tabla no contiene datos",
                  paginate: {
                      first: "Primero",
                      previous: "Anterior",
                      next: "siguiente",
                      last: "Último"
                  },
              },
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false
          });

});
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>VZ</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SisVerapaz</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Usuarios</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              
              <!-- Menu Body -->
              <li class="user-body">

                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('/home/perfil') }}" class="btn btn-default btn-flat"><i class="fa fa-user-circle"></i> Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-off"></i>
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          
        </div>
        <div class="pull-left info">
          <p>Usuario</p>
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>
     <!-- sidebar menu: : style can be found in sidebar.less -->
      @include('menu.menu')
    </section>
    <!-- /.sidebar -->
  </aside>
 <!-- aqui comienza el contenido -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    @yield('migasdepan')
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    @if(Session::has('mensaje'))
        <?php
          echo ("<script type='text/javascript'>toastr.success('". Session::get('mensaje') ."');</script>");
         ?>
    @endif
    @if(Session::has('error'))
      <?php
        echo ("<script type='text/javascript'>toastr.error('". Session::get('error') ."');</script>");
       ?>
    @endif
      @yield('content')

      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong> &copy; 2017 <a target="_blank" href="http://www.ues.edu.sv">Universidad de El Salvador. FMP</a>.</strong> Todos los derechos reservados
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


  <script>
  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yyyy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
      $(function () {
        var start = new Date(),
      	end = new Date(),
      	start2, end2;
        end.setDate(end.getDate() + 365);
          //Money Euro
          $("[data-mask]").inputmask();

          //Date picker
          $('.nacimiento').datepicker({
      	     selectOtherMonths: true,
             changeMonth: true,
             changeYear: true,
             dateFormat: 'dd-mm-yy',
             minDate: "-60Y",
             maxDate: "-18Y",
				     format: 'dd-mm-yyyy'
		         });

             $('.unafecha').datepicker({
         	     selectOtherMonths: true,
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy',
                minDate: start,
   				     format: 'dd-mm-yyyy'
   		         });


             $("#fecha_inicio").datepicker({
               selectOtherMonths: true,
               changeMonth: true,
               changeYear: true,
               dateFormat: 'dd-mm-yy',
               minDate: start,
               maxDate: end,
           	onSelect: function(){
           		start2 = $(this).datepicker("getDate");
           		end2 = $(this).datepicker("getDate");

           		start2.setDate(start2.getDate() + 1);
           		end2.setDate(end2.getDate() + 365);

           		$("#fecha_fin").datepicker({
                       selectOtherMonths: true,
                       changeMonth: true,
                       changeYear: true,
                       dateFormat: 'dd-mm-yy',
                       minDate: start2,
                       maxDate: end2
           		});
           	}
           });

          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
              checkboxClass: 'icheckbox_flat-green',
              radioClass: 'iradio_flat-green'
          });

          var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }




      });

                      function baja(id,ruta)
                        {
                            swal({
                              title: 'Motivo por el que da de baja',
                              input: 'text',
                              showCancelButton: true,
                              confirmButtonText: 'Dar de baja',
                              showLoaderOnConfirm: true,
                              preConfirm: (text) => {
                                return new Promise((resolve) => {
                                  setTimeout(() => {
                                    if (text === '') {
                                      swal.showValidationError(
                                        'El motivo es requerido.'
                                      )
                                    }
                                    resolve()
                                  }, 2000)
                                })
                              },
                              allowOutsideClick: () => !swal.isLoading()
                            }).then((result) => {
                              if (result.value) {
                                var dominio = window.location.host;
                                var form = $(this).parents('form');
                                $('#baja').attr('action','http://'+dominio+'/'+carpeta()+'/public/'+ruta+'/baja/'+id+'+'+result.value);
                                //document.getElmentById('baja').submit();
                                $('#baja').submit();
                                swal({
                                  type: 'success',
                                  title: 'Solicitud finalizada',
                                  html: 'Motivo: ' + result.value
                                })
                              }
                            })
                        }

                        function alta(id,ruta)
                        {
                            swal({
                                title: 'Dar de alta',
                                showCancelButton: true,
                                confirmButtonText: 'Dar de alta',
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false
                            }).then(function () {
                                var dominio = window.location.host;
                                var form = $(this).parents('form');
                                $('#alta').attr('action','http://'+dominio+'/'+carpeta()+'/public/'+ruta+'/alta/'+id);
                                //document.getElmentById('baja').submit();
                                $('#alta').submit();
                                swal({
                                    type: 'success',
                                    title: 'Se dio de alta',
                                    html: 'Submitted motivo: '
                                })
                            })
                        }

                        $("#form-configuracion").steps({
                          headerTag: "h3",
                          bodyTag: "section",
                          transitionEffect: "slideLeft",
                          stepsOrientation: "vertical",
                          enableAllSteps: true,
                          enablePagination: false
                        });
  </script>

@yield('scripts')

</body>
</html>
