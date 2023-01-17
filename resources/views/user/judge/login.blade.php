@include('partial.header')
<section class="vh-100 bg-image"
         style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            @if(session()->has('message'))
                                <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 5000)" class="alert alert-danger text-center pt-2" role="alert" style="height: 50px;">
                                    {{session('message')}}
                                </div>
                            @endif

                            <h2 class="text-uppercase text-center mb-5">Login Judge Account</h2>
                            @livewire('login-judge')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partial.footer')
