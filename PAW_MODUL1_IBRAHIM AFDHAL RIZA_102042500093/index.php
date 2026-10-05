<?php
// =====================================================
// LANGKAH 1: DATA PRODUK (ARRAY PHP)
// Semua data produk disimpan di sini, bukan di HTML.
// Array utama berisi banyak array kecil (satu per produk).
// =====================================================
$produk = [
    ["nama" => "Laptop Asus Vivobook 14", "kategori" => "Laptop",     "harga" => 7500000, "stok" => 5],
    ["nama" => "Smartphone Redmi Note 13", "kategori" => "Handphone", "harga" => 2800000, "stok" => 12],
    ["nama" => "Headset Gaming Rexus",     "kategori" => "Aksesoris", "harga" => 450000,  "stok" => 8],
    ["nama" => "Mouse Wireless Logitech",  "kategori" => "Aksesoris", "harga" => 185000,  "stok" => 0],
    ["nama" => "Keyboard Mechanical",      "kategori" => "Aksesoris", "harga" => 650000,  "stok" => 3],
    ["nama" => "Monitor LG 24 Inch",       "kategori" => "Monitor",   "harga" => 1800000, "stok" => 0],
    ["nama" => "Smartwatch Xiaomi Band",   "kategori" => "Wearable",  "harga" => 600000,  "stok" => 15],
];

// =====================================================
// LANGKAH 2: FUNGSI FORMAT RUPIAH
// Mengubah angka 7500000 menjadi "Rp7.500.000".
// =====================================================
function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

// =====================================================
// LANGKAH 3: HITUNG JUMLAH PRODUK
// count() menghitung jumlah isi array secara otomatis.
// =====================================================
$totalProduk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Agar tampilan menyesuaikan layar HP (responsive) -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cia Store - Katalog Produk</title>

    <style>
        /* LANGKAH 4: CSS
           Warna dibuat di satu tempat (variabel) agar konsisten. */
        :root {
            --biru: #1d4ed8;
            --biru-muda: #eff6ff;
            --hijau: #15803d;
            --merah: #b91c1c;
            --teks: #1f2937;
            --abu: #6b7280;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            color: var(--teks);
            background: #f9fafb;
            line-height: 1.5;
        }

        /* Navbar: Flexbox untuk menaruh logo kiri dan menu kanan */
        header {
            background: var(--biru);
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h2 { font-size: 22px; }
        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 16px;
        }

        /* Hero: bagian pembuka */
        .hero {
            background: var(--biru-muda);
            text-align: center;
            padding: 56px 24px;
        }
        .hero h1 { font-size: 34px; color: var(--biru); margin-bottom: 8px; }
        .hero p { color: var(--abu); }

        /* Bagian informasi jumlah produk */
        .info {
            text-align: center;
            padding: 24px;
            font-size: 18px;
            font-weight: bold;
        }

        /* Katalog: CSS GRID menyusun card otomatis.
           auto-fit + minmax membuat jumlah kolom menyesuaikan lebar layar. */
        .katalog {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        /* Card produk */
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .kategori { font-size: 13px; color: var(--abu); }
        .card h3 { font-size: 18px; }

        /* Harga */
        .harga { font-size: 18px; font-weight: bold; color: var(--biru); }
        .harga-coret { text-decoration: line-through; color: var(--abu); font-size: 14px; }
        .badge-diskon {
            background: var(--merah);
            color: white;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: 6px;
        }

        /* Status stok */
        .tersedia { color: var(--hijau); font-weight: bold; }
        .habis { color: var(--merah); font-weight: bold; }

        /* Tombol beli */
        .tombol {
            margin-top: auto;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            background: var(--biru);
            color: white;
        }
        .tombol:disabled { background: #d1d5db; color: #6b7280; cursor: not-allowed; }

        footer {
            background: var(--teks);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        /* Responsive: saat layar kecil, navbar disusun ke bawah */
        @media (max-width: 600px) {
            header { flex-direction: column; gap: 8px; }
            header nav a { margin: 0 8px; }
            .hero h1 { font-size: 26px; }
        }
    </style>
</head>
<body>

    <!-- LANGKAH 5: NAVBAR -->
    <header>
        <h2>Cia Store</h2>
        <nav>
            <a href="#">Beranda</a>
            <a href="#katalog">Katalog</a>
        </nav>
    </header>

    <!-- LANGKAH 6: HERO -->
    <section class="hero">
        <h1>Selamat Datang di Cia Store</h1>
        <p>Perangkat dan aksesoris teknologi pilihan untuk kebutuhanmu.</p>
    </section>

    <!-- LANGKAH 7: INFORMASI JUMLAH PRODUK (otomatis dari PHP) -->
    <div class="info" id="katalog">
        Total Produk: <?= $totalProduk ?>
    </div>

    <!-- LANGKAH 8: KATALOG PRODUK -->
    <main class="katalog">

        <?php foreach ($produk as $item) { ?>
            <?php
            // LANGKAH 9: HITUNG DISKON (CHALLENGE)
            // Jika harga >= 1.000.000, diskon 10%. Jika tidak, tanpa diskon.
            $diskon = 0;
            if ($item["harga"] >= 1000000) {
                $diskon = 10;
            }
            // Rumus: harga akhir = harga - (harga x diskon / 100)
            $hargaAkhir = $item["harga"] - ($item["harga"] * $diskon / 100);
            ?>

            <div class="card">
                <span class="kategori"><?= $item["kategori"] ?></span>
                <h3><?= $item["nama"] ?></h3>

                <!-- Tampilan harga: berbeda untuk produk diskon dan non-diskon -->
                <?php if ($diskon > 0) { ?>
                    <div>
                        <span class="harga-coret"><?= rupiah($item["harga"]) ?></span>
                        <span class="badge-diskon">Diskon <?= $diskon ?>%</span>
                    </div>
                    <div class="harga"><?= rupiah($hargaAkhir) ?></div>
                <?php } else { ?>
                    <div class="harga"><?= rupiah($item["harga"]) ?></div>
                <?php } ?>

                <div>Stok: <?= $item["stok"] ?></div>

                <!-- LANGKAH 10: STATUS & TOMBOL BERDASARKAN STOK -->
                <?php if ($item["stok"] > 0) { ?>
                    <div class="tersedia">Tersedia</div>
                    <button class="tombol">Beli Sekarang</button>
                <?php } else { ?>
                    <div class="habis">Stok Habis</div>
                    <button class="tombol" disabled>Beli Sekarang</button>
                <?php } ?>
            </div>

        <?php } // akhir perulangan foreach ?>

    </main>

    <!-- LANGKAH 11: FOOTER -->
    <footer>
        &copy; <?= date("Y") ?> Cia Store. Semua hak dilindungi.
    </footer>

</body>
</html>