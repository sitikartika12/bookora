<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookora</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: "SF Pro", "Segoe UI", sans-serif;
            display: flex;
            min-height: 100vh;
            background: #f5f7fb;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            background: #ffffff;
            padding: 20px 10px;
            border-radius: 0 20px 20px 0;
            box-shadow: 5px 0 25px rgba(0,0,0,0.05);
        }

        /* MENU ITEM */
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border-radius: 12px;
            color: #555;
            text-decoration: none;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #f1f3f9;
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #6a5af9, #8b7bff);
            color: white;
        }

        /* CONTENT */
        .content {
            flex-grow: 1;
            padding: 25px;
        }

        /* CARD GLOBAL (biar semua halaman ikut bagus) */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        /* SCROLLBAR HALUS */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h5 class="fw-bold text-center mb-4">📚 Bookora</h5>
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>