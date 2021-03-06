
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
                                <li class="breadcrumb-item active" aria-current="page">Unapproved</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Unapproved members</h4>
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
                                    <div class="completed"><a href="{{ url('/admin/unapproved/completed') }}" class="badge badge-soft-success">Completed</a></div>
                                    <div class="table-search">
                                        <form action="{{ url('/admin/deactivated') }}" method="GET">
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
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($unapproved))
                                            @foreach($unapproved as $unapprove)
                                            @php($avatar = gender($unapprove->gender))
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="{{ $unapprove->id }}" class="check-box-members-input-btn" {{ checked_member($unapprove->id) ? 'checked' : '' }}>
                                                </td>
                                                <td class="avatar-parent">
                                                    <a href="{{ url('/admin/member-detail/'.$unapprove->id) }}" class="avatar-link">
                                                        <div class="avatar {{ $unapprove->is_active ? 'active' : ''}}">
                                                            @if($image = profile_img($unapprove->id, $unapprove->gender, $unapprove->avatar))
                                                            <img src="{{ asset($image) }}" alt="">
                                                            @else
                                                            <h4>{{ $avatar }}</h4>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/member-detail/'.$unapprove->id) }}" class="member-name">{{ ucfirst($unapprove->user_name) }} </a>
                                                </td>
                                                <td>{{ $unapprove->email }}</td>
                                                <td>
                                                    @if($unapprove->is_complete)
                                                    <span class="badge badge-soft-success py-1">Completed</span>
                                                    @else
                                                    <span class="badge badge-soft-warning py-1">Pending</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d M Y', strtotime($unapprove->date_registered)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="{{ url('/admin/member-detail/'.$unapprove->id) }}">Detail</a>
                                                            </li>
                                                            @if(!$unapprove->is_approved)
                                                            <li>
                                                                <a href="#" data-name="{{ $unapprove->user_name }}" id="{{ $unapprove->id }}" class="approve-confirm-box-open">Approve</a>
                                                            </li>
                                                            @endif
                                                            <li class="li-deactivate">
                                                                <a href="#" data-name="{{ $unapprove->user_name }}" id="{{ $unapprove->id }}" class="deactivate-confirm-box-open {{ $unapprove->is_deactivated ? 'active' : '' }}">{{ !$unapprove->is_deactivated ? 'Deactivate' : 'Activate' }}</a>
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
                                <div id="bottom_table_part">
                                    @if(!count($unapproved))
                                    <div class="text-center">There are no members yet!</div>
                                    @endif
                                    @if(count($unapproved))
                                    <div class="paginate">{{ $unapproved->links("pagination::bootstrap-4") }}</div>
                                    @endif
                                </div>
                                @if(count($unapproved))
                                <div class="text">
                                    <a href="#" id="open_members_newsletter_modal_btn">| Send newsletter |</a>
                                    <a href="#" id="open_approved_all_modal_btn"> Approve |</a>
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















































