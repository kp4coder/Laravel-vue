    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="{{ asset('assets/images/laravel-logo.png') }}" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">Admin</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ url('admin/dashboard') }}" class="">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="menu-label">Home</li>
            <li>
                <a href="{{ url('admin/homeBanner') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Home Banner</div>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/manageSize') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Manage Size</div>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/manageColor') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Manage Color</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage Attributes</div>
                </a>
                <ul>
                    <li> <a href="{{ url('admin/attributeName') }}"><i class="bx bx-right-arrow-alt"></i>Names</a>
                    </li>
                    <li> <a href="{{ url('admin/attributeValue') }}"><i class="bx bx-right-arrow-alt"></i>Values</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage Category</div>
                </a>
                <ul>
                    <li> <a href="{{ url('admin/category') }}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                    </li>
                    <li> <a href="{{ url('admin/categoryAttribute') }}"><i class="bx bx-right-arrow-alt"></i>Category Attribute</a>
                    </li>
                </ul>
            </li>

            <li class="menu-label">Others</li>
            <li>
                <a href="{{ url('admin/profile') }}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">User Profile</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
    <!--end sidebar wrapper -->