




<!-- PREMIUM MEMBERS START-->
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
                                <li class="breadcrumb-item active" aria-current="page">Premium</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Premium members</h4>
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
                                        <form action="{{ url('/admin/premium') }}" method="GET">
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
                                                <th>Suspend</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($premiums))
                                            @foreach($premiums as $premium)
                                            @php($avatar = $premium->gender == 'male' ? 'M' : 'F')
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="{{ $premium->id }}" class="check-box-members-input-btn" {{ checked_member($premium->id) ? 'checked' : '' }}>
                                                </td>
                                                <td class="avatar-parent">
                                                    <a href="{{ url('/admin/member-detail/'.$premium->id) }}" class="avatar-link">
                                                        <div class="avatar {{ $premium->is_active ? 'active' : ''}}">
                                                            <h4>{{ $avatar }}</h4>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/member-detail/'.$premium->id) }}" class="member-name">{{ ucfirst($premium->user_name) }} </a>
                                                </td>
                                                <td>{{ $premium->email }}</td>
                                                <td>
                                                    <div class="suspend {{ $premium->is_suspend ? 'active' : ''}}">
                                                        <a href="#" data-name="{{ $premium->user_name }}" id="{{ $premium->id }}" class="suspend-confirm-box-open"></a>
                                                    </div>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($premium->date_registered)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="{{ url('/admin/member-detail/'.$premium->id) }}">Detail</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/admin/subscription-history/'.$premium->id) }}" class="">subscription details</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" id="{{ $premium->id }}" class="add-user-subscription-btn">Add subscription</a>
                                                            </li>
                                                            @if(!$premium->is_approved)
                                                            <li>
                                                                <a href="#" data-name="{{ $premium->user_name }}" id="{{ $premium->id }}" class="approve-confirm-box-open">Approve</a>
                                                            </li>
                                                            @endif
                                                            <li class="li-deactivate">
                                                                <a href="#" data-name="{{ $premium->user_name }}" id="{{ $premium->id }}" class="deactivate-confirm-box-open {{ $premium->is_deactivated ? 'active' : '' }}">{{ !$premium->is_deactivated ? 'Deactivate' : 'Activate' }}</a>
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
                                @if(!count($premiums))
                                <div class="text-center">There are no members yet!</div>
                                @endif
                                @if(count($premiums))
                                <div class="paginate">{{ $premiums->links("pagination::bootstrap-4") }}</div>
                                @endif
                                @if(count($premiums))
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
<!-- PREMIUM MEMBERS END-->

























