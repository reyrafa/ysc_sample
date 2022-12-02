<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="background-image: linear-gradient(to bottom right, #fe783b, yellow);">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" > 
        {{ $slot }}
    </div>
    <center>
        <label class="pt-5">Powered by <span style="font-size: 15px; color: blue;">RC Group</span> @2022</label> 
    </center>
</div>
