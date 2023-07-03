
<div>
    @if(session()->has('loginError'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 5000)" class="alert alert-danger text-center pt-2" role="alert" style="height: 50px;">
            {{session('loginError')}}
        </div>
    @endif
    <form wire:submit.prevent="submit">
        <div class="form-outline mb-4">
            <input type="text" id="form3Example3cg" wire:model="username" placeholder="Your Username" class="form-control form-control-lg" />
            @error('username')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="form3Example4cg" wire:model="password" placeholder="Password" class="form-control form-control-lg" />
            @error('password')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>


        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
        </div>


        <p class="text-center text-muted mt-5 mb-0">Do not have an account? <a href="/admin/event" class="fw-bold text-body"><u>Register here</u></a></p>

    </form>

</div>
