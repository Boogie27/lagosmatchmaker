<div class="table-responsive"> <!-- table start-->
    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
        <thead>
            <tr>
                <th class="check-all-emails">
                @if(count($newsletters))
                        <input type="checkbox" class="check-box-all" {{ Session::has('all') ? 'checked' : '' }}>
                @endif
                </th>
                <th>Email</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="parent_table">
            @if(count($newsletters))
            @foreach($newsletters as $newsletter)
            <tr>
                <td><input type="checkbox" id="{{ $newsletter->id }}" data-email="{{ $newsletter->email }}" class="news-letter-check-box" {{ news_subs($newsletter->id) ? 'checked' : '' }}></td>
                <td>{{ $newsletter->email }}</td>
                
                <td>{{ date('d M Y', strtotime($newsletter->date)) }}</td>
                <td>
                    <a href="#" id="{{ $newsletter->id }}" class="delete-news-letter"><i class="fa fa-trash text-danger"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div><!-- table end-->
<div id="bottom_table_part">
    @if(!count($newsletters))
    <div class="text-center">There are no subscribers yet!</div>
    @endif
    @if(count($newsletters))
    <div class="paginate">{{ $newsletters->links("pagination::bootstrap-4") }}</div>
    @endif
</div>