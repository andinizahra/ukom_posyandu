<html>
    <head>
        
        @vite(['resources/sass/app.scss','resources/js/app.js'])
        <style>
        <style>
            body {
                background-color: #f8f9fa;
            }
    
            .card {
                border: 1px solid #ccc;
                border-radius: 10px;
            }
    
            .card-body {
                padding: 2rem;
            }
    
            .form-label {
                font-weight: bold;
            }
    
            .btn-primary {
                background-color: #6FB3B8;
                color: #fff;
            }
    
            .btn-primary:hover {
                background-color: #ADD0D8;
            }
        </style>
    </head>
    <body>
        <section class="vh-10">
            <div class="container py-5 h-100">
                <div>
                    <img src="logo_posyandu.png" style="width: 300px; height:160px; margin-bottom: -110px; margin-left: 400px">
                </div>
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card shadow" style="background-color: #3F75C3; border-radius: 30px;">
                            <div class="card-body p-4" style="margin-top: -40px;">
                                <div class="text-center" style="color: white;">
                                    <img src="people.svg">
                                </div>
                                <form action="" style="color: white">
      
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" class="form-control" name="username"
                                               required autocomplete="username"/>
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" class="form-control" name="password"
                                               required/>
                                    </div>
    
                                    <div class="text-danger errors">
                                        <p class="err-message"></p>
                                    </div>
    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="module">
            $('form').submit(async function (e) {
                e.preventDefault();
                let username = $('#username').val();
                let password = $('#password').val();
                var _tok = "{{csrf_token()}}";
    
                await axios({
                    method: 'post',
                    url: "{{url('/login')}}",
                    data: {
                        username : username,
                        password : password,
                        _token : _tok
                    }
                }).then(async () => {
                    await swal.fire({
                        title: 'Login berhasil!',
                        text: 'Redirecting to dashboard...',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    })
                    window.location = '/dashboard'
                    console.log('success')
                }).catch(({response}) => {
                    if (!$('.err-message').text()) {
                        $('.err-message').append(document.createTextNode(response.data.errors.message))
                    }
                })
    
            })
        </script>
        
    </body>
</html>
  