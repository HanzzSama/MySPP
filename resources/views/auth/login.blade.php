<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/lib/css/app.css" />
    <link rel="stylesheet" href="/lib/css/login.css" />
    <title>Login</title>
</head>

<body>
    <main class="container-form">
        <div>
            <article class="title-form">
                <h2>login</h2>
            </article>
            <main class="form">
                @auth
                <article class="info">
                    <h5>kamu telah login baru-baru ini</h5>
                </article>
                <form method="post" action="{{ route('logout') }}" class="btn-log btn">
                    @csrf
                    <button type="submit">
                        <i class='bx bx-log-out-circle'></i>
                        <h4>log out</h4>
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <figure class=" input">
                        <input type="text" name="nama" placeholder="username" value="Zhang Wei" />
                    </figure>
                    <figure class="input">
                        <input type="password" name="password" placeholder="password" value="123456" />
                    </figure>
                    <figure class="btn">
                        <button type="submit">login</button>
                    </figure>
                </form>
                @endauth
            </main>
        </div>
    </main>
</body>

</html>