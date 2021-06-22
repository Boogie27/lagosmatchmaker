@if(count($notifications))
    @foreach($notifications as $notification)
    <a href="{{ url($notification->link ? $notification->link : '#') }}" class="dropdown-item border-bottom">
        <p class="notify-details">{{ ucfirst($notification->title) }}</p>
        <p class="text-muted mb-0 user-msg">
            <small>{{ $notification->description }}</small>
        </p>
    </a>
    @endforeach
@else
<div class="text-center pt-3">There are no unseen notifications</div>
@endif