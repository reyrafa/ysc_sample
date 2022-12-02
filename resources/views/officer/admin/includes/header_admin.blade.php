<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <div class="container-fluid">
    <img src="/img/Logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
    <button id="nav_bar" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 20px;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/admin/user">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/user/management">User Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/user/transaction/history">Transaction History</a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link" href="/admin/user/report">YSC Members Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/user/ysc/members">Alumni</a>
        </li>
        <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                class="nav-link"
                onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Log Out') }}
            </a>
        </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
    $(document).ready(function(){
     
        var active = window.location.pathname;
        $('a[href="'+active+'"]').addClass('active');
    })
</script>
