@if($images)
    @foreach($images as $key => $image)
    <li class="bank-icons">
        <img src="{{ asset($image) }}" alt="">
        <a href="#" id="{{ $key }}" class="delete-bank-icon-btn"><i class="fa fa-times text-danger"></i></a>
    </li>
    @endforeach
@endif
<li class="bank-icons text-icons">
    <a href="#" id="upload_bank_icon_input" class="add-bank-icon"><i class="fa fa-camera"></i></a>
    <input type="file" id="upload_bank_icon_btn" style="display: none;">
</li>