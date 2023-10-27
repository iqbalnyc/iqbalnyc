
<!-- Header-->
<header class="bg-info py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>

        <div class="text-center mt-3">
            @if(session('success'))
            <h5 class="text-center text-danger">
                {{ session('success') }}
            </h5>
            @endif
        </div>
        <div class="text-center mt-3">
            @if(session('successLogout'))
            <h5 class="text-center text-danger">
                {{ session('successLogout') }}
            </h5>
            @endif
        </div>
        
    </div>
</header>