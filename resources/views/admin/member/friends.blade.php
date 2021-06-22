




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
                                <li class="breadcrumb-item active" aria-current="page">Basic</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Basic members</h4>
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
                                        <form action="" method="GET">
                                            <div class="form-group">
                                                <input type="text" name="search_members" class="form-control" placeholder="Search...">
                                            </div>
                                        </form>
                                    </div>
                               </div>
                               <div class="table-responsive"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Suspend</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($friends))
                                            @foreach($friends as $friend)
                                            @php($user = get_friends($id, $friend))
                                            @php($avatar = $user->gender == 'male' ? 'M' : 'F')
                                            <tr>
                                                <td class="avatar-parent">
                                                    <a href="{{ url('/admin/member-detail/'.$user->id) }}" class="avatar-link">
                                                        <div class="avatar {{ $user->is_active ? 'active' : ''}}">
                                                            <h4>{{ $avatar }}</h4>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/member-detail/'.$user->id) }}" class="member-name">{{ ucfirst($user->user_name) }} </a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <div class="suspend {{ $user->is_suspend ? 'active' : ''}}">
                                                        <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->id }}" class="suspend-confirm-box-open"></a>
                                                    </div>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($user->date_registered)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="{{ url('/admin/member-detail/'.$user->id) }}">Detail</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/admin/subscription-history/'.$user->id) }}" class="">subscription details</a>
                                                            </li>
                                                            @if(!$user->is_approved)
                                                            <li>
                                                                <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->id }}" class="approve-confirm-box-open">Approve</a>
                                                            </li>
                                                            @endif
                                                            <li class="li-deactivate">
                                                                <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->id }}" class="deactivate-confirm-box-open {{ $user->is_deactivated ? 'active' : '' }}">{{ !$user->is_deactivated ? 'Deactivate' : 'Activate' }}</a>
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
                                @if(!count($friends))
                                <div class="text-center">There are no friends yet!</div>
                                @endif
                                @if(count($friends))
                                <div class="paginate">{{ $friends->links("pagination::bootstrap-4") }}</div>
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

























