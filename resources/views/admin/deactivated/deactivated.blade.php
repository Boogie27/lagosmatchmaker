




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
                                <li class="breadcrumb-item active" aria-current="page">Deactivated</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Deactivated members</h4>
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
                                                <th>Level</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($deactivates))
                                            @foreach($deactivates as $deactivated)
                                            @php($avatar = $deactivated->gender == 'male' ? 'M' : 'F')
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="{{ $deactivated->id }}" class="check-box-members-input-btn" {{ checked_member($deactivated->id) ? 'checked' : '' }}>
                                                </td>
                                                <td class="avatar-parent">
                                                    <a href="{{ url('/admin/member-detail/'.$deactivated->id) }}" class="avatar-link">
                                                        <div class="avatar {{ $deactivated->is_active ? 'active' : ''}}">
                                                            <h4>{{ $avatar }}</h4>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/member-detail/'.$deactivated->id) }}" class="member-name">{{ ucfirst($deactivated->user_name) }} </a>
                                                </td>
                                                <td>{{ $deactivated->email }}</td>
                                                <td><span class="badge badge-soft-{{ $deactivated->membership_level == 'basic' ? 'success' : 'warning' }} py-1">{{ $deactivated->membership_level == 'basic' ? 'Basic' : 'Premium' }}</span></td>
                                                <td>{{ date('d M Y', strtotime($deactivated->date_deactivated)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="{{ url('/admin/member-detail/'.$deactivated->id) }}">Detail</a>
                                                            </li>
                                                            <li class="li-deactivate">
                                                                <a href="#" data-name="{{ $deactivated->user_name }}" id="{{ $deactivated->id }}" class="deactivate-confirm-box-open {{ $deactivated->is_deactivated ? 'active' : '' }}">{{ !$deactivated->is_deactivated ? 'Deactivate' : 'Activate' }}</a>
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
                                    @if(!count($deactivates))
                                    <div class="text-center">There are no members yet!</div>
                                    @endif
                                    @if(count($deactivates))
                                    <div class="paginate">{{ $deactivates->links("pagination::bootstrap-4") }}</div>
                                    @endif
                                </div>
                                @if(count($deactivates))
                                <div class="text">
                                    <a href="#" id="open_members_newsletter_modal_btn">| Send newsletter |</a>
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

























