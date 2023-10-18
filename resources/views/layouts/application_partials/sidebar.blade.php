<li class="header">MENU UTAMA</li>
@if(auth()->user()->hasRole('participant') || auth()->user()->hasRole('presenter') || auth()->user()->hasRole('administrator'))
    <li class="{{ set_active('dashboard') }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-television"></i>
            <span>Dashboard</span>
        </a>
    </li>
@endif

@if(auth()->user()->hasRole('administrator'))
    <li class="{{ set_active('dashboardAdmin') }}">
        <a href="{{ route('dashboardAdmin') }}">
            <i class="fa fa-line-chart"></i>
            <span>Application Data</span>
        </a>
    </li>
@endif

@if(auth()->user()->hasRole('administrator'))
<li class="{{ set_active(['awaiting','awaiting.readMore']) }}">
    <a href="{{ route('awaiting') }}">
        <i class="fa fa-clock"></i>
        <span>Awaiting Verification</span>
    </a>
</li>

<li class="{{ set_active(['verified','verified.readMore']) }}">
    <a href="{{ route('verified') }}">
        <i class="fa fa-check-circle"></i>
        <span>Verified Submissions</span>
    </a>
</li>

<li class="{{ set_active(['pendingPayment']) }}">
    <a href="{{ route('pendingPayment') }}">
        <i class="fa fa-clock-o"></i>
        <span>Pending Payment Verification</span>
    </a>
</li>

<li class="{{ set_active(['verifiedPayment','verifiedPayment']) }}">
    <a href="{{ route('verifiedPayment') }}">
        <i class="fa fa-check-circle"></i>
        <span>Verified Payment Proof</span>
    </a>
</li>
@endif

@if(auth()->user()->hasRole('presenter'))
<li class="{{ set_active('abstrak') }}">
    <a href="{{ route('abstrak') }}">
        <i class="fa fa-paper-plane"></i>
        <span>Submission</span>
    </a>
</li>
@endif

@if(auth()->user()->hasRole('participant') || auth()->user()->hasRole('presenter'))
<li class="{{ set_active('payment') }}">
    <a href="{{ route('payment') }}">
        <i class="fa fa-upload"></i>
        <span>Upload Payment Proof</span>
    </a>
</li>
@endif

@if(auth()->user()->hasRole('presenter'))
<li class="{{ set_active('paper') }}">
    <a href="{{ route('paper') }}">
        <i class="fa fa-file-pdf-o"></i>
        <span>Paper and Presentation File</span>
    </a>
</li>
@endif

@if(auth()->user()->hasRole('administrator'))
<li class="{{ set_active('allPaper') }}">
    <a href="{{ route('allPaper') }}">
        <i class="fa fa-file-pdf-o"></i>
        <span>Paper and Presentation File</span>
    </a>
</li>
@endif

<!-- Authentication -->
<li>
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out text-danger"></i>
        <span>{{__('Logout') }}</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
