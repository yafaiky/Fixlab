<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Tanda Terima Service</title>
    <style>
      :root {
        --brand: #0f62fe;
        --muted: #6b7280;
        --bg: #ffffff;
        --card: #fbfdff;
        --border: #e6e9ef;
        --radius: 12px;
        --pad: 18px;
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
        /* background: linear-gradient(180deg, #f4f6fb 0%, #ffffff 100%); */
        margin: 0;
        padding: 24px;
      }

      .sheet {
        max-width: 900px;
        margin: 0 auto;
        background: var(--bg);
        border-radius: 14px;
        /* box-shadow: 0 8px 30px rgba(16, 24, 40, 0.06); */
        /* border: 1px solid var(--border); */
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
        overflow: hidden;
        /* background: var(--card); */
        /* border: 1px solid var(--border); */
      }
      .logo img {
        max-width: 100%;
        height: auto;
        display: block;
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
        align-items: center;
        justify-content: space-between;
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
        width: 36%;
        font-weight: 600;
      }
      table.info td.value {
        color: #0f1724;
      }

      .device {
        display: flex;
        gap: 12px;
        align-items: flex-start;
      }

      .terms {
        font-size: 12px;
        color: var(--muted);
      }

      .signs {
        display: flex;
        gap: 18px;
        align-items: center;
        justify-content: space-between;
        margin-top: 18px;
      }
      .sig-box {
        width: 220px;
        height: 100px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: linear-gradient(180deg, #fff 0%, #fbfdff 100%);
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

      /* print-friendly */  
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
                <p style="font-size: 12px; color: var(--muted); display: inline;">
                    PT.Jaringan Pintar Nusantara
                </p>
            </h1>
            <p>Jl. Btn Cijujung Permai No.11 Blok Y, Cijujung, Kec. Sukaraja, Kabupaten Bogor, Jawa Barat 16710</p>
            <p>Telepon: 0859-1066-87035 | Email: support@techfix.id</p>
        </div>

        <div class="badge-wrap">
            <div class="badge">Tanda Terima</div>
            <div class="service-no">{{ $service->id }}</div>
        </div>
    </header>

    <div class="meta">
        <div class="col">
            <b>Tanggal Masuk</b>
            <div>{{ $service->created_at->format('d/m/Y') }}</div>
        </div>
    </div>

    <section class="body">
        <div class="grid">
            <div class="card">
                <h3>Data Customer</h3>
                <table class="info">
                    <tr><td class="label">Nama :</td><td class="value">{{ $service->customer->name }}</td></tr>
                    <tr><td class="label">Phone :</td><td class="value">{{ $service->customer->phone }}</td></tr>
                    <tr><td class="label">Email :</td><td class="value">{{ $service->customer->email }}</td></tr>
                    <tr><td class="label">Alamat :</td><td class="value">{{ $service->customer->address }}</td></tr>
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
                    <div style="margin-top: 6px">
                        1. Barang ditinggalkan atas risiko pelanggan.<br>
                        2. Garansi 7 hari untuk layanan yang sama.<br>
                        3. Klaim kehilangan wajib menyertakan bukti.
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Foto Kondisi</h3>
                <div style="display:flex;flex-wrap:wrap;gap:10px">
                    @foreach($service->getMedia('dokumentasi') as $foto)
                        <img src="{{ $foto->getUrl() }}" alt="Foto kondisi perangkat"
                             style="max-width:150px;border-radius:8px;border:1px solid #ddd;">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="signs">
            <div style="text-align:center">
                <div style="font-size:12px;color:var(--muted);margin-bottom:8px;">Tanda Terima Pelanggan</div>
                <div class="sig-box">
                    @if($service->getFirstMediaUrl('signature'))
                        <img src="{{ $service->getFirstMediaUrl('signature') }}" alt="Tanda Tangan Pelanggan"
                             style="max-height:60px;object-fit:contain;margin-top:4px;">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="small">Jaringan pintar Nusantara</div>
    </footer>
</main>
</body>
</html>