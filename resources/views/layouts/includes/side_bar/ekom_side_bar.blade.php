<style>
  .page-sidebar .page-sidebar-menu > li > a,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li > a {
    border-top: 1px solid rgba(255, 255, 255, .1);
    color: #0B0B0B;
    font-weight: normal;
  }

  .page-sidebar .page-sidebar-menu > li.open > a,
  .page-sidebar .page-sidebar-menu > li:hover > a,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.open > a,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li:hover > a {
    background-color: rgba(0, 0, 0, 0.1);
    color: #0B0B0B;
  }

  .page-sidebar .page-sidebar-menu > li > a > i,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li > a > i {
    color: rgba(11, 11, 11, 0.7);
  }

  .page-sidebar .page-sidebar-menu > li.open > a > .arrow.open:before,
  .page-sidebar .page-sidebar-menu > li.open > a > .arrow:before,
  .page-sidebar .page-sidebar-menu > li.open > a > i, .page-sidebar .page-sidebar-menu > li:hover > a > .arrow.open:before,
  .page-sidebar .page-sidebar-menu > li:hover > a > .arrow:before,
  .page-sidebar .page-sidebar-menu > li:hover > a > i,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.open > a > .arrow.open:before,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.open > a > .arrow:before,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.open > a > i,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li:hover > a > .arrow.open:before,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li:hover > a > .arrow:before,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li:hover > a > i {
    color: rgba(11, 11, 11, 0.7);
  }

  .page-sidebar-menu {
    padding: 15px 0 !important;
    background-color: #ffffff !important;
  }

  .sidebar-logo {
    text-align: center;
    background-color: #ffffff;
  }

  .sidebar-logo img {
    display: inline-block;
    max-width: 100%;
  }

  .page-sidebar .page-sidebar-menu > li.active.open > a:hover,
  .page-sidebar .page-sidebar-menu > li.active > a:hover,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a:hover,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a:hover {
    background-color: #7EBE6F;
  }

  .page-sidebar .page-sidebar-menu > li.active.open > a,
  .page-sidebar .page-sidebar-menu > li.active > a,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a,
  .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a {
    background-color: #7EBE6F;
    color: #ffffff;
  }

  .asset {
    border: 3px solid #7EBE6F;
    padding: 15px;
    text-align: center;
  }

  .asset img {
    height: 50px;
    width: auto;
  }
</style>

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <div class="sidebar-logo">
        <a href="{{url('/')}}">
            <img src="{{asset('/')}}public/admin_ui_assets/layouts/layout/img/logo.png" alt="Logo">
        </a>
    </div>

    <ul class="page-sidebar-menu"
        data-keep-expanded="false"
        data-auto-scroll="true"
        style=""
        data-slide-speed="200">

      @if(@\Illuminate\Support\Facades\Auth::guard('web_admin')->user()->id)
        <li class="nav-item {{@$navMmList}}">
          <a href="{{url('mm-list')}}" class="nav-link">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="title">Bazar Bondhu</span>
          </a>
        </li>

        <li class="nav-item {{@$navTntmms}}">
          <a href="{{url('transacting-non-transacting-mms')}}" class="nav-link">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="title">Transacting/ <br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Non-Transacting List</span>
          </a>
        </li>

        <li class="{{@$navTransactionList}} nav-item">
          <a href="{{url('transaction-list')}}" class="nav-link">
            <i class="fa fa-money" aria-hidden="true"></i>
            <span class="title">Total Sales</span>
          </a>
        </li>

        <li class="{{@$navStrmntList}} nav-item">
          <a href="{{url('strmte-mngmnt')}}" class="nav-link">
            <i class="fa fa-money" aria-hidden="true"></i>
            <span class="title">Inventory Management</span>
          </a>
        </li>
      @else
      @endif

      <li style="margin-top: 30px; padding: 3px;">
        <div class="asset" style="margin-bottom: 3px">
          <img src="{{asset('/')}}public/admin_ui_assets/layouts/layout/img/assets-2.png" style="height: 60px" alt="">
        </div>
        <div class="asset">
          <img src="{{asset('/')}}public/admin_ui_assets/layouts/layout/img/assets-1.png" alt="">
        </div>
        <div style="margin-top:20px;">
            <div style="text-align:center">
                <span>FOLLOW US AT</span><br><br>
                <a href="https://www.facebook.com/bazarBondhu" target="_blank"><img style="height:40px;" src="{{asset('/')}}public/admin_ui_assets/layouts/layout/img/fb.png" alt=""></a>
                <a href="https://twitter.com/BazarBondhu" target="_blank"><img style="height:40px;" src="{{asset('/')}}public/admin_ui_assets/layouts/layout/img/twitter.png" alt=""></a>
                <!--<span style="font-size:16px;"><i style="color:#4267B2; padding-top:10px; font-size:24px;" class="fa fa-phone-square" aria-hidden="true"></i> <a href="tel: 01306326052"> 01306326052</a></span>-->
            </div>
        </div>
      </li>
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
