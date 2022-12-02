<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="text-align: center;">
               
                    <div class="" style="width:auto; height:500px; display:block">
                        <div class="owl-carousel owl-theme" >
                            <div class="item" style="height:60vh; display:block">
                                <img src="/img/image1.jpg" alt="">
                               
                            </div>
                            <div class="item" style="height:60vh; display:block"><img src="/img/image2.jpg" alt=""></div>
                        </div>
                    </div>
                  
           
                    <h1 style="font-size: 25px; color:#fe783b"><b>Welcome to Oro Youth Savers Club</b></h1>
               
                <p>A Successful man is one who can lay a firm foundation with the bricks others have thrown at him.</p>
                <span>- David Brinkley -</span>
            </div>
        </div>
    </div>
    

    <script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:5,
            nav:false,
            autoplay:true,
            autoplayTimeout: 1000,
            autoHeight: true,
           // stagePadding:50,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
                
            }
        })
    })
  </script>
</x-app-layout>
