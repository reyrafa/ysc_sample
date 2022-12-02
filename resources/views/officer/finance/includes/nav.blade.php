<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <div class="container-fluid">
    <img src="/img/Logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
    <button id="nav_bar" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 20px;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/finance/user">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/finance/user/transaction">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/finance/user/receipts">Reciepts</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto something">
           @foreach($officer as $officer_info)
           
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-target="#dropdown">
                    {{$officer_info->firstname}} {{$officer_info->middlename}} {{$officer_info->lastname}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdown">
                    <a href="/finance/user/profile" class="dropdown-item">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            class="dropdown-item"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>
            @endforeach
      </ul>
    </div>
  </div>
</nav>

<script>
    $(document).ready(function(){
     
        var active = window.location.pathname;
        $('a[href="'+active+'"]').addClass('active');

        $('#navbarDropdown').on('click', function(){
            $('.dropdown-menu').slideToggle('fast')
        })
    })
    $(document).on('click', function(event){
      var $trigger = $('.something');
      if($trigger !== event.target && !$trigger.has(event.target).length){
        $('.dropdown-menu').slideUp('fast')
      }
    })
</script>
