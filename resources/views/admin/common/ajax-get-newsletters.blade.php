<div class="table-responsive"> <!-- table start-->
    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
        <thead>
            <tr>
                <th class="check-all-emails">
                @if(count($newsletters))
                        <input type="checkbox" class="check-box-all" {{ Session::has('all') ? 'checked' : '' }}>
                @endif
                </th>
                <th>Title</th>
                <th>Newsletter</th>
                <th></th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="parent_table">
            @if(count($newsletters))
            @foreach($newsletters as $newsletter)
            <tr>
                <td><input type="checkbox" id="{{ $newsletter->id }}" class="news-letter-check-box"></td>
                <td>{{ $newsletter->title }}</td>
                <td>
                    {!! substr( $newsletter->newsletter, 0, 30) !!}
                </td>
                <td><a href="#" id="{{ $newsletter->id }}" class="send-newsletter-modal-open mini-btn">Send</a></td>
                <td>{{ date('d M Y', strtotime($newsletter->date)) }}</td>
                <td>
                    <div class="drop-down">
                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                        <ul class="drop-down-body">
                            <li>
                                <a href="{{ url('/admin/edit-newsletter/'.$newsletter->id) }}">Edit</a>
                            </li>
                            @if($is_save)
                            <li>
                                <a href="#" id="{{ $newsletter->id }}" class="save-news-letter-btn">Save</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ url('/admin/newsletter-preview/'.$newsletter->id) }}">Preview</a>
                            </li>
                            <li>
                                <a href="#" id="{{ $newsletter->id }}" class="delete-news-letter-modal-open">Delete</a>
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
    @if(!count($newsletters))
    <div class="text-center">There are no newsletters yet!</div>
    @endif
    @if(count($newsletters))
    <div class="paginate">{{ $newsletters->links("pagination::bootstrap-4") }}</div>
    @endif
</div>