@include('partial.header')
<section class="vh-100 bg-image"
         style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Login Admin Account</h2>

                            <form>

                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example3cg" name="username" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example3cg">Your Username</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cg" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="button"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Do not have an account? <a href="/admin/register" class="fw-bold text-body"><u>Register here</u></a></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partial.footer')
