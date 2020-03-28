<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/admin/favicon.png')}}">
  <title>1 INR</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('css/admin/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- Menu CSS -->
  <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{ asset('css/admin/animate.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
  <!-- color CSS -->
  <link href="{{ asset('css/admin/colors/default.css') }}" id="theme" rel="stylesheet">
  {{-- Switch --}}
  <link href="{{ asset('css/admin/switchery.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/admin/custom-select.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/admin/responsive.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/admin/style.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/admin/dropify.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/admin/sweetalert.css') }}" rel="stylesheet"/>
  {{-- <link href="{{ asset('css/admin/tinymce.css') }}" rel="stylesheet"/> --}}
  {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}



  {{-- DatePicker --}}
  <link href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
  <style type="text/css">

    .datepicker-dropdown {
      /*top: 155px !important;*/
      margin-top: 30px !important;
      top: 0;
      left: 0;
    }

    .btn-info.btn-outline:focus{
      background: transparent;
      color: #41b3f9;
    }
    .parsley-errors-list{
      list-style-type: none;
      padding-left: 0px;
      color: red;
    }
    .table-responsive::-webkit-scrollbar {
      width: 1em;
    }

    .table-responsive::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }

    .table-responsive::-webkit-scrollbar-thumb {
      background-color: gray;
      outline: 1px solid gray;
    }
    .form-control[readonly]{
      background: white;
    }
  </style>

  @yield('css')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="fix-header">
  <!-- ============================================================== -->
  <!-- Preloader -->
  <!-- ============================================================== -->
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <!-- ============================================================== -->
  <!-- Wrapper -->
  <!-- ============================================================== -->
  <div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
      <div class="navbar-header">
        <div class="top-left-part">
          <!-- Logo -->
          <a class="logo" href="#">
            <!-- Logo icon image, you can use font-icon also --><b>
              <!--This is dark logo icon-->
              {{-- <img src="{{asset('images/one-inr_old.png')}}" width="50px" height="50px" alt="home" class="light-logo"/> --}}
              <!--This is light logo icon-->
              {{-- <img src="{{asset('images/admin/admin-logo-dark.png')}}" alt="home" class="light-logo" /> --}}
            </b>
            <!-- Logo text image you can use text also -->
            <span class="hidden-xs">
              <!--This is dark logo text-->
              {{-- <img src="{{asset('images/admin/admin-text.png')}}" alt="home" class="dark-logo" /> --}}
              <!--This is light logo text-->
              <img style="padding-top: 4%;" src="{{asset('images/one-inr.png')}}" alt="home" class="light-logo" />
            </span>
          </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
          <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
          {{-- <li class="dropdown">
            <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-gmail"></i>
              <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <ul class="dropdown-menu mailbox animated bounceInDown">
              <li>
                <div class="drop-title">You have 4 new messages</div>
              </li>
              <li>
                <div class="message-center">
                  <a href="#">
                    <div class="user-img"> <img src="{{asset('images/admin/users/pawandeep.jpg')}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                    </a>
                    <a href="#">
                      <div class="user-img"> <img src="{{asset('images/admin/users/sonu.jpg')}}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                      <div class="mail-contnet">
                        <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                      </a>
                      <a href="#">
                        <div class="user-img"> <img src="{{asset('images/admin/users/arijit.jpg')}}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                        <div class="mail-contnet">
                          <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                        </a>
                        <a href="#">
                          <div class="user-img"> <img src="{{asset('images/admin/users/pawandeep.jpg')}}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                          <div class="mail-contnet">
                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                          </a>
                        </div>
                      </li>
                      <li>
                        <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                      </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                  </li> --}}
                  <!-- .Task dropdown -->
                  {{-- <li class="dropdown">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-check-circle"></i>
                      <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                      <li>
                        <a href="#">
                          <div>
                            <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#">
                          <div>
                            <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#">
                          <div>
                            <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#">
                          <div>
                            <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                      </li>
                    </ul>
                  </li> --}}
                  <!-- .Megamenu -->
                    <!-- <li class="mega-dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Mega</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Forms Elements</li>
                                    <li><a href="form-basic.html">Basic Forms</a></li>
                                    <li><a href="form-layout.html">Form Layout</a></li>
                                    <li><a href="form-advanced.html">Form Addons</a></li>
                                    <li><a href="form-material-elements.html">Form Material</a></li>
                                    <li><a href="form-float-input.html">Form Float Input</a></li>
                                    <li><a href="form-upload.html">File Upload</a></li>
                                    <li><a href="form-mask.html">Form Mask</a></li>
                                    <li><a href="form-img-cropper.html">Image Cropping</a></li>
                                    <li><a href="form-validation.html">Form Validation</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Advance Forms</li>
                                    <li><a href="form-dropzone.html">File Dropzone</a></li>
                                    <li><a href="form-pickers.html">Form-pickers</a></li>
                                    <li><a href="form-wizard.html">Form-wizards</a></li>
                                    <li><a href="form-typehead.html">Typehead</a></li>
                                    <li><a href="form-xeditable.html">X-editable</a></li>
                                    <li><a href="form-summernote.html">Summernote</a></li>
                                    <li><a href="form-bootstrap-wysihtml5.html">Bootstrap wysihtml5</a></li>
                                    <li><a href="form-tinymce-wysihtml5.html">Tinymce wysihtml5</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Table Example</li>
                                    <li><a href="basic-table.html">Basic Tables</a></li>
                                    <li><a href="table-layouts.html">Table Layouts</a></li>
                                    <li><a href="data-table.html">Data Table</a></li>
                                    <li><a href="bootstrap-tables.html">Bootstrap Tables</a></li>
                                    <li><a href="responsive-tables.html">Responsive Tables</a></li>
                                    <li><a href="editable-tables.html">Editable Tables</a></li>
                                    <li><a href="foo-tables.html">FooTables</a></li>
                                    <li><a href="jsgrid.html">JsGrid Tables</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Charts</li>
                                    <li> <a href="flot.html">Flot Charts</a> </li>
                                    <li><a href="morris-chart.html">Morris Chart</a></li>
                                    <li><a href="chart-js.html">Chart-js</a></li>
                                    <li><a href="peity-chart.html">Peity Charts</a></li>
                                    <li><a href="knob-chart.html">Knob Charts</a></li>
                                    <li><a href="sparkline-chart.html">Sparkline charts</a></li>
                                    <li><a href="extra-charts.html">Extra Charts</a></li>
                                </ul>
                            </li>
                        </ul>
                      </li> -->
                      <!-- /.Megamenu -->
                    </ul>
                    <ul class="nav navbar-top-links navbar-right pull-right">
                      {{-- <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                          <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                        </li> --}}
                        <li class="dropdown">
                          @php
                          $user = Auth::user();
                          $userImg = $user['profile_image'] ? $user['profile_image'] : 'no-img.png'; 
                          @endphp
                          <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
                            {{-- <img src="{{asset('uploads/'.$userImg)}}" alt="user-img" width="36" class="img-circle"> --}}
                            <b class="hidden-xs">{{ Auth::user()['name'] }}</b><span class="caret"></span> </a>
                            <ul class="dropdown-menu dropdown-user animated flipInY">
                              <li>
                                <div class="dw-user-box">
                                  {{-- <div class="u-img"><img src="{{asset('uploads/'.$userImg)}}" alt="user" style="border-radius: 50%" /></div> --}}
                                  <div class="u-text">
                                    <h4>{{ Auth::user()['name'] }}</h4>
                                    <p class="text-muted">{{ Auth::user()['email'] }}</p><a href="{{ url('admin/profile') }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                  </div>
                                </li>
                                {{-- <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                <li role="separator" class="divider"></li>
                                <li role="separator" class="divider"></li> --}}
                                <li><a href="{{ url('admin/logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                              </ul>
                              <!-- /.dropdown-user -->
                            </li>
                            <!-- /.dropdown -->
                          </ul>
                        </div>
                        <!-- /.navbar-header -->
                        <!-- /.navbar-top-links -->
                        <!-- /.navbar-static-side -->
                      </nav>
                      <!-- End Top Navigation -->
                      <!-- ============================================================== -->
                      <!-- Left Sidebar - style you can find in sidebar.scss  -->
                      <!-- ============================================================== -->

                      <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav slimscrollsidebar">
                          <div class="sidebar-head">
                            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                            <div class="user-profile">
                   <!--  <div class="dropdown user-pro-body">
                        <div><img src="{{asset('images/admin/users/varun.jpg')}}" alt="user-img" class="img-circle"></div>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Steave Gection <span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                      </div> -->
                    </div>
                    <ul class="nav" id="side-menu">
                      <li> <a href="{{ url('admin/dashboard') }}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a>
                      </li>

                      {{-- <li> <a href="javascript:void(0);" class="waves-effect "><i class="mdi mdi-account-settings-variant fa-fw" data-icon="v"></i> <span class="hide-menu"> Roles <span class="fa arrow"></span><span class="label label-rouded label-info pull-right">2</span> </span></a>
                        <ul class="nav nav-second-level">
                          <li> <a href="products.html"><i class="fa-fw">A</i><span class="hide-menu">Add Role</span></a> </li>
                          <li> <a href="product-orders.html"><i class="fa-fw">V</i><span class="hide-menu">View All Role's</span></a> </li>
                        </ul>
                      </li> --}}

                      @can('permission','1|2')
                      <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account fa-fw" data-icon="v"></i> <span class="hide-menu"> Donors <span class="fa arrow"></span> {{-- <span class="label label-rouded label-info pull-right">2</span> --}}</span></a>
                        <ul class="nav nav-second-level">
                          @can('permission','2')
                          <li><a href="{{ url('admin/users/create') }}">
                            {{-- <i class="fa-fw">A</i> --}}
                            <span class="hide-menu">Add Donor</span></a> 
                          </li>
                          @endcan

                          @can('permission','1|2')
                          <li> 
                            <a href="{{ url('admin/users') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">View All Donor's</span></a> 
                          </li>
                          @endcan
                        </ul>
                      </li>
                      @endcan
                      @can('permission','3|4')

                      <li><a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-emoticon-happy fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> NGO <span class="fa arrow"></span>
                        {{-- <span class="label label-rouded label-info pull-right">2</span> --}} </span>
                      </a>
                      <ul class="nav nav-second-level">
                        @can('permission','4')

                        <li> <a href="{{ route('ngo.create') }}">{{-- <i class="fa-fw">A</i> --}}<span class="hide-menu">Add NGO</span></a> </li>
                        @endcan
                        @can('permission','3|4')
                        <li> <a href="{{ route('ngo.index') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">View All NGO's</span></a> </li>
                        @endcan
                      </ul>
                    </li>
                    @endcan
                    @can('permission','5|6')

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-library-books fa-fw" data-icon="v"></i> <span class="hide-menu">Projects<span class="fa arrow"></span> {{-- <span class="label label-rouded label-info pull-right">2</span> --}}</span></a>
                      <ul class="nav nav-second-level">
                        @can('permission','6')

                        <li><a href="{{ url('admin/projects/create') }}">
                          {{-- <i class="fa-fw">A</i> --}}
                          <span class="hide-menu">Add Project</span></a> 
                        </li>
                        @endcan
                        @can('permission','5|6')

                        <li> 
                          <a href="{{ url('admin/projects') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">View All Projects</span></a> 
                        </li>

                        @if(Auth::user()['role_id'] == 1)
                        <li> 
                          <a href="{{ url('admin/completed-projects') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">Completed Projects</span></a> 
                        </li>
                        @endif
                        @endcan
                      </ul>
                    </li>
                    @endcan

                    @can('permission','7|8')

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-library-books fa-fw" data-icon="v"></i> <span class="hide-menu">Accounts<span class="fa arrow"></span> {{-- <span class="label label-rouded label-info pull-right">2</span> --}}</span></a>
                      <ul class="nav nav-second-level">
                        @can('permission','6')

                        <li><a href="{{ route('payments.index') }}">
                          {{-- <i class="fa-fw">A</i> --}}
                          <span class="hide-menu">Payments</span></a> 
                        </li>
                        @endcan

                      </ul>
                    </li>
                    @endcan

                    <li> <a href="#" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i></i> <span class="hide-menu">Setting<span class="fa arrow"></span> {{-- <span class="label label-rouded label-info pull-right">2</span> --}}</span></a>
                      <ul class="nav nav-second-level">

                        <li>
                          <a href="{{ url('admin/profile') }}">
                            {{-- <i class="fa-fw">A</i> --}}
                            <span class="hide-menu">My Profile</span></a> 
                          </li>
                          @if(Auth::user()['role_id'] == 1)
                          <li> 
                            <a href="{{ url('admin/roles') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">Roles</span></a> 
                          </li>
                          <li> 
                            <a href="{{ url('admin/editors') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">Users</span></a> 
                          </li>

                          <li> 
                            <a href="{{ url('admin/config') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">Config</span></a> 
                          </li>

                          <li> 
                            <a href="{{ url('admin/razorpaycredentials') }}">{{-- <i class="fa-fw">V</i> --}}<span class="hide-menu">Razorpay credentials</span></a> 
                          </li>

                          @endif
                        </ul>
                      </li>


                      {{-- <li> <a href="{{ url('admin/projects') }}" class="waves-effect"><i class="mdi mdi-library-books fa-fw" data-icon="v"></i> <span class="hide-menu"> View All Projects </span></a>
                      </li> --}}


                      {{-- <li> 
                        <a href="{{ url('admin/profile') }}" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i></i> <span class="hide-menu"> Settings </span></a>
                      </li> --}}

                      <li><a href="{{ url('admin/donoremail') }}" class="waves-effect"><i class="mdi mdi-logtout fa-fw"></i> <span class="hide-menu">Donor Email</span></a></li>


                    <!-- <li> <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="panels-wells.html"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Panels and Wells</span></a></li>
                            <li><a href="panel-ui-block.html"><i data-icon="&#xe025;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Panels With BlockUI</span></a></li>
                            <li><a href="buttons.html"><i class="ti-layout-menu fa-fw"></i> <span class="hide-menu">Buttons</span></a></li>
                            <li><a href="sweatalert.html"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Sweat alert</span></a></li>
                            <li><a href="typography.html"><i data-icon="k" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Typography</span></a></li>
                            <li><a href="grid.html"><i data-icon="&#xe009;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Grid</span></a></li>
                            <li><a href="tabs.html"><i  class="ti-layers fa-fw"></i> <span class="hide-menu">Tabs</span></a></li>
                            <li><a href="tab-stylish.html"><i class=" ti-layers-alt fa-fw"></i> <span class="hide-menu">Stylish Tabs</span></a></li>
                            <li><a href="modals.html"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Modals</span></a></li>
                            <li><a href="progressbars.html"><i class="ti-line-double fa-fw"></i> <span class="hide-menu">Progress Bars</span></a></li>
                            <li><a href="notification.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Notifications</span></a></li>
                            <li><a href="carousel.html"><i class="ti-layout-slider fa-fw"></i> <span class="hide-menu">Carousel</span></a></li>
                            <li><a href="list-style.html"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">List & Media object</span></a></li>
                            <li><a href="user-cards.html"><i class="ti-user fa-fw"></i> <span class="hide-menu">User Cards</span></a></li>
                            <li><a href="timeline.html"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Timeline</span></a></li>
                            <li><a href="timeline-horizontal.html"><i class="ti-layout-list-thumb fa-fw"></i> <span class="hide-menu">Horizontal Timeline</span></a></li>
                            <li><a href="nestable.html"><i class="ti-layout-accordion-separated fa-fw"></i> <span class="hide-menu">Nesteble</span></a></li>
                            <li><a href="range-slider.html"><i class=" ti-layout-slider-alt fa-fw"></i> <span class="hide-menu">Range Slider</span></a></li>
                            <li><a href="tooltip-stylish.html"><i class="ti-comments-smiley fa-fw"></i> <span class="hide-menu">Stylish Tooltip</span></a></li>
                            <li><a href="bootstrap.html"><i class="ti-rocket fa-fw"></i> <span class="hide-menu">Bootstrap UI</span></a></li>
                        </ul>
                    </li>
                    <li> <a href="#" class="waves-effect active"><i class="mdi mdi-content-copy fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-warning pull-right">30</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="starter-page.html"><i class="ti-layout-width-default fa-fw"></i> <span class="hide-menu">Starter Page</span></a></li>
                            <li><a href="blank.html"><i class="ti-layout-sidebar-left fa-fw"></i> <span class="hide-menu">Blank Page</span></a></li>
                            <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-email fa-fw"></i> <span class="hide-menu">Email Templates</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="../email-templates/basic.html"><i class="fa-fw">B</i> <span class="hide-menu">Basic</span></a></li>
                                    <li> <a href="../email-templates/alert.html"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Alert</span></a></li>
                                    <li> <a href="../email-templates/billing.html"><i class="ti-wallet fa-fw"></i> <span class="hide-menu">Billing</span></a></li>
                                    <li> <a href="../email-templates/password-reset.html"><i class="ti-more fa-fw"></i> <span class="hide-menu">Reset Pwd</span></a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-lock fa-fw"></i><span class="hide-menu">Authentication</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="login.html"><i class="fa-fw">L</i> <span class="hide-menu">Login Page</span></a></li>
                                    <li><a href="login2.html"><i class="fa-fw">L</i> <span class="hide-menu">Login v2</span></a></li>
                                    <li><a href="register.html"><i class="fa-fw">R</i> <span class="hide-menu">Register</span></a></li>
                                    <li><a href="register2.html"><i class="fa-fw">R</i> <span class="hide-menu">Register v2</span></a></li>
                                    <li><a href="register3.html"><i class="fa-fw">3</i> <span class="hide-menu">3 Step Registration</span></a></li>
                                    <li><a href="recoverpw.html"><i class="fa-fw">R</i> <span class="hide-menu">Recover Password</span></a></li>
                                    <li><a href="lock-screen.html"><i class="fa-fw">L</i> <span class="hide-menu">Lock Screen</span></a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-info-alt fa-fw"></i><span class="hide-menu">Error Pages</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="400.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Error 400</span></a></li>
                                    <li><a href="403.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Error 403</span></a></li>
                                    <li><a href="404.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Error 404</span></a></li>
                                    <li><a href="500.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Error 500</span></a></li>
                                    <li><a href="503.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Error 503</span></a></li>
                                </ul>
                            </li>
                            <li><a href="lightbox.html"><i class="fa-fw">L</i> <span class="hide-menu">Lightbox Popup</span></a></li>
                            <li><a href="treeview.html"><i class="fa-fw">T</i> <span class="hide-menu">Treeview</span></a></li>
                            <li><a href="search-result.html"><i class="fa-fw">S</i> <span class="hide-menu">Search Result</span></a></li>
                            <li><a href="utility-classes.html"><i class="fa-fw">U</i> <span class="hide-menu">Utility Classes</span></a></li>
                            <li><a href="custom-scroll.html"><i class="fa-fw">C</i> <span class="hide-menu">Custom Scrolls</span></a></li>
                            <li><a href="animation.html"><i class="fa-fw">A</i> <span class="hide-menu">Animations</span></a></li>
                            <li><a href="profile.html"><i class="fa-fw">P</i> <span class="hide-menu">Profile</span></a></li>
                            <li><a href="invoice.html"><i class="fa-fw">I</i> <span class="hide-menu">Invoice</span></a></li>
                            <li><a href="faq.html"><i class="fa-fw">F</i> <span class="hide-menu">FAQ</span></a></li>
                            <li><a href="gallery.html"><i class="fa-fw">G</i> <span class="hide-menu">Gallery</span></a></li>
                            <li><a href="pricing.html"><i class="fa-fw">P</i> <span class="hide-menu">Pricing</span></a></li>
                        </ul>
                    </li>
                    <li><a href="inbox.html" class="waves-effect"><i class="mdi mdi-apps fa-fw"></i> <span class="hide-menu">Apps<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="chat.html"><i class="ti-comments-smiley fa-fw"></i><span class="hide-menu">Chat-message</span></a></li>
                            <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-desktop fa-fw"></i><span class="hide-menu">Inbox</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="inbox.html"><i class="ti-email fa-fw"></i><span class="hide-menu">Mail box</span></a></li>
                                    <li> <a href="inbox-detail.html"><i class="ti-layout-media-left-alt fa-fw"></i><span class="hide-menu">Inbox detail</span></a></li>
                                    <li> <a href="compose.html"><i class="ti-layout-media-center-alt fa-fw"></i><span class="hide-menu">Compose mail</span></a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-user fa-fw"></i><span class="hide-menu">Contacts</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="contact.html"><i class="icon-people fa-fw"></i><span class="hide-menu">Contact1</span></a></li>
                                    <li> <a href="contact2.html"><i class="icon-user-follow fa-fw"></i><span class="hide-menu">Contact2</span></a></li>
                                    <li> <a href="contact-detail.html"><i class="icon-user-following fa-fw"></i><span class="hide-menu">Contact Detail</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <li> <a href="forms.html" class="waves-effect"><i class="mdi mdi-clipboard-text fa-fw"></i> <span class="hide-menu">Forms<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="form-basic.html"><i class="fa-fw">B</i><span class="hide-menu">Basic Forms</span></a></li>
                            <li><a href="form-layout.html"><i class="fa-fw">L</i><span class="hide-menu">Form Layout</span></a></li>
                            <li><a href="form-advanced.html"><i class="fa-fw">A</i><span class="hide-menu">Form Addons</span></a></li>
                            <li><a href="form-material-elements.html"><i class="fa-fw">M</i><span class="hide-menu">Form Material</span></a></li>
                            <li><a href="form-float-input.html"><i class="fa-fw">F</i><span class="hide-menu">Form Float Input</span></a></li>
                            <li><a href="form-upload.html"><i class="fa-fw">U</i><span class="hide-menu">File Upload</span></a></li>
                            <li><a href="form-mask.html"><i class="fa-fw">M</i><span class="hide-menu">Form Mask</span></a></li>
                            <li><a href="form-img-cropper.html"><i class="fa-fw">C</i><span class="hide-menu">Image Cropping</span></a></li>
                            <li><a href="form-validation.html"><i class="fa-fw">V</i><span class="hide-menu">Form Validation</span></a></li>
                            <li><a href="form-dropzone.html"><i class="fa-fw">D</i><span class="hide-menu">File Dropzone</span></a></li>
                            <li><a href="form-pickers.html"><i class="fa-fw">P</i><span class="hide-menu">Form-pickers</span></a></li>
                            <li><a href="form-wizard.html"><i class="fa-fw">W</i><span class="hide-menu">Form-wizards</span></a></li>
                            <li><a href="form-typehead.html"><i class="fa-fw">T</i><span class="hide-menu">Typehead</span></a></li>
                            <li><a href="form-xeditable.html"><i class="fa-fw">X</i><span class="hide-menu">X-editable</span></a></li>
                            <li><a href="form-summernote.html"><i class="fa-fw">S</i><span class="hide-menu">Summernote</span></a></li>
                            <li><a href="form-bootstrap-wysihtml5.html"><i class=" fa-fw">W</i><span class="hide-menu">Bootstrap wysihtml5</span></a></li>
                            <li><a href="form-tinymce-wysihtml5.html"><i class="fa-fw">T</i><span class="hide-menu">Tinymce wysihtml5</span></a></li>
                        </ul>
                    </li>
                    <li> <a href="tables.html" class="waves-effect"><i class="mdi mdi-table fa-fw"></i> <span class="hide-menu">Tables<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">9</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="basic-table.html"><i class="fa-fw">B</i><span class="hide-menu">Basic Tables</span></a></li>
                            <li><a href="table-layouts.html"><i class="fa-fw">L</i><span class="hide-menu">Table Layouts</span></a></li>
                            <li><a href="data-table.html"><i class="fa-fw">D</i><span class="hide-menu">Data Table</span></a></li>
                            <li><a href="bootstrap-tables.html"><i class="fa-fw">B</i><span class="hide-menu">Bootstrap Tables</span></a></li>
                            <li><a href="responsive-tables.html"><i class="fa-fw">R</i><span class="hide-menu">Responsive Tables</span></a></li>
                            <li><a href="editable-tables.html"><i class="fa-fw">E</i><span class="hide-menu">Editable Tables</span></a></li>
                            <li><a href="foo-tables.html"><i class="fa-fw">F</i><span class="hide-menu">FooTables</span></a></li>
                            <li><a href="jsgrid.html"><i class="fa-fw">J</i><span class="hide-menu">JsGrid Tables</span></a></li>
                        </ul>
                    </li>
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-chart-bar fa-fw"></i> <span class="hide-menu">Charts<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="flot.html"><i class="fa-fw">F</i><span class="hide-menu">Flot Charts</span></a> </li>
                            <li><a href="morris-chart.html"><i class="fa-fw">M</i><span class="hide-menu">Morris Chart</span></a></li>
                            <li><a href="chart-js.html"><i class="fa-fw">P</i><span class="hide-menu">Chart-js</span></a></li>
                            <li><a href="peity-chart.html"><i class="fa-fw">P</i><span class="hide-menu">Peity Charts</span></a></li>
                            <li><a href="chartist-js.html"><i class="fa-fw">C</i><span class="hide-menu">Chartist-js</span></a></li>
                            <li><a href="knob-chart.html"><i class="fa-fw">K</i><span class="hide-menu">Knob Charts</span></a></li>
                            <li><a href="sparkline-chart.html"><i class="fa-fw">S</i><span class="hide-menu">Sparkline charts</span></a></li>
                            <li><a href="extra-charts.html"><i class="fa-fw">E</i><span class="hide-menu">Extra Charts</span></a></li>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <li> <a href="widgets.html" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li>
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-emoticon fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="fontawesome.html"><i class="fa-fw">F</i><span class="hide-menu">Font awesome</span></a> </li>
                            <li> <a href="themifyicon.html"><i class="fa-fw">T</i><span class="hide-menu">Themify Icons</span></a> </li>
                            <li> <a href="simple-line.html"><i class="fa-fw">S</i><span class="hide-menu">Simple line Icons</span></a> </li>
                            <li> <a href="material-icons.html"><i class="fa-fw">M</i><span class="hide-menu">Material Icons</span></a> </li>
                            <li><a href="linea-icon.html"><i class="fa-fw">L</i><span class="hide-menu">Linea Icons</span></a></li>
                            <li><a href="weather.html"><i class="fa-fw">W</i><span class="hide-menu">Weather Icons</span></a></li>
                        </ul>
                    </li>
                    <li> <a href="map-google.html" class="waves-effect"><i class="mdi mdi-google-maps fa-fw"></i><span class="hide-menu">Google Map</span></a> </li>
                    <li> <a href="map-vector.html" class="waves-effect"><i class="mdi mdi-map-marker fa-fw"></i><span class="hide-menu">Vector Map</span></a> </li>
                    <li> <a href="calendar.html" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw"></i> <span class="hide-menu">Calendar</span></a></li>
                    <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-checkbox-multiple-marked-outline fa-fw"></i> <span class="hide-menu">Multi-Level Dropdown<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="javascript:void(0)"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Second Level Item</span></a> </li>
                            <li> <a href="javascript:void(0)"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Second Level Item</span></a> </li>
                            <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Third Level </span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">T</i><span class="hide-menu">Third Level Item</span></a> </li>
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">M</i><span class="hide-menu">Third Level Item</span></a> </li>
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">R</i><span class="hide-menu">Third Level Item</span></a> </li>
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">G</i><span class="hide-menu">Third Level Item</span></a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <li><a href="documentation.html" class="waves-effect"><i class="fa fa-circle-o text-danger"></i> <span class="hide-menu">Documentation</span></a></li>
                    <li><a href="gallery.html" class="waves-effect"><i class="fa fa-circle-o text-info"></i> <span class="hide-menu">Gallery</span></a></li>
                    <li><a href="faq.html" class="waves-effect"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">Faqs</span></a></li> -->
                    
                    <li><a href="{{ route('admin.logout') }}" class="waves-effect"><i class="mdi mdi-logtout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                  </ul>
                </div>
              </div>

              <!-- ============================================================== -->
              <!-- End Left Sidebar -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Page Content -->
              <!-- ============================================================== -->
              <div id="page-wrapper">
                @yield('body')

                <!-- /.container-fluid -->
                <footer class="footer text-center"> 2018 &copy; 1 INR </footer>
              </div>
              <!-- ============================================================== -->
              <!-- End Page Content -->
              <!-- ============================================================== -->
            </div>
            <!-- /#wrapper -->
            <!-- jQuery -->
            <script src="{{ asset('js/admin/jquery.min.js')}}"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="{{ asset('js/admin/bootstrap.min.js')}}"></script>
            <!-- Menu Plugin JavaScript -->
            <script src="{{ asset('js/admin/sidebar-nav.min.js')}}"></script>
            <!--slimscroll JavaScript -->
            <script src="{{ asset('js/admin/jquery.slimscroll.js')}}"></script>
            <!--Wave Effects -->
            <script src="{{ asset('js/admin/waves.js')}}"></script>
            <!-- Custom Theme JavaScript -->
            <script src="{{ asset('js/admin/custom.min.js')}}"></script>
            <!--Style Switcher -->
            <script src="{{ asset('js/admin/jQuery.style.switcher.js')}}"></script>
            {{-- DataTable JavaScripts --}}
            <script src="{{ asset('js/admin/jquery.dataTables.min.js')}}"></script>
            {{-- Switch --}}
            <script src="{{ asset('js/admin/switchery.min.js')}}"></script>
            {{-- DatePicker --}}
            <script src="{{ asset('js/admin/bootstrap-datepicker.min.js')}}"></script>
            <script src="{{ asset('js/admin/custom-select.min.js')}}"></script>
            <script src="{{ asset('js/admin/jasny-bootstrap.js')}}"></script>
            <script src="{{ asset('js/admin/dropify.min.js')}}"></script>
            <script src="{{ asset('js/admin/sweetalert.min.js')}}"></script>
            <script src="{{ asset('js/admin/jquery.sweet-alert.custom.js')}}"></script>
            <script src="{{ asset('js/admin/parsley.min.js')}}"></script>
            <script src="{{ asset('js/admin/tinymce.min.js')}}"></script>
            <script src="{{ asset('js/admin/vue.min.js')}}"></script>
            {{-- <script src="{{ asset('js/admin/jquery.validate.min.js')}}"></script> --}}
            {{-- <script src="https://vuejs.org/js/vue.js"></script> --}}
            {{-- <script src="{{ asset('js/admin/uploadHBR.min.js')}}"></script> --}}
            {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
            <!-- start - This is for export functionality only -->
            {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
            <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
            <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

            <script type="text/javascript">
              $("form").attr('autocomplete', 'off');

              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('img').on('error', function(){
                $(this).attr('src','{{ asset('uploads/no-image.png') }}');
              });
            </script>

            @yield('bottom-script')
          </body>

          </html>
