<!DOCTYPE html>
<html lang="en">
<head>
    @include('officer.finance.includes.head')
    @stack('style')
</head>

<style>
    body{
        font-family: 'Poppins', sans-serif;
    }
    
</style>
<body>
    @include('officer.finance.includes.nav')
    <div class="container pt-5">
        @yield('content')
    </div>
    <div class="mt-5">
    @include('officer.admin.includes.footer')
    </div>  
 

    <!--bootstrap bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     
     <!--Popper and Bootstrap JS --> 
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <script src="https://use.fontawesome.com/4455f8e97b.js"></script>

     <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
     
     @stack('script')
</body>
</html>