 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        @php($image = admin_image(admin('image'), admin('gender')))
        <img src="{{ asset($image) }}" class="avatar-sm rounded-circle mr-2 admin-profile-image" alt="{{ admin('first_name') }}" />
        <img src="{{ asset($image) }}" class="avatar-xs rounded-circle mr-2 admin-profile-image" alt="{{ admin('first_name') }}" />
        <!-- admins/images/users/avatar-7.jpg -->
        <div class="media-body">
            <h6 class="pro-user-name mt-0 mb-0">{{ ucfirst(admin('first_name')) }}</h6>
            <span class="pro-user-desc">{{ ucfirst(admin('type')) }}</span>
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="{{ url('/admin/profile') }}" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>Profile</span>
                </a>

                <a href="{{ url('/admin/change-password') }}" class="dropdown-item notify-item">
                    <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                    <span>Password</span>
                </a>

                <a href="{{ url('/admin/settings') }}" class="dropdown-item notify-item">
                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                    <span>Settings</span>
                </a>

                <div class="dropdown-divider"></div>
                @if(admin_loggedin())
                <a href="{{ url('/admin/logout') }}" class="dropdown-item notify-item logout_modal_open_btn">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ url('/admin') }}">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="menu-title">Apps</li>
                <!-- <li>
                    <a href="apps-calendar.html">
                        <i data-feather="calendar"></i>
                        <span> Members </span>
                    </a>
                </li> -->
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-users"></i>
                        <span> Members </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/basic') }}">Basic</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/premium') }}">Premium</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/unapproved') }}">Unapproved</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/deactivated') }}">Deactivated</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/add-member') }}">Add member</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-cube"></i>
                        <span> Options </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/genotype') }}">Genotype</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/marital-status') }}">Marital status</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/drinking') }}">Drinking</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/smoking') }}">Smoking</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/body-types') }}">Body types</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/heights') }}">Heights</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/weights') }}">Weights</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/states') }}">States</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="bookmark"></i>
                        <span> Subscription</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/subscription') }}">Subscriptions</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/user-subscription') }}">User subscriptions</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/manual-subscription') }}">Manual subscriptions</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/notification') }}">
                        <i class="far fa-bell"></i>
                        <span>Notifications</span>
                        <span class="bg-danger badge admin_notification_alert" style="color: #fff; font-size: 9px;"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/reports') }}">
                        <i class="far fa-circle"></i>
                        <span>Reported members</span>
                        @if(report_count() > 0)
                        <span class="bg-danger badge" style="color: #fff; font-size: 9px;">{{ report_count() }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/contact') }}">
                        <i class="fa fa-phone"></i>
                        <span> Contact</span>
                        @if(contact_count() > 0)
                        <span class="bg-danger badge" style="color: #fff; font-size: 9px;">{{ contact_count() }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="far fa-user"></i>
                        <span> Account</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/profile') }}">Profile</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/change-password') }}">Change password</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="far fa-envelope"></i>
                        <span> News letters</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/sent-newsletters') }}">Sent</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/saved-newsletters') }}">Saved</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/news-letter') }}">News letters</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/compose-newsletter') }}">Compose letter</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/newsletter-subscriptions') }}">Subscribers</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/how-it-works') }}">
                        <i class="fa fa-file"></i>
                        <span> How it works</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-key"></i>
                        <span> Legal</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/about-us') }}">About us</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/privacy-policy') }}">Privacy policy</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/terms') }}">Terms & Condition</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-cog"></i>
                        <span>Settings</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ url('/admin/settings') }}">General settings</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/email-settings') }}">Email settings</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/payment-settings') }}">Payment settings</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/banner-settings') }}">Banner settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/logout') }}" class="logout_modal_open_btn">
                        <i class="fa fa-power-off"></i>
                        <span>Logout</span>
                    </a>
                </li>
                <!-- <li class="menu-title">Custom</li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="file-text"></i>
                        <span> Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="pages-starter.html">Starter</a>
                        </li>
                        <li>
                            <a href="pages-profile.html">Profile</a>
                        </li>
                        <li>
                            <a href="pages-activity.html">Activity</a>
                        </li>
                        <li>
                            <a href="pages-invoice.html">Invoice</a>
                        </li>
                        <li>
                            <a href="pages-pricing.html">Pricing</a>
                        </li>
                        <li>
                            <a href="pages-maintenance.html">Maintenance</a>
                        </li>
                        <li>
                            <a href="pages-login.html">Login</a>
                        </li>
                        <li>
                            <a href="pages-register.html">Register</a>
                        </li>
                        <li>
                            <a href="pages-recoverpw.html">Recover Password</a>
                        </li>
                        <li>
                            <a href="pages-confirm-mail.html">Confirm</a>
                        </li>
                        <li>
                            <a href="pages-404.html">Error 404</a>
                        </li>
                        <li>
                            <a href="pages-500.html">Error 500</a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li>
                    <a href="javascript: void(0);">
                        <i data-feather="layout"></i>
                        <span> Layouts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="layouts-horizontal.html">Horizontal Nav</a>
                        </li>
                        <li>
                            <a href="layouts-rtl.html">RTL</a>
                        </li>
                        <li>
                            <a href="layouts-dark.html">Dark</a>
                        </li>
                        <li>
                            <a href="layouts-scrollable.html">Scrollable</a>
                        </li>
                        <li>
                            <a href="layouts-boxed.html">Boxed</a>
                        </li>
                        <li>
                            <a href="layouts-preloader.html">With Pre-loader</a>
                        </li>
                        <li>
                            <a href="layouts-dark-sidebar.html">Dark Side Nav</a>
                        </li>
                        <li>
                            <a href="layouts-condensed.html">Condensed Nav</a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li class="menu-title">Components</li> -->

                <!-- <li>
                    <a href="javascript: void(0);">
                        <i data-feather="package"></i>
                        <span> UI Elements </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="components-bootstrap.html">Bootstrap UI</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">Icons
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level" aria-expanded="false">
                                <li>
                                    <a href="icons-feather.html">Feather Icons</a>
                                </li>
                                <li>
                                    <a href="icons-unicons.html">Unicons Icons</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="widgets.html">Widgets</a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li>
                    <a href="javascript: void(0);" aria-expanded="false">
                        <i data-feather="file-text"></i>
                        <span> Forms </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="forms-basic.html">Basic Elements</a>
                        </li>
                        <li>
                            <a href="forms-advanced.html">Advanced</a>
                        </li>
                        <li>
                            <a href="forms-validation.html">Validation</a>
                        </li>
                        <li>
                            <a href="forms-wizard.html">Wizard</a>
                        </li>
                        <li>
                            <a href="forms-editor.html">Editor</a>
                        </li>
                        <li>
                            <a href="forms-file-uploads.html">File Uploads</a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li>
                    <a href="charts-apex.html" aria-expanded="false">
                        <i data-feather="pie-chart"></i>
                        <span> Charts </span>
                    </a>
                </li> -->

                <!-- <li>
                    <a href="javascript: void(0);" aria-expanded="false">
                        <i data-feather="grid"></i>
                        <span> Tables </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="tables-basic.html">Basic</a>
                        </li>
                        <li>
                            <a href="tables-datatables.html">Advanced</a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->