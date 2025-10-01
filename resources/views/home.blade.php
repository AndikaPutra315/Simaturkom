<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di SIMATURKOM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Reset dan Layout Utama */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }

        /* Hero Section */
        .hero-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* Mengurangi tinggi agar tidak memenuhi seluruh layar */
            min-height: 60vh;
            padding: 4rem 2rem;
            background-color: #ffffff; /* Beri background putih agar kontras */
        }
        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            color: #1a237e;
            margin: 0 0 0.5rem 0;
        }
        .hero-subtitle {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 400;
            color: #555;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 0;
        }
        .hero-divider {
            width: 100px;
            height: 3px;
            background-color: #1a237e;
            border: none;
            margin: 2rem 0;
        }

        /* BAGIAN KONTEN DUMMY BARU */
        .content-section {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            line-height: 1.6;
        }
        .content-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #1a237e;
            text-align: center;
            margin-bottom: 30px;
        }
        .content-section p {
            font-size: 1rem;
            color: #444;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

    @include('includes.header')

    <main>
        <div class="hero-container">
            <h1 class="hero-title">SIMATURKOM</h1>
            <p class="hero-subtitle">SISTEM INFORMASI MANAJEMEN INFRASTRUKTUR KOMUNIKASI</p>
            <hr class="hero-divider">
        </div>

        <div class="content-section">
            <h2>Tentang Sistem Kami</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.
            </p>
            <p>
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.
            </p>
            <p>
                Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam.
            </p>
        </div>
        </main>

    @include('includes.footer')

</body>
</html>
