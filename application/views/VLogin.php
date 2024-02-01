<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        * {
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font: 16px 'Poppins', sans-serif;
            background: linear-gradient(45deg, #81b5d6 50%, #aed6f1 50%);
            margin: 0; /* Remove default margin */
        }

        nav {
            background-color: #2c3e50; /* Dark blue color */
            padding: 15px 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            color: #ecf0f1; /* Light text color */
            font-size: 20px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: #ecf0f1; /* Light text color */
            text-decoration: none;
            font-size: 16px;
        }

        .signin-btn {
            background-color: #3498db; /* Blue color for the Sign In button */
            padding: 10px 15px;
            border-radius: 5px;
            color: #ecf0f1; /* Light text color */
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .signin-btn:hover {
            background-color: #2980b9; /* Darker blue color on hover */
        }

        section {
            width: 550px;
            background: #ecf0f1;
            padding: 0 70px 70px 70px;
            margin: 250px auto;
            text-align: center;
            border-radius: 5px;
        }

        span {
            display: block;
            position: relative;
            margin: 0 auto;
            top: -40px;
            height: 80px;
            width: 80px;
            border-radius: 50%;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, .3);
        }

        h1 {
            font-size: 24px;
            font-weight: 100;
            margin-bottom: 30px;
        }

        input {
            width: 100%;
            background: #bdc3c7;
            border: none;
            height: 30px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
        }

        input:focus {
            outline: none;
        }

        button {
            width: 100%;
            height: 30px;
            border: none;
            background: #3498db;
            color: #ecf0f1;
            font-weight: 100;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: all ease-in-out .2s;
            border-bottom: 3px solid #2980b9;
        }

        button:focus {
            outline: none;
        }

        button:hover {
            background: #2980b9;
        }

        h2 {
            font-size: .75em;
        }

        a {
            color: #e74c3c;
            text-decoration: none;
            transition: all ease-in-out .2s;
        }

        a:hover {
            color: #c0392b;
        }
    </style>
</head>

<body>

    <nav>
        <div class="navbar">
            <div class="logo">Your Logo</div>
            <div class="nav-links">
                <a href="<?= site_url('Action/registrasi'); ?>" class="signin-btn">Daftar</a>
            </div>
        </div>
    </nav>

    <section>
        <br>
        <h1>Member Login</h1>

        <?php echo form_open('login'); ?>

        <form action="<?= site_url('Welcome/index');?>" method="post">
            <input type="text" name="username" id="username" placeholder="Masukkan Username" required>
            <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <h2>
            <label for="check">Belum Punya Akun?</label>
            <a href="<?= site_url('Action/registrasi'); ?>">Daftar</a>
        </h2>
    </section>

</body>

</html>
