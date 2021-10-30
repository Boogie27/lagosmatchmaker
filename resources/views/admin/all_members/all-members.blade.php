




<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void()">Members</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">All members</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="header-title mt-0 mb-1">Buttons example</h4> -->
                               <div class="table-top">
                                    <div class="page-icon"><i class="fa fa-users"></i></div>
                                    <a href="#" id="open_mass_unapprove_modal_btn">| Unapprove |</a>
                                    <!-- <a href="#" data-url="{{ url('/admin/ajax-update-christain') }}" id="open_mass_christain_modal_btn">| Christain |</a> -->
                                    <div class="table-search">
                                        <form action="{{ url('/admin/all-members') }}" method="GET">
                                            <div class="form-group">
                                                <input type="text" name="search" class="form-control" placeholder="Search...">
                                            </div>
                                        </form>
                                    </div>
                               </div>
                               <div class="table-responsive" id="members_parent_table_container"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="mass_member_check_box_input"></th>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Suspend</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($all_members))
                                            @foreach($all_members as $member)
                                            @php($avatar = gender($member->gender))
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="{{ $member->id }}" class="check-box-members-input-btn" {{ checked_member($member->id) ? 'checked' : '' }}>
                                                </td>
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
                                                <td><span class="badge badge-soft-{{ $member->membership_level == 'basic' ? 'success' : 'warning' }} py-1">{{ $member->membership_level == 'basic' ? 'Basic' : 'Premium' }}</span></td>
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
                                </div><!-- table end-->
                                @if(!count($all_members))
                                <div class="text-center">There are no members yet!</div>
                                @endif
                                @if(count($all_members))
                                <div class="paginate">{{ $all_members->links("pagination::bootstrap-4") }}</div>
                                @endif
                                @if(count($all_members))
                                <div class="text">
                                    <a href="#" id="open_members_newsletter_modal_btn">| Send newsletter |</a>
                                    <a href="#" id="open_mass_subscription_modal_btn">| Assign subscription |</a>
                                </div>
                                @endif
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->

























