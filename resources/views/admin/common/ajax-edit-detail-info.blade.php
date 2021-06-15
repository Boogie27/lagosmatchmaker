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
    <div class="title">Marital Status </div>
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
    <div class="title">Religion  </div>
    <div class="body">: {{ $user->religion ?? 'Empty' }}</div>
</li>
<li>
    <div class="title">Date of Birth  </div>
    <div class="body">: {{ $user->date_of_birth ? date('d M Y', strtotime($user->date_of_birth)) : 'Empty'}}</div>
</li>
<li>
    <div class="title">Location  </div>
    <div class="body">: {{ $user->location ? ucfirst($user->location) : 'Empty' }}</div>
</li>
<li>
    <div class="title">Membership level  </div>
    <div class="body">: {{ $user->membership_level }}</div>
</li>