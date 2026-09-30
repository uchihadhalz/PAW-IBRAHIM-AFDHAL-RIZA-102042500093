<?php
// ===== DATA KOIN (array PHP) =====
// harga = harga per 1 koin (Rupiah), stok = jumlah unit yang tersedia untuk dijual
$produk = [
    ["nama" => "Bitcoin",  "simbol" => "BTC", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/btc.png",  "kategori" => "Layer 1",     "harga" => 1650000000, "stok" => 4],
    ["nama" => "Ethereum", "simbol" => "ETH", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/eth.png",  "kategori" => "Smart Contract","harga" => 52000000,   "stok" => 25],
    ["nama" => "BNB",      "simbol" => "BNB", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/bnb.png",  "kategori" => "Exchange Token","harga" => 10500000,   "stok" => 60],
    ["nama" => "Solana",   "simbol" => "SOL", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/sol.png",  "kategori" => "Layer 1",     "harga" => 2900000,    "stok" => 0],
    ["nama" => "XRP",      "simbol" => "XRP", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/xrp.png",  "kategori" => "Pembayaran",  "harga" => 38000,      "stok" => 5000],
    ["nama" => "Cardano",  "simbol" => "ADA", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/ada.png",  "kategori" => "Smart Contract","harga" => 9500,       "stok" => 8000],
    ["nama" => "Dogecoin", "simbol" => "DOGE", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/doge.png", "kategori" => "Meme Coin",   "harga" => 3200,       "stok" => 0],
    ["nama" => "Tether",   "simbol" => "USDT", "gambar" => "https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/usdt.png", "kategori" => "Stablecoin",  "harga" => 16500,      "stok" => 20000],
];

// ===== FUNGSI BANTU =====
const BATAS_DISKON = 1000000;
const PERSEN_DISKON = 10;

function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

function hitungDiskon($harga) {
    return $harga - ($harga * PERSEN_DISKON / 100);
}

$totalProduk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cia Store | Jual Beli Koin Kripto</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
    --biru:#1d4ed8; --biru-tua:#0f2a6b; --biru-muda:#eaf0ff;
    --oranye:#f97316; --teks:#1e293b; --abu:#64748b;
    --garis:#e2e8f0; --putih:#fff; --merah:#dc2626; --hijau:#16a34a;
    --radius:14px;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:var(--teks);background:#f8fafc;line-height:1.6}
.container{width:min(1140px,92%);margin-inline:auto}

/* Navbar */
header{position:sticky;top:0;z-index:10;background:var(--putih);border-bottom:1px solid var(--garis)}
.nav{display:flex;align-items:center;justify-content:space-between;height:68px}
.logo{font-weight:800;font-size:1.4rem;color:var(--biru);text-decoration:none}
.logo span{color:var(--oranye)}
.nav ul{display:flex;gap:28px;list-style:none}
.nav a{color:var(--teks);text-decoration:none;font-weight:500;font-size:.95rem}
.nav a:hover{color:var(--biru)}
.btn{display:inline-block;padding:11px 22px;border-radius:999px;font-weight:600;font-size:.92rem;text-decoration:none;border:0;cursor:pointer;font-family:inherit}
.btn-utama{background:var(--oranye);color:var(--putih)}
.btn-utama:hover{background:#ea580c}
.btn:focus-visible{outline:3px solid var(--biru);outline-offset:2px}

/* Hero */
.hero{background:linear-gradient(135deg,var(--biru-tua),var(--biru));color:var(--putih);padding:88px 0}
.hero-isi{display:flex;align-items:center;justify-content:space-between;gap:48px}
.hero h1{font-size:clamp(2rem,4.5vw,3.2rem);line-height:1.15;font-weight:800;max-width:14em}
.hero p{margin:18px 0 30px;max-width:34em;color:#dbe6ff}
.hero-visual{flex:0 0 300px;height:260px;border-radius:24px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center;font-size:6rem;font-weight:800;color:#fbbf24}

/* Info jumlah */
.info{margin-top:-34px;position:relative}
.info-kotak{background:var(--putih);border-radius:var(--radius);box-shadow:0 8px 24px rgba(15,42,107,.12);padding:24px 32px;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
.info-kotak strong{font-size:2rem;color:var(--biru);font-weight:800;margin-right:8px}
.info-kotak small{color:var(--abu)}

/* Katalog */
.katalog{padding:64px 0}
.katalog h2{font-size:1.7rem;font-weight:800;margin-bottom:6px}
.sub{color:var(--abu);margin-bottom:32px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:24px}
.card{background:var(--putih);border:1px solid var(--garis);border-radius:var(--radius);overflow:hidden;display:flex;flex-direction:column;position:relative}
.card-gambar{height:150px;background:var(--biru-muda);display:flex;align-items:center;justify-content:center}
.koin{width:84px;height:84px;border-radius:50%;background:var(--biru);color:var(--putih);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.05rem;border:5px solid #93b0ff}
.koin-img{width:88px;height:88px;object-fit:contain}
.card-isi{padding:20px;display:flex;flex-direction:column;gap:8px;flex:1}
.kategori{align-self:flex-start;background:var(--biru-muda);color:var(--biru);font-size:.78rem;font-weight:600;padding:3px 12px;border-radius:999px}
.card h3{font-size:1.05rem;font-weight:700;line-height:1.35}
.card h3 small{color:var(--abu);font-weight:500}
.satuan{color:var(--abu);font-size:.82rem}
.harga-normal{color:var(--abu);text-decoration:line-through;font-size:.88rem}
.harga{font-size:1.25rem;font-weight:800;color:var(--biru);overflow-wrap:anywhere}
.badge-diskon{position:absolute;top:12px;left:12px;background:var(--oranye);color:var(--putih);font-size:.8rem;font-weight:700;padding:4px 12px;border-radius:999px}
.stok{font-size:.88rem;font-weight:600}
.tersedia{color:var(--hijau)}
.habis{color:var(--merah)}
.card .btn{margin-top:auto;text-align:center;width:100%}
.btn-nonaktif{background:var(--garis);color:var(--abu);cursor:not-allowed}
.card-habis .card-gambar{filter:grayscale(1);opacity:.6}

/* Footer */
footer{background:var(--biru-tua);color:#c7d5f7;padding:40px 0;font-size:.92rem}
.footer-isi{display:flex;justify-content:space-between;gap:24px;flex-wrap:wrap}
footer .logo{color:var(--putih)}
.peringatan{max-width:34em;font-size:.85rem;color:#9fb4e6}

/* Responsive */
@media (max-width:820px){
    .nav ul{display:none}
    .hero{padding:56px 0}
    .hero-visual{display:none}
    .hero-isi{display:block}
}
@media (max-width:480px){
    .grid{grid-template-columns:1fr}
    .info-kotak{padding:20px}
}
</style>
</head>
<body>

<!-- NAVBAR -->
<header>
    <div class="container nav">
        <a href="#" class="logo">Cia<span>Store</span></a>
        <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#katalog">Daftar Koin</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </ul>
        <a href="#katalog" class="btn btn-utama">Lihat Koin</a>
    </div>
</header>

<!-- HERO -->
<section class="hero" id="beranda">
    <div class="container hero-isi">
        <div>
            <h1>Beli koin kripto favoritmu dengan harga Rupiah</h1>
            <p>Cia Store menyediakan Bitcoin, Ethereum, stablecoin, dan koin populer lainnya dengan harga dan ketersediaan yang jelas. Koin berharga Rp1.000.000 atau lebih mendapat diskon 10%.</p>
            <a href="#katalog" class="btn btn-utama">Beli Koin Sekarang</a>
        </div>
        <div class="hero-visual" aria-hidden="true">₿</div>
    </div>
</section>

<!-- INFORMASI JUMLAH PRODUK -->
<section class="info">
    <div class="container">
        <div class="info-kotak">
            <div><strong><?= $totalProduk ?></strong>koin tersedia di katalog</div>
            <small>Jumlah dihitung otomatis dari data koin toko</small>
        </div>
    </div>
</section>

<!-- KATALOG PRODUK -->
<section class="katalog" id="katalog">
    <div class="container">
        <h2>Daftar Koin Kripto</h2>
        <p class="sub">Harga tertera per 1 koin. Koin dengan stok habis tidak dapat dibeli.</p>

        <div class="grid">
        <?php foreach ($produk as $p):
            $tersedia = $p["stok"] > 0;
            $diskon   = $p["harga"] >= BATAS_DISKON;
            $hargaAkhir = $diskon ? hitungDiskon($p["harga"]) : $p["harga"];
        ?>
            <article class="card <?= $tersedia ? '' : 'card-habis' ?>">
                <?php if ($diskon): ?>
                    <span class="badge-diskon">Diskon <?= PERSEN_DISKON ?>%</span>
                <?php endif; ?>

                <div class="card-gambar">
                    <img class="koin-img"
                         src="<?= htmlspecialchars($p["gambar"]) ?>"
                         alt="Logo <?= htmlspecialchars($p["nama"]) ?>"
                         loading="lazy"
                         onerror="this.outerHTML='<div class=\'koin\'><?= htmlspecialchars($p["simbol"]) ?></div>'">
                </div>

                <div class="card-isi">
                    <span class="kategori"><?= htmlspecialchars($p["kategori"]) ?></span>
                    <h3><?= htmlspecialchars($p["nama"]) ?> <small>(<?= htmlspecialchars($p["simbol"]) ?>)</small></h3>

                    <?php if ($diskon): ?>
                        <span class="harga-normal"><?= rupiah($p["harga"]) ?></span>
                    <?php endif; ?>
                    <span class="harga"><?= rupiah($hargaAkhir) ?></span>
                    <span class="satuan">per 1 <?= htmlspecialchars($p["simbol"]) ?></span>

                    <?php if ($tersedia): ?>
                        <span class="stok tersedia">Tersedia · stok <?= number_format($p["stok"], 0, ",", ".") ?> koin</span>
                        <a href="#" class="btn btn-utama">Beli Sekarang</a>
                    <?php else: ?>
                        <span class="stok habis">Stok Habis</span>
                        <button class="btn btn-nonaktif" disabled>Beli Sekarang</button>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer id="kontak">
    <div class="container footer-isi">
        <div>
            <a href="#" class="logo">Cia<span>Store</span></a>
            <p>Toko koin kripto online.</p>
            <p>Email: halo@ciastore.id</p>
        </div>
        <div>
            <p class="peringatan">Harga pada halaman ini hanya contoh untuk tugas. Aset kripto berfluktuasi tinggi dan berisiko, pelajari dahulu sebelum membeli.</p>
            <p>&copy; <?= date("Y") ?> Cia Store. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>

</body>
</html>