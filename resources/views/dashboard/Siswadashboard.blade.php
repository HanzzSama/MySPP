<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/lib/css/dashboard.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script>
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
        }
    </script>
    <title>MySPP -Pembayaran SPP</title>
</head>

<body>
    @session('success')
    <section id="alert" class="alert" role="alert">
        <div>
            <h3>success</h3>
            <h4>{{ $value }}</h4>
        </div>
    </section>
    @endsession
    <div class="wrapper-page">
        @include('component.sidebar')
        <main class="container-main">
            <div>
                <nav class="header-nav">
                    <figure class="nav-search">
                        <div>
                            <i class='bx bx-search'></i>
                            <input type="text" placeholder="Sesrch data...">
                        </div>
                        <button class="btn-src">
                            <h4>search</h4>
                        </button>
                    </figure>
                </nav>
                <nav class="nav-title">
                    <article>
                        <h1>hi, {{ Auth::user()->nama }}</h1>
                        <h4>Selamat datang di halaman pembayaran SPP</h4>
                    </article>
                </nav>
                <header class="conteiner-header">
                    <div>
                        @include('component.profile')
                        @include('component.history')
                    </div>
                </header>
                @include('component.historyAll')
                <footer class="container-footer">
                    <div></div>
                </footer>
                <footer class="footer">
                    <div>
                        <p>Desaign by Rifky</p>
                    </div>
                </footer>
            </div>
        </main>
    </div>
    @include('component.allscript')
</body>

</html>