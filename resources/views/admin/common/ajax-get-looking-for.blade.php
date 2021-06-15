<li>
    @if($user->looking_for_detail)
    <p class="detail-about-p"> {{ $user->looking_for_detail }}</p>
    @else
    <p class="detail-about-p">Describe the type of a person you are looking for</p>
    @endif
</li>