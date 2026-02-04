<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Laporan Update Service</title>
    <style>
    :root {
      --brand: #0f62fe;
      --muted: #6b7280;
      --bg: #ffffff;
      --card: #fbfdff;
      --border: #e6e9ef;
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto,
        "Helvetica Neue", Arial;
      color: #0f1724;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      margin: 0;
      padding: 24px;
    }

    .sheet {
      max-width: 900px;
      margin: 0 auto;
      background: var(--bg);
      border-radius: 14px;
      overflow: hidden;
    }

    header {
      display: flex;
      gap: 18px;
      align-items: center;
      padding: 20px 28px;
      background: linear-gradient(90deg, #fff 0%, #fbfdff 100%);
    }

    .logo {
      width: 86px;
      height: auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo img {
      max-width: 100%;
      height: auto;
    }

    .company {
      flex: 1;
    }

    .company h1 {
      margin: 0;
      font-size: 20px;
      font-weight: 700;
    }

    .company p {
      margin: 6px 0 0;
      color: var(--muted);
      font-size: 13px;
    }

    .badge-wrap {
      min-width: 120px;
      text-align: right;
    }

    .badge {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(15, 98, 254, 0.08);
      color: var(--brand);
      font-weight: 700;
      font-size: 13px;
    }

    .service-no {
      margin-top: 8px;
      font-weight: 700;
      font-size: 16px;
    }

    .meta {
      display: flex;
      gap: 12px;
      padding: 16px 28px;
      border-top: 1px dashed var(--border);
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .terms {
      font-size: 12px;
      color: var(--muted);
    }

    .meta .col {
      font-size: 13px;
    }

    .meta .col b {
      display: block;
      font-size: 13px;
    }

    .body {
      padding: 22px 28px;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .card {
      background: linear-gradient(180deg, #fff 0%, #fbfdff 100%);
      border: 1px solid var(--border);
      padding: 16px;
      border-radius: 10px;
    }

    .card h3 {
      margin: 0 0 8px;
      font-size: 14px;
    }

    table.info {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    table.info td {
      padding: 8px 6px;
      vertical-align: top;
    }

    table.info td.label {
      color: var(--muted);
      width: 38%;
      font-weight: 600;
    }

    table.info td.value {
      color: #0f1724;
    }

    /* 💰 Table Rincian Barang & Jasa */
    table.cost {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      margin-top: 8px;
    }

    table.cost th,
    table.cost td {
      border-bottom: 1px solid var(--border);
      padding: 8px;
      text-align: left;
    }

    table.cost th {
      background: #f9fafb;
      font-weight: 600;
    }

    .total {
      text-align: right;
      font-weight: 700;
      margin-top: 10px;
    }

    footer {
      padding: 14px 28px;
      border-top: 1px dashed var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    footer .small {
      font-size: 12px;
      color: var(--muted);
    }

    @media print {

      html,
      body {
        background: transparent;
        padding: 0;
      }

      .sheet {
        box-shadow: none;
        border: none;
        margin: 0;
      }

      header,
      footer {
        page-break-inside: avoid;
      }
    }
    </style>
</head>
<body>
<main class="sheet" role="document">
    <header>
        <div class="logo">
            <img src="https://techfix.id/assets/images/techfix-logo-blue.png" alt="TechFix Logo"/>
        </div>
        <div class="company">
            <h1>
                TechFix by
                <p style="font-size:12px;color:var(--muted);display:inline;">
                    PT. Jaringan Pintar Nusantara
                </p>
            </h1>
            <p>Jl. Btn Cijujung Permai No.11 Blok Y, Cijujung, Kec. Sukaraja, Kabupaten Bogor, Jawa Barat 16710</p>
            <p>Telepon: 0859-1066-87035 | Email: support@techfix.id</p>
        </div>
        <div class="badge-wrap">
            <div class="badge">Laporan Update</div>
            <div class="service-no">{{ $service->id }}</div>
        </div>
    </header>

    <div class="meta">
        <div class="col">
            <b>Update Terakhir</b>
            <div>{{ $service->updated_at->format('d/m/Y H:i') }}</div>
        </div>
    </div>

    <section class="body">
        <div class="grid">
            <div class="card">
                <h3>Data Customer</h3>
                <table class="info">
                    <tr><td class="label">Nama :</td><td class="value">{{ $customer->name }}</td></tr>
                    <tr><td class="label">Phone :</td><td class="value">{{ $customer->phone }}</td></tr>
                    <tr><td class="label">Email :</td><td class="value">{{ $customer->email }}</td></tr>
                    <tr><td class="label">Alamat :</td><td class="value">{{ $customer->address }}</td></tr>
                </table>
            </div>

            <div class="card">
                <h3>Data Perangkat</h3>
                <table class="info">
                    <tr><td class="label">Model :</td><td class="value">{{ $service->Model }}</td></tr>
                    <tr><td class="label">IMEI / SN :</td><td class="value">{{ $service->IMEI }}</td></tr>
                    <tr><td class="label">Keluhan :</td><td class="value">{{ $service->Keluhan }}</td></tr>
                    <tr><td class="label">Kondisi :</td><td class="value">{{ $service->Kondisi }}</td></tr>
                </table>
                <div class="terms">
                    <strong>Syarat & Ketentuan</strong>
                    <div style="margin-top:6px">
                        1. Barang ditinggalkan atas risiko pelanggan.<br>
                        2. Garansi 7 hari untuk layanan yang sama.<br>
                        3. Klaim kehilangan wajib menyertakan bukti.
                    </div>
                </div>
            </div>
        </div>

        <div class="grid" style="margin-top:20px">
            <div class="card">
                <h3>Diagnosa & Penyelesaian</h3>
                <table class="info">
                    <tr><td class="label">Penyebab :</td><td class="value">{{ $service->penyebab }}</td></tr>
                    <tr><td class="label">Kerusakan :</td><td class="value">{{ $service->kerusakan }}</td></tr>
                    <tr><td class="label">Penyelesaian :</td><td class="value">{{ $service->penyelesaian }}</td></tr>
                    <tr><td class="label">Part Digunakan :</td><td class="value">{{ $service->partUsed }}</td></tr>
                </table>
            </div>

            <div class="card">
                <h3>Foto Kondisi</h3>
                <div style="display:flex;flex-wrap:wrap;gap:10px">
                    @foreach($service->getMedia('hasil') as $foto)
                        <img src="{{ $foto->getUrl() }}" alt="Foto kondisi perangkat"
                             style="max-width:150px;border-radius:8px;border:1px solid #ddd;">
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="small">Jaringan Pintar Nusantara</div>
    </footer>
</main>
</body>
</html>