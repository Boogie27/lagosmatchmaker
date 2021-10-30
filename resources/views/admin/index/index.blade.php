
 

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row page-title align-items-center">
                            <div class="col-sm-4 col-xl-6">
                                <h4 class="mb-1 mt-0">Dashboard</h4>
                            </div>
                        </div>

                        <!-- content -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Totla Members</span>
                                                <h2 class="mb-0">{{ number_count(count($total_members)) }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-revenue-chart" class="apex-charts"></div>
                                                <span class="text-success font-weight-bold font-size-13"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Basic Members</span>
                                                <h2 class="mb-0">{{ number_count(count($basic)) }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-product-sold-chart" class="apex-charts"></div>
                                                <span class="text-danger font-weight-bold font-size-13"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Premium Members</span>
                                                    <h2 class="mb-0">{{ number_count(count($premium)) }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-new-customer-chart" class="apex-charts"></div>
                                                <span class="text-success font-weight-bold font-size-13"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Unapproved</span>
                                                <h2 class="mb-0">{{ number_count(count($unapproved)) }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-new-visitors-chart" class="apex-charts"></div>
                                                <span class="text-danger font-weight-bold font-size-13"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- stats + charts -->
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <h5 class="card-title header-title border-bottom p-3 mb-0">Overview</h5>
                                        <!-- stat 1 -->
                                        <div class="media px-3 py-4 border-bottom">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal">{{ number_count(count($suspended)) }}</h4>
                                                <span class="text-muted">Suspended</span>
                                            </div>
                                            <i data-feather="users" class="align-self-center icon-dual icon-lg"></i>
                                        </div>

                                        <!-- stat 2 -->
                                        <div class="media px-3 py-4 border-bottom">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal">{{ number_count(count($deactivated)) }}</h4>
                                                <span class="text-muted">Deactivated</span>
                                            </div>
                                            <i data-feather="users" class="align-self-center icon-dual icon-lg"></i>
                                        </div>

                                        <!-- stat 3 -->
                                        <div class="media px-3 py-4">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal">{{ number_count(count($report_count)) }}</h4>
                                                <span class="text-muted">Members Reports</span>
                                            </div>
                                            <i data-feather="shopping-bag" class="align-self-center icon-dual icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ url('/admin/user-subscription') }}" class="btn btn-primary btn-sm float-right">
                                            <i class='fa fa-eye'></i> View more
                                        </a>
                                        <h5 class="card-title mt-0 mb-0 header-title">Recent Subscriptions</h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Duration</th>
                                                        <th scope="col">Start date</th>
                                                        <th scope="col">End date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($user_subscriptions))
                                                   @foreach($user_subscriptions as $user_sub)
                                                    <tr>
                                                        <td>{{ ucfirst($user_sub->user_name) }}</td>
                                                        <td>{{ ucfirst($user_sub->subscription_type) }}</td>
                                                        <td>@money($user_sub->amount)</td>
                                                        <td>{{ $user_sub->duration }}</td>
                                                        <td><span class="badge badge-soft-success py-1">{{ date('d M Y', strtotime($user_sub->start_date)) }}</span>
                                                        <td><span class="badge badge-soft-danger py-1">{{ date('d M Y', strtotime($user_sub->end_date)) }}</span>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                        @if(!count($user_subscriptions))
                                        <div class="text-center mt-2">There are no subscriptions yet!</div>
                                        @endif
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-4"><!-- REPORTS START-->
                                <div class="card">
                                    <div class="card-body pt-2 pb-3">
                                        <a href="{{ url('/admin/reports') }}" class="btn btn-primary btn-sm mt-2 float-right">
                                            View All
                                        </a>
                                        <h5 class="mb-4 header-title">Recent Reports</h5>
                                        <div class="sliscroll">
                                            @if(count($reports))
                                                @foreach($reports as $report)
                                                <a href="{{ url('/admin/report-detail/'.$report->report_id) }}" style="color: #555;">
                                                    <div class="col">
                                                        <div class="innerdiv">
                                                        <b> {{ ucfirst($report->user_name) }}</b> has reported <b>{{ get_reported_member($report->reported_id) }}</b>
                                                            <p>{{ substr($report->report, 0, 30) }} <span class="badge badge-soft-danger py-1 float-right">{{ date('d M Y', strtotime($report->date_reported)) }}</span></p>
                                                        </div>
                                                    </div>
                                                </a>
                                                @endforeach
                                            @else
                                            <div class="text-center">There are no reports!</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div><!-- REPORTS END-->

                            <div class="col-xl-8"> <!-- CONTACTS START-->
                                <div class="card">
                                    <div class="card-body pt-2 pb-3">
                                        <a href="{{ url('/admin/contact') }}" class="btn btn-primary btn-sm mt-2 float-right">
                                            View All
                                        </a>
                                        <h5 class="mb-4 header-title">Contacts</h5>
                                        <div class="sliscroll">
                                            <div class="col">
                                                <div class="innerdiv">
                                                @if(count($contacts))
                                                    @foreach($contacts as $contact)
                                                    <ul class="ul-cantact-body">
                                                        <li>{{ ucfirst($contact->full_name) }} <span class="badge badge-soft-warning py-1 float-right">{{ date('d M Y', strtotime($contact->date)) }}</span></li>
                                                        <li><b>Email:</b> {{ $contact->email }}</li>
                                                        <li><b>Message</b> {{ substr($contact->comment, 0, 105) }}</li>
                                                    </ul>
                                                    @endforeach
                                                @else
                                                <div class="text-center">There are no contacts!</div>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- CONTACTS END-->
                        </div>
                        <!-- row -->
                        
                        <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mt-0 mb-0 header-title">New Members</h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Avatar</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Suspend</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($members))
                                                    @foreach($members as $member)
                                                    @php($avatar = $member->gender == 'male' ? 'M' : 'F')
                                                    <tr>
                                                        <td class="avatar-parent">
                                                            <a href="{{ url('/admin/member-detail/'.$member->id) }}" class="avatar-link">
                                                                <div class="avatar {{ $member->is_active ? 'active' : ''}}">
                                                                    @if($image = profile_img($member->id, $member->gender, $member->avatar))
                                                                    <img src="{{ asset($image) }}" alt="">
                                                                    @else
                                                                    <h4>{{ $avatar }}</h4>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('/admin/member-detail/'.$member->id) }}" class="member-name">{{ ucfirst($member->user_name) }} </a>
                                                        </td>
                                                        <td>{{ $member->email }}</td>
                                                        <td>
                                                            <div class="suspend {{ $member->is_suspend ? 'active' : ''}}">
                                                                <a href="#" data-name="{{ $member->user_name }}" id="{{ $member->id }}" class="suspend-confirm-box-open"></a>
                                                            </div>
                                                        </td>
                                                        <td>{{ date('d M Y', strtotime($member->date_registered)) }}</td>
                                                        <td>
                                                            <div class="drop-down">
                                                                <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                                <ul class="drop-down-body">
                                                                    <li>
                                                                        <a href="{{ url('/admin/member-detail/'.$member->id) }}">Detail</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('/admin/subscription-history/'.$member->id) }}" class="">subscription details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" id="{{ $member->id }}" class="add-user-subscription-btn">Add subscription</a>
                                                                    </li>
                                                                    @if(!$member->is_approved)
                                                                    <li>
                                                                        <a href="#" data-name="{{ $member->user_name }}" id="{{ $member->id }}" class="approve-confirm-box-open">Approve</a>
                                                                    </li>
                                                                    @endif
                                                                    <li class="li-deactivate">
                                                                        <a href="#" data-name="{{ $member->user_name }}" id="{{ $member->id }}" class="deactivate-confirm-box-open {{ $member->is_deactivated ? 'active' : '' }}">{{ !$member->is_deactivated ? 'Deactivate' : 'Activate' }}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        <!-- products -->
                        </div>
                        <!-- end row -->
                    </div>
                </div> <!-- content -->

