<li>
    <div class="title">Name  </div>
    <div class="body">: {{ ucfirst($display_name) }}</div>
</li>
<li>
    <div class="title">I am  </div>
    <div class="body">: {{ $gender ? ucfirst($gender) : 'Empty' }}</div>
</li>
<li>
    <div class="title">Looking for  </div>
    <div class="body">: {{ $user->looking_for ? ucfirst($user->looking_for) : 'Empty' }}</div>
</li>
<li>
    <div class="title">Marital Status  </div>
    <div class="body">: {{ $user->marital_status ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Age  </div>
    <div class="body">: {{ $user->age ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Genotype  </div>
    <div class="body">: {{ $user->genotype ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">HIV Status  </div>
    @if($user->HIV == 'YES')
    <div class="body">: Positive</div>
    @endif
    @if($user->HIV == 'NO')
    <div class="body">: Negative</div>
    @endif
    @if(!$user->HIV)
    <div class="body">: Empty</div>
    @endif
</li>
<li>
    <div class="title">Complexion  </div>
    <div class="body">: {{ $user->complexion ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Education  </div>
    <div class="body">: {{ $user->education ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Career  </div>
    <div class="body">: {{ $user->career ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Religion  </div>
    <div class="body">: {{ $user->religion ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Location  </div>
    <div class="body">: {{ $user->location ? ucfirst($user->location) : 'Empty' }}</div>
</li>
<li>
    <div class="title">Membership level  </div>
    <div class="body">: {{ $user->membership_level ?? 'Empty' }}</div>
</li>