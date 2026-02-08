<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Laporan Update Service - {{ $service->id }}</title>
    <style>
        :root {
            --primary: #0f62fe;
            --primary-light: #e8f1ff;
            --primary-dark: #0353e9;
            --secondary: #6b7280;
            --success: #24a148;
            --bg-white: #ffffff;
            --bg-light: #f9fafb;
            --border: #e5e7eb;
            --text-dark: #0f1724;
            --text-muted: #6b7280;
            --radius: 8px;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text-dark);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            padding: 0;
            background: #f3f4f6;
        }

        .container {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            background: var(--bg-white);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Header Section */
        .header {
            color: black;
            padding: 20px 24px;
            display: table;
            width: 100%;
            border-bottom: 1px solid var(--border);
        }

        .logo-box {
            width: 80px;
            display: table-cell;
            vertical-align: middle;
            padding-right: 16px;
        }

        .logo-box img {
            max-width: 100%;
            height: auto;
        }

        .company-info {
            display: table-cell;
            vertical-align: top;
            padding-right: 16px;
        }

        .company-info h1 {
            color: black;
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .company-info .subtitle {
            color: black;
            margin: 2px 0 0;
            font-size: 11px;
            opacity: 0.9;
        }

        .company-info .address {
            color: black;
            margin: 4px 0 0;
            font-size: 12px;
            opacity: 0.85;
            line-height: 1.3;
        }

        .badge-section {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 120px;
        }

        .badge {
            display: inline-block;
            background: rgba(15, 98, 254, 0.1);
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .service-id {
            color: var(--primary);
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Body Section */
        .body {
            padding: 18px 24px;
        }

        /* Info Cards Grid */
        .grid-2 {
            margin-bottom: 14px;
        }

        .grid-row {
            display: table;
            width: 100%;
            margin-bottom: 14px;
        }

        .grid-col {
            display: table-cell;
            width: 50%;
            padding-right: 14px;
            vertical-align: top;
        }

        .grid-col:last-child {
            padding-right: 0;
        }

        .card {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px;
            margin-bottom: 14px;
        }

        .card-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary);
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            line-height: 1.6;
        }

        .info-table tr {
            border-bottom: 1px solid var(--border);
        }

        .info-table td {
            padding: 6px 0;
            vertical-align: top;
        }

        .info-table td.label {
            color: var(--text-muted);
            font-weight: 600;
            width: 35%;
            padding-right: 8px;
        }

        .info-table td.value {
            color: var(--text-dark);
            font-weight: 500;
            word-break: break-word;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .status-open {
            background: #e3f2fd;
            color: #0f62fe;
        }

        .status-progress {
            background: #fff3cd;
            color: #856404;
        }

        .status-solved {
            background: #d4edda;
            color: #155724;
        }

        .status-warranty {
            background: #e2d5f8;
            color: #5a3f8c;
        }

        .status-done {
            background: #e2e3e5;
            color: #383d41;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* Photo Section */
        .foto-section {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px;
            margin-bottom: 14px;
        }

        .foto-grid {
            font-size: 0;
            /* hilangkan whitespace */
        }

        .foto-item {
            display: inline-block;
            width: 35mm;
            /* KONTROL UKURAN */
            height: 35mm;
            margin-right: 8px;
            margin-bottom: 8px;
            vertical-align: top;
        }

        .foto-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1px solid var(--border);
            border-radius: 6px;
        }


        .foto-placeholder {
            width: 100%;
            height: 100%;
            background: #e5e7eb;
            border-radius: 6px;
            border: 1px dashed #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #6b7280;
            text-align: center;
        }

        /* Terms Section */
        .terms {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed var(--border);
        }

        .terms strong {
            color: var(--text-dark);
            display: block;
            margin-bottom: 4px;
            font-weight: 700;
        }

        .terms div {
            line-height: 1.4;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px dashed var(--border);
            display: table;
            width: 100%;
        }

        .sig-box {
            display: table-cell;
            width: 33%;
            text-align: center;
            padding: 0 8px;
            vertical-align: top;
        }

        .sig-label {
            font-size: 10px;
            color: var(--text-muted);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .sig-frame {
            width: 140px;
            height: 70px;
            border: 2px dashed #9ca3af;
            border-radius: 6px;
            background: white;
            margin: 0 auto 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .sig-frame img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .sig-line {
            font-size: 10px;
            color: #6b7280;
            margin: 6px 0;
        }

        .sig-name {
            font-size: 9px;
            color: #6b7280;
        }

        /* Footer */
        .footer {
            background: linear-gradient(to bottom, #f9fafb, #f3f4f6);
            border-top: 1px dashed var(--border);
            padding: 10px 24px;
            font-size: 12px;
            color: var(--text-muted);
            text-align: center;
        }

        .footer strong {
            color: var(--text-dark);
            font-weight: 700;
        }

        /* Print Optimization */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            .container {
                width: 100%;
                height: auto;
                margin: 0;
                box-shadow: none;
                page-break-after: avoid;
            }

            .header,
            .footer {
                page-break-inside: avoid;
            }

            .body {
                page-break-inside: avoid;
                overflow: visible;
            }

            .card {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-box">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA7UAAAExCAYAAACj54XSAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAFogSURBVHhe7d0JYFXVnT/ws9z7ElB2QhYWa7XTqbadaW1nukxLFUiCWrum0/ZvXapFBcLiUu2iFGvdISRBbJ3pYjdt6cx0UyGALR2nu7adLtMqoLhANpFFJHn3nnP+5yY/MCKBl+Qt5977/Wh453sTQpb37j2/e+49hwEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAICbOD0CAEBCGLtvf27eK8fyUYqbA9LGw0ywH9CjDu3/TflhH/McPQ4QfS5q5k0u/25e0fcdZspVxW1/20dbAQAAIOZQ1AIAJEx348lvyQQH/lt4nkebUs300ZqpMGRcSmbC7LM95ZNOvHt7D30IAAAAxJigRwAASIiMx6tR0L6IW0JIyb1MJvq5iPLj2lHQAgAAJAeKWgCApAlNFbVggKi47Wvo8Dd9jwAAAJAIKGoBABJGMV5NTTiCHiN+Tk0AAABIABS1AAAJw7lBUXsURvBfUBMAAAASAEUtAEDCCBS1g+OCZXt6/kwJAAAAEgBFLQBAwnAuaqgJhzGcb516184XKAIAAEACoKgFAEgYLuU0asJhAmV+S00AAABICBS1AAAJY8JwMjXhMKExmCQKAAAgYVDUAgAkyOPnn1DOVdC/dA28DDeYJAoAACBpUNQCACTIuHFyCjXhMMaWtFmFSaIAAACSBkUtAECCSL8MMx8PgjP9GCaJAgAASB4UtQAACcJ1iJmPBxEw/ntqAgAAQIKgqAUASBDNOEZqBxEy/jA1AQAAIEFQ1AIAJIgyDEXtIIxkv6QmAAAAJAiKWgCABJFaV1ETBtCMmx4R/oYiAAAAJAiKWgCABOHCTKAmDMCNfnRG09MHKAIAAECCoKgFAEgQaThGao8gMJgkCgAAIKlQ1AIAJIgRYjo1YQAl+CPUBAAAgIRBUQsAkCQqnEQtGEAY+QdqAgAAQMKgqAUASAjdeHIZ1+o4inAQF6wXI7UAAACJhaIWACAhdjFWQU0YwHC+raZ1SxdFAAAASBgUtQAACTHK8BpqwgCaMYzSAgAAJBiKWgCAhDCcT6QmDBAa9ltqAgAAQAKhqAUASAjFeTU1YQApxe+oCQAAAAmEohYAICGM0Vij9ggO9GisUQsAAJBgKGoBABKCG4OR2sMoLp6p/uK2TooAAACQQChqAQASQkhMFHU4Zdj/UBMAAAASCkUtAEBCcM4wUnsYxfjD1AQAKIiq2QveVHPWlbNnnHPl7KlnXfEu2gwARYSiFgAgKWTmFdQCIqT/B2oCAORdzawFk8pGH/cbo/WGINAbtDY/mVq79B/o3QBQJChqAQASwhg9nppAApPFJFEAUDBZxs/LBiGlftyT86kJAEWCohYAIAHMvNN8rrKjKYKlOX+qquXxDooAAPnGPd+/jNqHSMkvqJg5/3iKAFAEKGoBABKgo3zXRKZeOlqQdoaJX1ITACDvpsxedAbn/FVR21h9G61sqDJ+eeZcigBQBChqAQASIMP8SmoCsSU+JokCgILJ+N7glxlL+bIRXAAoHE6PAIk3qXbh33vckxRfhnN56CyrMSovrw3fky/7PFwow7L97cD+mxn7aPzo47LM26+7H3+wJTGXS04966pXceaVUbToG7cCejycT4+56vt5HlP0U+4X/Z59+v2G2d7929c3P9H3jpjbvfjVdZ7qWUcRrFB69eObt66nCG7jrKHBjRPta9cqagEMakbdkmpb1e4IQsWU0kpw+xzm/ehDmFbmnzvamn5NEYrkFWct/QdjvInM68+h0v39BGN/S0dEVzlxkUN/4hj6PtVQrpqiL5IeCoEb+1QU4nn73e2TYfD8/jL/+WffMHo/W75c04ckwiC/3JeqmDn/X8qOG3V/Txj2Cs6FFNwWBtFfNcxo3ne9RZTsc8E+9L+mo7936JObaLtlNx/adkj0sS9eslFKh76Ig18Ot08DMtQv8MXLUOwzSUd/Pcr2h2d/gNE2T0h5oPeF1u6Naz7d/3FF0NAgK/dO67Y74Kz0hOcJIQfufA8a+LUP+C32GfjxR/iLdlP///TtGt33uQwTLPrO+/+u50t//+7uj3Vt/vLaKBfLhFmNPyjP+OdE39/A78Mlmum/drww7nVs8/LYX0daWbfkVE/KP9nnAG1xj8+Dq568v/V2irHWvfhVF5Sr7FcpgrUvlJXVX9zWSREcNmXOws9KL/N5iiXjCd791H0rKigCDKqqdvFnbNfm81F/QlvRtoF9i6gtGP/aMw+suJA2QZGccM5VD2UD9XaX+3su8Dh/NtDmr4Kxbbbv/phQZmtWsj92PtD0J/tudztvg8jprKgQIqOMGWOfFeOkEBPtS3Wc3Wzf+Dj7ih0v7Fv0eHC7fQ6Njd5sZ7b/jbExfW/2c0Sf56Vv+viXbyvNW/T19b29+PUe+h4Ofk+5vvX/fPp/Rracsz8jMSF6PLitNwjKtWIDRrCKw1aZ9vvSY2y5/pLf1WBf+4vtl3/8wJ9P31vfz23Az9BuO/h5ou39v2t9fG82KAs0f3HorEjKuLgmCMMD2v4A7Nfv5IvVFv9/P6Xs2UQcALkQN9kfNCX3hKH6S0VHbzPF2DNGVVETLLvP6URBGx/2mOFExzMbhL3UBBjcsmWCS++SqGCK+hO2j9d34n6g6MOE5OeeMHMxZqUvskAZXG2Rg9CYSfaZ+nbD2cdsb+16Jfm3JOP/O/XsK3dXz73iB1W1S6+omrvkTdGgGP0Vpw3pUh9PyqFeGQiDMPY/exAvCSmElFKU7AlaqoKyfWPz/2mt7yjl954LKfzl1WfPi/UsttV1S95hj+jvpugkqdSVDz9812BXQccOZ30nzYCEmv2cmhAHmhmtdOlPOFIxAnA0lQ89O1crNTVqHyxgDz4OlM2GoqdcnEcRiuxIvxM4NrsvHmt76+dwyW/nTPym5vkZ7VX1S1qn1C1+K32Ik3Iqao0c7Bp0GC5bVx3x0t9Ck56QvlfakxPR920L65I8p1Qov6C06Yq+hoOXCzmH82oTjLqcUixpJm6ippO0Cn/Y/uDqBygmguSmhppgGY2Zj2OlrzdS+is7olusqAkwKJnJXCZsR4bioKKPEVxcShGKBKVsfhlmJttd40Jbu/y8Zu7l26rnLvn81PrGafRuZ2DnXSJRUSVK9OOP/m1qloz93kvyNezZ3LxbG/XZvmD7T1rZEtfB4lZKeU3lnCumUIyV6vpF77OH+rdH7ZKPuhyBJ4XxWXgFxcQQhlVTEyz7Gvo9NSEenOiGRhUINQGOqHr2ohm2G3UWxWPj5jVV9UtnUoKioLl8IO9sp+5Eu6f8rPTLn5p65hVfnl5/5Un0rpLDzhtKo4TPvO62ln/rDcPfRmdQjT3a6OhacMfYr+k4LtW1FOOjoUFy7n8hakYFrQsnUA4X9GZvfbptzRaKiWE74xipHaCnR6OojZHoJG+0u3BxnwHwEkJ8YsjzRXCJ0dpicvM6vESJZv22r4OPG8m2VNVf/q3q2sv/nt5VMjmVFtFgFjUB8qSkZ9FMxpgro6IrOitvvxAnO1EZ319YUd/ozBmwXFTvnXqhYeY1UdvJzqkxO1U2vIFSonAm++7vggjvrvry44lZGis1UNCC62Yu82yv4WJKOct4/MPVZ18+mSIU2oDVS6CwlNb2x80+6pfJ/6uqX3LjCTPPL6d3FR1Gakso3SeSSvvUa9/Yullpda/LowLRWbAMzzh9b+pAJ9c3lklflnxJjqPRKvh01+Y1z1NMDLNspseMimYoB0sb8wg1IUZc3h8DRKoyu94bajPkJZ/6RrUChaV9ILGi5zjn4lPB6El/qZq7eC5tLioUtZBa0gs/JYQIcpnsoVQMZw3Tapf+E0Wn7TdysVLG2WVlQqV+2bFh9d0UE6W946mJTMV+aeO8CTnHzMcAkHfcz1w63BUU7F+7zD7gxA0kWnTPLWfy/sq6JXcXeyUPFLUlEl36imsjSqv9/jXbs9neG6O2q7+O6MvKcub8aK0tvCdmyvxlFJ0TDQAJEyyxzUS+7DLSVFITLMG9X1AT4sKRUVq7y8WhGY5oen3jSfZJOovikEWd/YrZi2spAiSaEOI8HR73P8WcSApFLaRa2T7vFqX1k9Flb64u8SMFP6OybmHuMy2WQCjY1dlAObu2rlLq6x0b1vyKYuJIT2CSqAFeYOx31AQYGpS0MAjN/MtGev5beHIeNQEST3D+j0rqhyvnLjqbNhUUilpItad/2XSAqfAarbSiTU4yxruBLVvm5Ou1pvby6eVl/icpOkdK0WN/uddQTCRlxARqpp7horumdUsXRQCAETulYVmGeWLIE0QdLuOJ90+uW4Ll1yA1jGbjJPd/VFnf2EibCgZFLaRe58bV94TGPCQs2uQcW5j9Y+Uv9p5P0SlG8ut7s+7ezxn09lzXvX7VToqJZJhBJ4mEKvwNNQGGAXcGwcvt2vfch4JseDzFYQuVZp7hn6AIkArRFQ6C+y1VtUuvoE0FgaIWwMoIfrlwfOJNLtnyaIZhik6oqm88RQp+AUXnKKUf7diVXUUxsYRxd4KuYgsM/yU1AYYMFS0cEZeXDHeCqMNxyS+J1nSnCJAa9rl/e2X9ooJdOYeitkRcnZgorXauX/VIoNSXKTqJMz49mmGYoiP8G6M1ylzFWXAFe/iugGJicWFwTy0RnkBRC8OHIzMcprJuyan2+PsvFPOhpnrv1KLcYwjgGsG9myprF19NMa9Q1ELRuVrQG+l9Vgqxn6KTpPSurZm1YBLFkqqpbXwb5+w9FJ0ThuF9HW13/JhiogkucPkxCQLxe2oCDB1HWQsvJTm7lJp5o5nAhFGQWtLzbq6uX/Q+inmDohaAdN1/e3uows+5PIqujD7e+OWfplhSSno3U9M5UnCtub6SYuJJIaZRM9W0MR3VX9zWSRFgyFDRwkDTPrh0FBfiPIp540l+ZtWZV5xAESBVom62EN43p81d+jralBcoaksFR04ntXe90KwZe5Sik3yPLyn1wbCmbvE5gvF3UHROEIZNz7at/ivF5DMcI7URjqV8ACB/gj3BR7Nh/per09G581BjtLZA0MV2nzZsdGjY96vqGyto04ihqC0ht6clKjBXn3kP3xVwrZwe4QuUFsKYGyiWAjdcfIHazuGcdWXVgc9TTAWtRj4rZxIEWJ8WAPJJ+Jd4UnqU8srz+CXstHk+RYDU4Zy/UhmRt/lsUNQCHKajreXH0f2YFJ1kdwTnTq1f9HqKRVVZu+gC+wW8lqJzlM5+6rmNd+2hmHi75r1ynNAh9uUWl5gkCkbI3XnvoMiqaxedJgR/M8W8U4ZNqpw06v0UIZ/wOo4NT8h3V9UvycuSlegIARyB138/prOz5kaXLoVGFv2e1mhJIen5zo6CBkH4q451q79CMRVkOZtCzdTr0d4vqAkwPNzdORWgyDx/PrUKhnNMGFUQeB3Hiidl6+S6JSO+jQpFLcAR7Gxb/VetwlaKThKCz62cu+QMikWxz4hFxpipFJ0STfDFhbk8avZvSQclBZbzsaJJompat3RRBAAYton1jWM9IT5GsWC44GdMnr3oVRQBUklpM0ZyNuI+N4raEsJpJLdldc/1nPFuik7SIYtGa4tye/YJ71k8PuP711J0jjHs211trT+nmBqGaUwSZSncTwsAeZJh/NwgDAtyL+3hMr5X8BFhANcJLj5QWbfkLIrDgqK2VFI9S1Q8RPdlhip0YvmcwXieePOUusUfplhQvVl+Taj0GIpOkVL0+h4ryGLerjMKa9RGFMP6tACQH5zJy7hFsaCkEBdHt/ZQBEgtrc111BwWFLUlUqydpbNichN/Z1vzv9tC7mGKTpJM3lDoGRSnnbV06qhMmbNFYxD0Ln/6vqZnKKaMqqRGqnEuUdQCwIhV1Da+rZiTIYZaH7/PiI9QBEgtz5P/VFG3eNiTp6GoBTg6I425XCkVUnaPYK+snDzqMkoFEWq+vCfr5rxZWuutk8ZOXEExdYRhE6iZalwrzHwMACPmy1JcDiwvpgZAqgkjltmHYQ38oagFOIb2Dc0/sw/f609uktJbFk1sQTGvqs5c/BpPiIsoOkdwfdVf1i7PUkwdwVkVNVPLMN49cc0T2ykCAAxLzawFkzzP+yjFohGCvb1yziJnl8oDKBYh+esr6xobKA4Jilooujheeu0x+UlfCmdHa40xE8uM/CTFvDJG3KC0m9eLK63adq5r+S+KqSSEcHI26mKyRe0j1AQAGLas4Odlg9Ic6oXnFfSKK4C40Hp4Vy6gqAXIwY62lU/1ZHudXZ814me8q2fkYZ2vgWrqFr9VMO7k4vCetF8ZC6IlfNLNoKi1XVDMfAz5YVI+30W6cU/6RZsg6nCeEBdWzJx/PEWA1PJ9OaeivvEkijlDUQuQo8xe7zallLOXOAah9pQQeS28Q8ZvoqZzskF2Vcf6NX+mmF5h70RqpZbgAiO1ADAilXMWnm7r2ZKtGRtqPcor8zFhFKSeMYZxI4Y8WouitoTieBlu3sTwmff0L5sOcKau1hZtcg4X4qLoHliKI1I5d9HZUoiZFF3zbJkXXE/t1OpuPHms4DxDMbU0N5gkCvIDvaLU4tK7lJolozi/hJoAqWb7nx8f6soe2H2XSFTQCtsbpQgx0dG2+juB0pspOie699UocSPFkeBcyy9Q2zlKhZ9+8r47n6OYWkqZKdRMLSPEsxNbtj1JEQBgyCrOnF/le94HKZaM7cifVjV7wZsoAqQYnzJ54qjZFHKCoraEBDcoamNIeOYKl89HCMHfWz1n4dspDkvN3KUXcMFfT9EpSumHO9ta/o1iqpUZnfrlfEKtf0tNAIBhkars4lBpJw7snj9qITUh5ly+si8OPCnrqZmT2BW1vdmwN1RhaDu2SoX0FrWP8db/n9L2zxze7B/0917ydvDfO9LbET7+8M8ZfZwh9O1ADHWva/2dfQI6XVRp7t1MzSE7pWFZhnHp7KRYwmSjyaHwGrKEJ2qomVqB4ZgkCgBGggspnLnsl0v+0VfOvnocRYgxYUX9f4olY6uQWBbX2ughFbU5nZWadPrCMzLlmU0USyYqBpUyNxptdkXVePQb0nbrwdrc9E1byF/W2RV2OzVtkNQ4GtX/yY8lh1MCB79O+4yyf0Rfm320G0V0ATIzv+/YsPrB6N1F0dAgq5+f7sSyNGH2wPldm+78OsXYqZxzxRTPN49pwwqyNmw+GK0+0L6++T8p5qxm7tIrDOO3U3SKUurezrZmTKRBdi945aUeV3dSTKVe6X14UvPW71CEmJpSu/g6KeVyiiVjuxk729c1pf5kUZpU1i46W0jvRxTdoPSinW2rWinBENWcecVP7Wu5pHOC9Ncsaofti52RDY3OeFwY7XGWsdVAGB7hxHwZM57iPJQ5n7SPPp6ah5TZt1775mnjh0xMEUZNZVxU+b73Nlt5nGXr2yHdp1pqKqtP6ty0ahvFo4pdUdsbqlc8t7EF908NB4ravJoyZ9FSzsXtQoocTm8Un90r/q39hTGvZZuX5/w7j84Oq1H66WyonFtWION5KugNT4yWV6JNqffcgpM+5/NwGcVUesGIV0+54/FHKUJMoaiFUqmqu/yHXLB3U3SC0vpPnetXvY4iDJELRW0kCMInuje2nEix5KrPnje6t2dUvRB8vi/FLNrsNKXZks71K5spHlVOnXEnqiDCA5PLGCpAwXXu6lltn4x/pegcztirqzLPXkQxJz1+9hoXC9pIb9B7PQralxJc53Vd4riJJomqmPz4FooAAENSU3vZdCm5UwVtRArx2or6Rf9CEWLKOHan1M4f3/XCro3N/9ndtmp2TxD8q2Hc+T6V5OJt1DwmJ0eYBqO1sf+FOY0uAxTcw3cFRuirKDlJyMzyyjlXHEfxqKafc1VNeVnZNRTdYsz2sgO7b6UEhAue7qLWmEf48pxuFgEAeBll/Iu1o9OceNxbQE2IKfvMcvb49NzG1u+akL3GFlbraJOTDFNvoOYx5VTUevRYaoZp+7+Pohac0b2u5f4gDH9I0TmGs0ouVDSx0jFppa4/0Jul5BbDgqu2b767hyIQzvk0aqZSyOUj1ATID5wiSY+ZyzzheZ+g5Bzfkx+uqm+soAix5OYJk4M6NqzY39H1wjnKaGfnpRBCvGrSOVeNoXhUsRqptV04++xAvxbckvG8q7Q20X35TvI971OVcy496nqmNXWLXy24GNKlysUSavVg+7rVaynCAFxmZlAzlQRnmPkY8otjdYK0qMrseq99cPZqlyBUzBjvAooQR65df3wkD98VdP7zuI8ao39MW5xi7C5ZZNU/UDyqmBW1hrNR1ARwxI4HVj7KmF5N0Tmh1qOkHH0txSMT4saw9LPOv4zg3Nj/l1KEw+lwErVSKWsMRmoBYFiMcHeU9iB7/JsXPfQngAJZvlxrX18sueimLU6xxWpOlyDHbaTWvpX3NwEcEpZllnPOuig6hwt26bTapSdTfImpZy7+Z8P4+yk6JVTqzs51Lf9LEQZ4/PwTylno5uXixaAZf6FiwratFAEAclZR33iSlKKWorM4FydPqV00myLETJwu++j8UUtHj+px8soAY8yrqHlUMStqAdz07A9v2xcq/WmKztGGecYXN1J8CW3EzdR0Chd8j2/40UeYU2zsJC/V91ppo3+DSaIAYDg84V8WXdYYB1LKS6kJUFDd61ffp7T5GUVnKGOqqHlUsSpqowsRqQngnM71q76cDcJfUXSOPX43VNUvejPFPjPmXn62fWW9i6JTgiD7qafbmnZRhMN4SqR6Lc2QyV9QEwAgZ6c0LMsIIS6m6DwpxPsm1y1J9Uz3UDxC6pzWhC0WE9E6eUUt7ioAxxn7groyev1Rdkr0ZUnh30aRsWXLRMi5k6O02VD9rmtc+10U4Qg0S/dyPpyL31MTACBnu/Y99yGt9DiKzlPacNu3iE0RDi+KY9nSfn/zf9kq0qn13+3xPqeT+Lj8GCCPuja2PKSMvoeic7QxM6tmzz8zalf9Yve5ttA9te8djvG4voKtXasowhFoplNd1OpQoagFgCHTRjo/QdThuOCfYA0NkiLEBY9lXWtsFfmAtiiXFLeEMFOjZv+WwaGoBcgz38hrPClCis7hXvnN0z64dBQT4nO0ySnG6LUdba0/oQiD0Sa1Ra3momdy5ROPUQQAyEll3fxTpeDvpBgbgvHpk3ZX9Z2QBig0pYOfCotiSUVXP0ouysbNXHzMqyviVdRi9TiIgR1tK5/qzQafp+gezl6n9/P1nPMTaYszPMlDu//6JEU4Cs5ymzghibjRv8YkUQAwVJxnYjvpkpRetLwPxEo875vsCc1m20ek5AbFpEfNQcWrqMWi6BATo3p336q03k7ROUrpt1PTKdkg/ELH+uYnKMJRSM4mUDN1AuFhkigAGJJpb1k6SnJxPsXY8YU4u7Ju8SsoAhTMvk13PGuY7qTohFGsJ2FFLUBMbN98d49m6pNaaSfvCxXSjctKBjLcPC38A7dShGMQPL0jtYKz31ETACAnwZjgo5qxMRRjR5voVkeJ0doYifOqLWHI2qnphFCX+9QcFIpagALpXt/6XaX1ZopwDEarq3b++K4XKMKxCH8GtVIna8wj1AQAyIniXuwmiDqcFPxidtq8Y3buwRGxLWmjS/XNs9Qsuei+Wi3UMSdKQ1ELUECc8yvsPg2XzR9DGOqfdqxruZci5EKbCmqliuYyWzFh21aKAADHVF234I2e4P9EMba0MRVVFaPeSxGgYATne6npBPvcT9hIbYyH8SGdujY0/14ZjfVWj8LuOG31Hy6hCDl4/PwTyrnKjqKYKloHj2CSKAAYCuGNWhgtDUIx3rTAJchQcEozJ9ZyjkZpo6EhzwQ9tGlQ8SpqUdJCDHGmrnXtjJdLtA6/2NW2+g8UIQdjR3upHKWNBNz7JTUhSTARJBTIyfWNY+0x+FyKscclnz151oK/owhOM3GuXJzoZ0Qno+zBwTwXlHfTpkHh8mOAAmtf19qltPqcKwtZu8QT4nnmyWspQo68jKihZuoIJlDUAkDOXjDyY0EYHnPm1Djxff8SaoLDeIxH46TkzkxGqYw5wH7ZdIDioGJV1GKgFuKqveuF1bai/StFINmg99M7f7zymGff4KWM5qldzkcZjZmPASBn2rB5ibn0mHAhP35yfWMZRThM3yWrMGyT65ZU2xfMJIolZbQxWqmclheK2UhtrIfxIc0eviswwlxJCaxQqT929E68kyIMAee6mpqpohk/UDH58S0UAQCOqqK28W22unktxcSwNdv4PVr8K0VwVUyrFhMGp7t0daGta3Ma/IhZUYuaNh9wBqs0uh9ofiAI1Q8oph7XZinbvDykCEOgjDuXBRUT5+aPmCQqofBbhQLwPX+Bi+uy54P9tnAJMhSE72dOFxbFkorup5VCPkHxqOI2UstYb4CCDGKLc3GlMSZLMbW00v/ZubFlE0UYIm5MKkdqFZOYUAwAclIza8EkW/h9mGLicM7fNrV+0espAuTFKQ3LMpyxsyk6wBgp+d8oHFWsilpju3LUBIilrramLVrrVRRTyXYylFHsKoowDEKwqdRMFSPkz6kJAHBUoRDnB6FK9CV+XPrzqQmQF13Pdf8/xt24Giy6spQzLjRLYFEbDdQCxJ0qz9xgX6cdFFMnVOqWzk2rtlGEYRAinbMfB2GIohYAcsE5l5ckbYKowwkuzquYOf94igAjxY3wl1C75KLXb3T7gDDmz7TpqOI1Uot17CABnv3hbfu0MZ+lmCqGmR1GiRspwjAJP/MKaqaG5jKLSaIAIBeVcxaezgV/FcXECpQa5Y0u+whFcAy3ZRk1Y2HirPkX+lI4dUk7N0yPzo7PafWQmN1Ta785gXtqIf4616/6chCGqVtvU6vwkx0bVuynCMNkdJi+M/NCYJIoKDh0MJJB+mXzkz5Ke5Bh/FJqwiF4JQ9VRe3Sk0eXj3JqRQqttO4N1S+3b17eQ5uOKnZFLUBCGM50NGlUava8YRD+rLOt9VsUYZjMvNN8+8NMXVEbav57agIADGpG3ZJqT4oPUEw8W7m/sap+0ZspgkticlrlhJnnlxtmvq60ydAmJ2hmtJTyvykeU6yK2r5hfClx+mUE0lREua5rw+r/sTuReygmmrAvXSPY5RRhBJ4Xz01gKn0rIWkjHqImAMCgssxcFISKUjpwjgmjXBSHqwUm1jeOfaFswgO+FG+lTc6QQkhmWM4rZcSrqI2q2h4PRRkkhsfU1b4nE1+hhGH4791tLQ9ThBEIMl4q16g1IfsFNQEABmN7ivIT1E4N3xPnjpu5eDxFgJz0XdXA5IOeFO+iTU4xxnZ59pqcT2jHqqiNFgI25WEq7pGAdHhmXevTPdnscoqJJIXYz4X+NEUYIWFY6mY+1tILJlf+7TGKAABHNHnWZWdqrVO35FkQKq+8zJxLERzBuXGzZmlokJW1jY0sI7dILk6jrc4JQ/3Tp3/ZdIDiMeX0w550+sIzMuWZnId/C6m3d/+0XQ9+6RmKMBT2SVy1b1oQNUt9SUSYPXB+16Y7v04x1aJ7GV4oH/9nT8hX0qZEUWF4eeeGliaKMELPLTr5Ql8HX6GYCjwz6jlmxJ2h0UZHi9YxbZgQg+/DzMH9G523tX+nv3G4l5/XfelMVDnOS8WPMivJUT/FgHeag+uwD/oXTPSv9L+3/0/71dufg2bCGKOFlNr+ZPar52+Y0fR0zp0AV0yes+ha3/Oup1gytiDa0bF+VSrXgU6CqrqlP+SCv5tiypi/7Hyg6VQKqVY9d+lP7I655KOP2qinOtY1z6BYclX1jRWce+81mi20rxOnZjk+kkCpi7rbmnPu78SqqA1CFUiu63Svesr37NE7kimzz5ojLK4t8nDvbZYeh3LbdPS1RP+2llzynvCpda1b6T2lh6LWWRVzFjZ4Xua7FBPDvmb/3L3rwBvYw3f1Pe9g5HYtPulTGRViWSR4GTNqTPvxt/2pxu7cY3ebDopaGKma2sumc2/0kzrNU4do/c6d61flPLFOUjlT1CrVXuZ7Z4cqqz3NRcBF/5PTk5xFvSKuXvpkjbZbfl8YGWVCTyhepTiP9mdTjeBvkVycofRRz7Q6w76MDwR7ZeWzP79tH206ptgUtdG0ztECvL29YW9ZmWcrWfcZZp5uf6BpOsXSQ1HrtMm1izf6Us6imAhBmD2ze8PqByhCHuxqPOmWjAk/SRHgkAPCX1DRsmUNxVhBUQsjVTln0XLheddRTCXO+D07HljxUYqp5UpRC0MXTWhrdN//93RtaB7SJfXxuac2OvVsxaWgjWRtj56aAMckhLk8miU4KUKlfoCCNv/s86SamgCHGOl1HZA9X6UIkC4zl3l253gRpdTyPPGRmlkLJlEEiJ1o0C0axGSGfYM25Sw2RW00SVSpRxeHirOj3PMFcJjOdS3/q436EsVYk5xro81VFCGP7E47lbMfw9G9YPjKON5LC5APFV73e7QxlRRTK1rKSEv/QooAsZQN1P92bWxuo5iz+IzUxpAtwfHzhaGR4rOSi+cpxVZWhbd2b2zBbLUFIDifRk2APtorMy/w4IsUAVJH+plLPCk9iqlm+56XRg/9CSBeoqtyPc/cFDX7t+QORVcBuTiuHLfR7rTZ+eOV3UplPxu9qGlT7NgvfafpCb5AEfJNmynUAugThEHzic3bd1MESJVptUtPFkLMoQhCnDSldsFsSgCxEmr9p451Ld+hOCQoagspxRPwwfDt7Jlwhzbm/yjGj1Kf6tq8JvajzS4yy2Z6OgzGUASwR3GPKa/sVkoAqaMEv9SF88DRyehoUlOKJSVF2SXUBIgVyVg0KDKsFzSK2gJCTQvDsnl5KIS5klKsZIPwf9o3tGBW6wLZt3PneM55Pmb7h4TIKv2dKav+upMiQKqc0rAswwR36B5S01fcUigZzxMfqDhzPuZfgFjJhuqhjrbmYS9viaK2oA4upg8wNO0PND+gjflB1HblzO+xRFe2e0Jfbpt43hcIF2EVbiGAQ+xTQUlxGyWA1Ones6shDMOxFEsq2jd7nux2YR8dKs1k6Kd+NmiID/uqyfqGzbPNYfchUdQWVDwWOAY3eVJdJTnrW5+ZNjlN6/CrHW2rf00RCoBzUUNNAHuEERsqWrY+TBEgfbic58wEUYb/0X5BKymVHPfkpayhQVIEcFZ0dUNWqU+1b2we0a13KGoLKL5T/YALnrmv5TFllDMHyKPxuDhQJoJPU4QCMdJMoCYAU54fzRAJkEqVdfNPlUK8k2LJGR3cnWUH7nbmYhrDptXsnnomJQBnZUP1393rm5soDhuKWig6F+43iQsdep+zB6YOis4Kwuy12+9f004RCkQbU01NSDktxG8nNP3tJxTjD70RGCLD/Etc6U8IW8jqkH2zq/84+FD/1tLTsu9yTgBnhVrvyGTC82xzxK/l3A4jWPkLoCQ6NqzYLwS7P1QqoE3OCVUYCuYN+8Z+GAJtKqkFKRfIzIjPagPE1bS3LB0lBT/PhftXo8LaMP1g54MtfSegPcPv7XuHA6SQZ1fPXjSDIoBbjNlnQnV2+/1rttOWEcG50YLCRFEwMtH6e1LKCz0pnZ3x1pOexyW/niIUEBcM99QCM0Jumzi2CieSILV6jgs/ohQ7nmLJeUx9m5osa3q/60k3utc6GsiWAqO14BylTa8K1fu6N7X+jjaNGIpaAIdpj7UEoaLkLsPZBbYA/yeKUCBC4PJjiJbxEbfx5ZtDigDpI+U8KYUTkyAJIbIZbdZSZO3rWrvsUXs9xZIT9mfFTpuHpeDAGUGgerUKLuzc2LKJNuUFiloAR9XULT7HGD6XotOii696GVtlm1hupoC49KdTE1LKcL5n7/PB1ygCpE513YI3+lL8M8WSiq485sb8YMu61r20qY826tvaolhS2piKiomj3ksRoKQEF3s9zt7XvXH1PbQpb1DUFhSuPobhiRaU50JGRWJseJK/tXL2ogsoQgEYLOmTer1KNJ149/YeigCpY3jmMmqWXHRPrzD6mxQPUaN7/7Pc953pBArBP0FNgJIJQ/Xn7IHeN7ZvaH6ANuUVitpCQk0Lw7T7+T1Xa8ZOpBgb0vdvPWHm4vEUIc+MVmOoCSmkGc+KsO+KCIBUmnTOx8cILv4fxZIz2nQ/dWDcyzroXWvXPB8a/Z8US05KOaeidunJFAGKSimtPCE2sWzwlq6ftG6lzXmHohbAMdVnL5qR8TOfoxgrhpnJvaP5coqQR7vmvXIcVwEu706xUPM1E+/atociQOqI/eXnKqUyFEsquvRYcHMv27z8iPe3KxM6MwtydIuQ/VovpQhQVNH974ax15QdX3YKbSoIFLUFFN1oQU2A3IXebb1BGNvXpidkY7QoPkXIE+HxCmpCCmkuTcD0LRQBUokL/xLhyARRfZcea/4Nii8z8bjxP5ac76NYcp4nLz65vrGMIkBRKa1rbHn786lnLSnYbNy5dZwxxyJAUUw9c+npjLMPUYwlpQ3XJtNMEfJE+7ifNs2MMWsr12xvpwiQOhW1jW+zBe3rKZacUurRp9uafk3xZf6ydnlWGfYf0YgubSoprc245028+xcQb7awlVqLL007+8qvFeIEC0ZqAVwxc5mnlElEMehJMauydvG/UoQ8MEahqE0rzpkRZbdSAkglKb350egoxZLStnduO9DfojgortW3XPmaI9p4mDAKSk4pff5+4d0/7YNLR9GmvEBRC+CIKeV7FtjO62spxh73xO3VZ88bTRFGyChWRU1IGc3lxvEtf32YIkDq1MxaMMkX8iMUS05IIYxRg156fNCOt4x70Fa0HRRLTkr+jsq6Jbg9CErP8DPUfv7DE2YuK6ctI4aiFsABlXOumFKe8W506YzuSHHDp7Fg9KcpwojpSmpAygRSNFETIJWygp+XDd25F04r/VDHhtWPUxzc8uXRWrXf6Q9uEJw7syQSpN7s3tF7v5+vS5FR1AI4gEtzcxDqxI1qSs+7Znp940kUYQQEMxOoCSmipf+HiU2PFWRNP4CY4FJ4lwqLcslJwe+h5jFxrr5NTSdIKS/AVVTgCs543X7mfY81NIx4AjgUtQAlVlm79J+E4BdSTJRoUoDAeBhlygPBDS4/TqFAyFs5w6rnkF5TZi86w9azf0ex5KStUlmQzXn09Zn7m39lX8HbKJacPS4fp3vLnbmUG4BxfnbN8zNuoDRsKGoLiJvkXEoKBcOVMU2OTI5YEFzwd0+ePf9MijBMgvNqakJKGM9/YuLYqu9SBEgl6YlLqOmEUOsf79h0x7MUc6K5vieaXIpiyWnm1s8UgHF2Tc3cy8+mNCwoagsJJS0cw5S6JRf5nngbxcQSIrOSnTbPpwjDIbzp1IKUyCp2K1++GYvqFVOSzzDG0OS6JdW+7zdQLLloeR5hzJAvJ+bcfCuaXIpiyXmeePPk2kWnUQQouWjXK6T8VmXd4lfQpiHL7QXm0SMA5M2E2fPG+ULcTDHRpBSvrpxYvpQiDIdSFdSCFDBc7tu7N/gqRYBUEkxfmA1CZ040cM72jubqBxRz1n5/8/9po/9A0QmelPOpCeAEpdRY+yq7Z7j312KkFqBEPDEqmhZxEsXE88sy1087Y+lUijAEu+a9cpxgBqcXU+SA0itOvHt7D0WANOJS+Je6tCqA0ew/tqxr7aU4RLlPLlUMnvQ+NrG+0RYRAO4QQryl+vlpw5qhG0UtQAlUzln02vKMv5hiKiily8IMu40iDIHwOEZpU0RzGXqhWEUxHZy52xBcUTlr4ZnG6GkUnWCYPubatIPhovdel1btU0r5vubnUQRwhi/lTTXvXTDkQR8UtYWEO3NgEMrwlaFKXy/OHtA/UjVn/jspQq6EmEgtSIHQmK9MvGvbHooAqcQ9/xKXRmntMfuJjvXNmykOWfv9a7aHWv83RSdoJj5BTQBnBEofz7JlN1HMGYraAjIcE07Ay02ua/yQ78s5FFNHcX9VPtYjSxPNNWY+TgvhsUALXNEAqVZTe9l0KcW7KZZcNEEUZzq6fHhE/TrB1L1KaUWx5DwpXl8xZ+HbKQI4gzP+iZr6y99AMScoagvI/kIw/zG8xLQPLh0lhbeCYipJIf6xcnfVpRQhB8Jgjdq0yCr9nco1W7dQBEilwMiLtUPjAtGIsRDmmxRHwKyVkjs14OF7ZQuoCXkUnQiJUIQhil7/mvHrKOYkNkXtwSfGgWzQc7Adrfll31SUI9G2Uoq+hugMXKjC0KUzca5x6XKiYgv36s/aw1mqJ0uKfv9eJnNjVX0j7hPNkd3JYaQ2DeyuUUmM0pYSeqAOmLnMk55/MSUnBGH42/Z1rX+hOGz2c3TZzvpGik6wRfa/Vp99+WSKkCdG2/+oLqBN/XVCqFX0Vox1i6N/z1ZKfWhTrAhu3jOUJX5yKi4mzVl4RsbLbKJYMrZSDOxv5UO2h/eMEVwwpUzIlT0G0fKXRh76fg6fJpT3fVzhGbt3iB59o7nmqqerbbU7U7g3NMjq56eH0ZO81IVlmD1wftemO79OMRUq6htPKpdlj4Za4woJixvz7zvWNeF+nhzsWnDiFzNcY7H8hNNcbhjbuq2WYqpMnrPoWt/zrqdYMkqpZzrbmp2anChtKmYt+ICXKfsexZLrKwxUeGXnhtaVtGlEauYuvdAw/hWKTjAquKq9rfV2irFXPXfpT2wv410USyIqXA03HVyYuUFvqPyobslk+t7HQ2Wyfa2X87WtI/o/7NgG+ySWZtxjQlXZ324NZ3wKF+KN9jPX2YJoDH1ILHAumnfcf/sSikcVq6I2OqsRhAdm7HrwS8/QJhgKFLUlVVG7+PuelO+hmHrCPgV1+MKbdrbd+TBtgkHsbjzhB55h51CEhOqVZWdOan70AYqpgqIWDppSu2SdlKKOYsnZzpIJeE9N1/1r2mnTiEw656oxmVB1M5Nz6VJw2pjHOtY1vdo2E3GxggtFbdTXDpXa3r2h5UTaVHqnzfMnjc28Q/jeR8t876IiDBaPmC/lgd5eXdGxYcV+2jSoWI0YGWNfbCpT0mIMYDgm1y05CwXtS0X3SyiTiZYtwWv6GAQXNdSEhNJcPDKx+dF1FAFSqaJ2/smeJ50paCNhqNbnq6CNPPvD2/bZhx9FRU//ltITnL9q0pyFp1OEPHHoV9zv4buCZ3+y+sGutlUX92j9aqX5d0o8xnVMgVKjmFAXUDyqeBW13HaDdYgOMMTLafN8+0LLy2VLSSOkeHvFrIUfowiDENKfTk1IqEB4t0cjQhQBUkkyb57W2pnXQXSFoGD8Xop5E4bhPS4VtRFP+JdRE/LFuDUp2EDdD6x8tHP9ig+HYVArBY9OtLhLiPdS66hyLmrdePHZQ36Zj6IWYqViUtnlUoi/owgDRJfBS8+/ZWJ941jaBEegw2DIi5BDfGgu2ieOr1lLESCVTmlYlhGef3Gpb48aSHgia5jM+/2944T5sSfEMS+nLKaMLz9YMXM+ZtrPk+h5HIelPTvbWjb0quwbQq3/SJuc4ws+K5d+Ym5FbUiPJRYtkWMURmpHzLnrIZJr2llLp2YyZcspwhFwwat8xYY0bXuaPH7+CeXC6MPnvoMEyWpzM1++2ZEjLUBpdO/Z1aDCcBxFJxjN/jOXe/mGasu61l7N+X9RdEKoNONl/kUUIS/i0d3uWte6VXH1L4HS/0ubnKK04T7zzqQ4qFhdfmyrWRS0eYCKtnh6A3ObVrqMIgzC8/ylVWc0nkIRBhgz1sdSCwlmGN+973nzJYoA6cXlPCGlY/1S8y1q5F2owm8XY1mXIRFiXjSpKCVIkV3rWvdyod7POd9Nm5wicrgEOVZFLUCcTJ6z+J1S8A9ThKOwR3WhPdFEEQbwuMIatQnWa1jTiXdv76GYXuiNpFrlnEtfK4V4J0UnaK3b2w+MbaOYd11jd2zkgndRdILkfMbkPVPmUoSUiUZse8NsVNjSFncIwY/5vMRhBKAQGhqkYaYpuqeCtjglOjvs2iQVUsraqjmNH6QIRBvMfJxUmomsOF40UwQn4FqmUuCy3Kl1uKPjoz16f5dtXl642wLWrlX2X1rr2mit4N48akIKPdvW+pNAh9+m6Az7Ohk7tb7xqMutxauoteVBOTUBXFa5p2q+L+UbKDonq1TWlrXOFbZayFtPmHk+XuYD2F8RJu5IKNuj/drEW7btoQgucHi20qSqPnveaCnE+RSdEJ2Qts+EuykWjFHmmzxatN0hvvTeXXXm/BMoQgr1Mn2d77l3FXpo5D9Q84hiVdS6OuoFwyBEYn+XVfWNFZ7MfMHl5+vocr9VSiFdK2ptx+bEnsz4ayiCpbnB5cdJJDzGfXEbJYDUUj1lH9WGjaHohDBUf9m5ftUjFAumY0Pzr2xp+wRFJ0RryBuV+QRFSKG90WXIQfBvFJ1hK4fXUfOIcPkxQN55N2pmnDpAD+QJ/h/P3Lfyk/awtUlYrhW2fpn3mco5C0+kmHrcqEpqQoIoY9aOb9q6hSJAahkhL6amE7RSWnJWtMsvBeffoaYzBOMXRWvsU4Rhi+/4jQm1c89Lw/jrqXlEKGoB8qhq9oI3SSGcOkAPlPE9xkXvVVFbCnZFdNWTayPKShmPC38lxdSznasJ1IQk8TJ4jkPqVdcteKMnxT9TdAKPriTzgm9SLLiQFa+AzpngVRUTy95DCVKo87menxmjnbo9RoX6JGoeUayKWtdGlAAOw0PuNUWX7rgqyPbe+uSPVj8etZ+5r+kPzOiv9b3DMVzw91bUNtZTTDVhGO6pTRopHhrX9NdfUgJILS7K5lPTGfYY/t/t96/ZTrHgOh9o+mOojHPrgwohMWFUmj18V2D/bNNW/4bSs73rsdQ8IozUQtEl9eRExewFF/ie/BeKLnq2h+kvULuP8L3PZDxPUXQL91bi8if7O+JyKjUhIZTwbqImQGpNrG8cKwT/GEUnRP0Tn/Gij5wKzu51rW8kpZxTM2vB31GEFNI6/LM27hS1XPKJ1Dyi3IvahBYiUCJaJ+r5NGH2vHGeV+ZsR1UprQw310WLa9OmPk/98LYdPWHvDRSd4gn+mikTyhdRTC+jKqgFCWCE2Da26bEHKIJj0NEpngzj5wZB6FF0Qsb3uFdegnsJM+Je124Firr9xvMxWptiyuh2ajqBGzOemkeEkVqAPPBY+XWMM2cn9NHG/Ll9/9i7KL5U6EUzsO7sD27JZPzrJ9ctSe3sv482nlxmVDiaIiRAL5M32J4raidIPaPFJUJKp/qhWoU/3P6D5t0Ui6bjRyui24LcuyVBygtPrm8sowRpo1k7N+6sViKlzBxt2cecdyauHIG59NAZAKdUndF4SlmZv5SikzyPXTPYIvIdG1bsZya8lqJTlDGjfcZupZg6E7M9k+1Oz73F4mBYNJcdkyZM/QZFgNSqqG18m5DiqDOZFlsYqkB4XtEmiDqc7ZDfGwRhlqIbjJm4V/EGSpA20uw13K0rdXez8YMWtTlV3+NOX3hGecbbEC3/QZtKIrrfgIfqFTs3tjxJm2AoGhpk9fPTQ620tgeTkv0uo9+jCnou6Np059dpU6xNmtO4LuP5dX3PT8cuH4pordZ1rG+eS3EwvLJ+6SOC83+k7JQwCN/RtbHlIYqpsXvBK9/kcfUbihBzPVwundy6bRVFGGBy3aJrfeFdT7FkbGHzdNeG5ukUoUCq5i79Jmf8/1F0QnQM96T4nT2MZ+3RPLr41r5FUz/2H9e5zf0jPDb2/U/H+6ht/8LBcSLOo3b0eLQRrr7P3qfv89iPtJ96TJAN/97+NXsodqcvoZT57862pndSjIXquUt/Yn8D76JYMtls+Pizm1peSTF2Js+e/xEu/Ls9KZ2Y3yR6vbQfGJsZbJCmpEUqQNxV1S9uiApais6Jzl0YIT5J8WiifUXfUj8u4kJEhYAzB/niMVjOJyHs63DvC172SxQBUqtm1oJJvpAfoeiMqJBU2rwxVPotSqu3aq3fZjR7u61r3xa9RW1b1to383ajzduj9/e9Kf02+/feGv2d6C36+9FbEIb/PPib+uf+f8e8NdT9H6+UPlVIIV0qaCNS8ndUzln0WoqQIoLzavtkdOcEi9a9gxW0ERS1AMNUffa80XZ3f3vUjipC1w5EEaXCL0XLBVA8qs71qzbag+uPKTpFSnFaxazGSymmBtcmtfcTJ02PNnfMaHr6AEVwVArPnBVdKMT59liD/meMeJ53GTXjwXA3LpmN+Q6F962+4E7fVmvzkslOD4edCsAwhdlR1xitprla0ArO9humhnSvrN0hXCO4IweDw/jl/k3RGX6KqaCZxhq1CaC5tH1400IRIM0441j/NG64EOf3n8iHNLG/93+RUjg0rwffR40jyrmoxdlLyJeoCKRmbE05a8kryzP+p6OZG139fsIgu7x9XWsXxZx0rF/151CpOyk6xWg2znj+5ymmAnd4Rm3IXajVlyvXbHdqaQSAUpg0Z+Hp9rD5aooQE0rr43RvuXOXjEPhRCtPCCH/iaITtNF7qHlEuY/UOjgSBVAqOjC3h0r3nb0q9QRqR2I70dvGSD68kSEtl0sh9lNyChfi0ppZjW+gmHj2iVVDTYgre+gMjNd3mwJA2mWkl7rbSJLCcHkJNSEFJNdnaq2dGrSRgj9BzSNyrjMO4LrJcxbO9aV8H0UnCW0+s2Vday/FIenYsKIzUOENFJ1i9648kDI1s8cKznBPbcxltf5+5ZqtWygCpNaMuiXVvu9jeZiYkpK/eXLtotMoQsIpxS5y6da66KpIYfhRj6UoaqH44nzx8WnzfM69FZScFITqoY4NLfdSHJYxTDVpY7ZTdIonxTunzJrv1FIQBeNnZlALYkp74mZqAqRa1piPZ4Mw9rcfpZknYzZhFAzLxNmXvV9w4dSlxxHOzaPUPCIUtQBDUDGxfKktql5D0UnC6BEvzRON8hodfsbV+4WFn7m1Yub84ykmGMeSPjFmOPvZ5OYnfkURYiD+Mz44izMh57k4qSLkTgrxsQmzrx5H0Vl4GY9AQ4OUInO9WxNERQUt50oJFLUA+TBp9oKajO8to+gkrfQ9nRtbf0lxRDrbWr8dKP0Lik7hXNTIssx1FBPJNDBptHK+8wCDy4oyjNICWJNnLYzuz5tKEWLK/g4zHj+QjiulUmrS7srlgnMnB28E0yhqAfKBC+8WbdhoV0cvpWSh0PoaivlghDRXU9s5fsa7sqZucWJn0Xy26uTjuFYY1YgpI8S2ic2PrqMIx6LpERLJ9/1LXRv5geHhjGNJpoSaPHv+hzJe5jOuTYAa9buDUG3pfLClgzYdEYraVMKFGUNVXbfwHb6U50ZtVy+fCkN9286NLU9SzIuudS0PhUqtpeiUUGmuGE/spFGjPD6GmhBDIeeftzsK7Gwh9WpqL59u+8hnU4SYk578h4raxrdRhISomLPw7ZnMqK9TdIrWRtuu92aKg0JRC3AsDQ2yV4uVUdPVUVr7lXUGGf8mCnnFFY9Gf4P+5BbbUaqfMmeR0zNRD5dm4URqQsxoLtrHj5/+TYoQI46es4w1xdQnlGNLg8DISOnNpyYkwKTZ8z8mhL/JdnHLaJNT7G45Okf8M4qDQlELcAwVu6sv8bh4Q1TQujpKy4y69tkf3raPUl51blq1zf4Dqym6R/BbT65vdHJHPBJGG0wSFVOBMU18+eaQIsQIF+gX5dXMZR6XwqmlQWDkPCE/PLZ2KU68HkN/MeauE2aeXz55duOtnsh8TQjubD8quhxaCf0gxUHltvPmHGfYIK8UPbquZtaCSZ4vb4zuBXJ1lDZQ4e93jtn5ZYoF4Yuyzwsp9lJ0iv3VnLzX8E9STAyp2QSjwtDV5x0cmeF8j+HeFylCzKD4yq8Kr/s9RpkqipAQSmuZMfoCijAIW9O6uT9paJCT5yy8qHf0hK2+719l+3dOn8zLZoP/27Wu9WmKg8IZSSiJuMwWoaT/BdtLHRcVFi52dqKvy+f8GrZ2bUHPEzx5383P6TBwdubnMt+/rrJu8SsoJoLmegyXnodOdrxkjV4zuXWLkyeA4NiM1piyKo+kn7nE9Q4zDI+U4lL74OTxyYUvKuqfUdMVvLpuyRsr6hZ/bsqeaX+W3PsSZ6KG3uesaJ8sPflDikeV0+993BmNp4/KeJtK3bmKniA8VK/I92Q4qdHQIKufnx5qpXUpDzLRv69V74Vdm+508ob0gybPanxDWVnmEW33S33PPQeLi1CFP+pqazmHYmGdNs+vrDjuz4LzV9EWp2ij/6Nj3aoPUoy9rstqLh0l/TujCRKE4LHuFNoXvBJCJn7mU81474Fy84rK27e30ybI0eQ5i671Pe96iiUR7eft7n4PZ/oaHjXtPl8fvK7IiJd3UO0HREMDub04Dzvv+LLS2b488v4qF33/zMFP6wvz8FMPrPotxYKbVrv0ZO2Jx6IfKiSTCsLZnRtbNlF0RnX95Q/aCud0iiVhe7rRjeS7bU/t09H+w6N+d99L33Yso0f7cOjF0fdOu88Z6m4gOrDaXir1T+3fpk9gmH31GTmFCTHVvrNKMfMGu7G6/73xogV/Xcd9K/5EcVAoatMERe2QTJy9aHOZ770z2jFF1/PTZmdEv8KwNzilfWPz/9GmgquqXfQBw8V3Xfx5RFTQYw+wa5w7wAJjzy066Zu+DhO9vmHAzBcnrH7yMoowBJPrbFErSl/URv2cA9mgp0zKzMHjZLS97wMiB8OhLbY7yV56ixbv62BSdylqDaXv9JJ/7KWO9HmG9LmZvmHnA6uupVBwlXVLbxOCX0kRksiwtTvXrfwQJWe4UNQeFIQq8D3pU+xzaDdypJd7/3vs28D9yoB9ykEU+x4G2Q8Mbf/gplCpR7ramk+jeFROdkwHk4RfDsRDxayF50UFbdR29XmXzQari1nQRtrbWv5DaXPMadVLRpQ1RyPKlMAhgotk77/tboL7/gpKEEMH9/WjMn75wBO/0fZDojN6Efv+/jfZ//+At2jDofdb9Ddz0/9Xjog+4iXoS8xR8bp8pzQsy9gfw0UUIaE8TzRMOWNRJUU4gsML2gi9fI/8cqf9SrQnefG/AfuUg28k+iT06V6G/rnY6huE4969FI8pVkUtQDFMOueqMcLz+pbHic6iubhjsF/Wblkml1MsKs+En3R1XyklP7VqYvlCiuASe9ilViKFWn9/fNPWLRRhyNAdSZLuPbsawlCNpQgJFSodvXTdO3nBD16OC3EmJNNa8m9QPCYcRQAOw3t6rxVC1ERniGiTU6LLobVWN+z88cpu2lRU7Rvv+K1S4bcoOsfP+DdUnDkfs21CUXGv7GZqwjAd8VI8iCUu/EuiUWuKkGDS952dMAriLQjNN7ruvz3nOSpyK2oNznhAHjn8bKqavfg15b5/BUUnLz02zGybPG5CK8WSkEZ+igseUHRKqM1oT2VuoQhQcEaI345rfuxXFAFSrbJuyamCs3dQhMQz0ytrF51FASAvou63z+WtFHOCkVqAAQLOViptRDQWGt2zQJudoZQKDVef/sva5VnaVBI72lY+FWR7+3Y2Lo6ucCnPm1K34K0UwQWuXrOeByHvv10BAKKXOotG7iBFOPfmUdMRGIuLu94g/O7OtpV/pZiTnDvtLo5YwTDhN3lEFbWLPuBLURe1XX2+K8P+p2vd6rUUSyurb7YlbaeLP6v+OjvTYv/Asx0KygixbXzzY/9FEcBdRTj9WH32vNGeEOdThJSQkr97an3jNIoAIxKtTcsFH/IVdxipBbBOmHl+uRByRVSgRffSulioaW2UL81VFEuua/Oa541Wyyg6Rwr+puraxRdTBCiIkMkb7M4C94LmgYv7XRga3Zv5iDJsDEVIiWg9/1ALx0ZrIa5sf/d73etXPUIxZyhqAaye8gmfEpyfELW5q7O0cvbt9nUtv6HkhPa3TLgrVOqPFJ0jPO+WabVLJ1IEyCstvM7xE6bmPDMjQOIJ/xJqQcp4nryEzVzmUQQYFs55j8flsNa3RlELqVc5Z+GJGd/7TNSO7g91dJT2BY+Fn6bojuXLtdHmGhfvq41oYyYowa6nCJBXoTZNfPnmkCJAqlXXLXmjEPzNFCFltGFTqjK73ksRYMiivqRS4fXRvC20aUhyKmpx2gWSTHHv9lDpvqUHXL38TWt1+zPrWp+m6JTujS332859G0XnSCkXTJm14HUUAfJDes+z49idlABSjwsxn5qQUka6NmEUxEmo1F8njR2/guKQYaQWUq26bnGdL8X7o7azo41a72DZ8DaKThIquMrVq7aj5YaN9KNJowDypidUqyfesm0PRYBUm1jfOFZKeR5FSCkpxJyK+saTKALkLBpTkkwvHMnqHihqUwgzcZDT5vmai1WUnByl7Su0tb4umpSJNjmpc9Mdf1RKf4Wiczwp3jVl9sKPUISSSNDhRnhMGdNMCSD1fCM/FirlU4SUirosnvGwpBMMmQrDGzs2rH6Q4rCgqE2jEhdvrlSOFZPKFtuv5dUUnZRV6uGODS3OFosDhcx8VgjeQ9E5wvdvr5g5/3iKAMMWan135Zrt7RQhD4QxON8aY1LIy6gJKSekvPiUhmUZigDHFAbhzzrG7biO4rChqIXic2BEdEbdkupyv+x6F0dnB+JMX20fYrFcSPf6VTuVCm+i6BzOeA3P+H0TgkEJ8IQULXaXkRX8C5QAUq967pK3G2ZOpegMpaIF+rSO2tFVT4OJPuZw9K6X6Pukw0B//WXon+oXfaVDeIu+t1CFYWgPuvTPOEMbPb57z64GigBHZZ8vz/nCO5etXato07Dl1MmYdPrCMzLlmU0USysIT9i5seVJSjAUDQ2y+vnpYbQzLWUxF/37Kui5oGvTnV+nTUVXOXfJNwQT51J0UqDUf3W3Nffd7xsX0z64dJR6gW+1ZXg1bXKK5Fzr3p7X7Nh0x6O0CYpkzxV/f6/sPfCvFGMrZOYH41c/iRk+82xK7eLrpJTLKUIhGHbDznUrr6WUNzVnXv4tW/J9lKIT+vo5TKy3zZ/2b3lRVLFS88iofzTkUZ9jfV6rr8IeoUNXNQjDtRGnCsGc68vYuvtnnetXzaRYdNVzL/+JfXhXfwJXKaWzWuv3RROO0qYRQVGbJihq+0Rnle3R4CGKTuLMhNls9tTuGBZflbWLLhTSc/aSaaXUfZ1tzWdThCJJSlHbI/lbJjc/8SuKkCcoaougAEVtzawFk/zjjuvOBu6tbCUFf93T9634E8VEmjD76nFjR5vdLv78e3uDU3c92PoXikVVc+YVP7VdzZIV1XBsUS2gjZnXuX7Vv9OmEcPlx5A2XGnm/AQvgdJ3xLGgjXS0tXwtVPphis6xHeezKuc0vpsiQM60EL9FQQvwolCI810sqJRSv0t6QRt5buMte+zP/7sUnZLJ4D5rODJt2T+uzWdBG0FRC6lSU7/0MinEaRRdtcdX4eepHUdGmPCT1HaT8FZgIgsYKiX5jdQEAEt6vnOFSzQC5HFxD8XEE5yX7Fauo/E978LKOVccRxHgEPucvau9rTnvc1PkVNSGnMdiohqAo6l574JJwpPOTmQUiQ7GQTZ73Y5NdzxLm2IpmpY9DNUPKDpHCP6q7ueeu5IiFEW8z6EaIbaNb9r2fYoAqTelftEs+3Byf3JHtGa6VN63KCbeM8c9uc520ndQdEao9HFCKCylB4dEfVyt1Jqd65rm06a8wkhtGtknFbVSxfSWfUEpPZaik4Js+Nfu3dk7KcaaL9jVnnR3F1M+KrO8pvay6RQBjirL+G3c7kYoQgFEHR5qQiGY/M6lIbmb65EqbTY8tfE254q8gumfNfYbLr5+NOPzqAkpF83azY35fEdb8wIbC/JcRVGbQmnsNdTUN75BcH4JRWdJyT/DHr4roBhrO9Y3/y0I1R0UnROE2jNy1AqKAIPSXLTvl9m7KQLEUx57fNGyeJ4UH6ToFK7Nt6mZGkKrr1LTKULwN1fXLXkjRUgprY2yfy7euX7VMtpUEEPaxblwFqiHHmH4SjbtcQkFxlulHR8ECILwwc4NLf9FMSHC5YLz56OWi2eRrYbK2sbTqQ2FxOO76wm0WTWj6ekDFAFSL8vFx0OVjwVq8otz3mOY/B7F1IhOIodG/5yiU4SU0cgcpJUx+7jWH+loa1lNWwoGI7VpVMLlfCLFXk6oonbxeZ7g76TopL6zWIK5PbnSMLSva+3KBr3XO1rQ9tFMNrOZyzyKAC9hhNjLA/FFigBgD+NSuDmzrQrV9zo2rNhPMVU8Jpy8BFkIfu6kc64aQxFSIprhuDcIfhOy8A3tG5rX0uaCQlELiVYxc/7xnpQ3U3SW0frr3W0tzi6DMxIV4yc128Ps48U+mZErT4rXVXi7sPQAHFFWmTUT79q2hyIUCnojsVFTu+gsbdRUik7R2nyTmqnTqzL3csGdu30pVDrjZ3s/RhFSILp/1r4W/32ix97Rta51K20uOBxGINFEeVl0/X511HZ1tNCWej1a8M9QTJy/rF2eNUx/NmpHv4NI3zsckinzv1A559IpFAH6CY+Fxji/rnUSoDMSH0b4Ts5PoZR6pmvCjo0UUydas9YeXv/DxWOs0dL5OU0gP4zRO7gxH+7a0HzJlnWtvbS5KGJ4HMFdtZCbmrrFry7LeH3Ltri4k49E57LCUN3UvX7VTtqUSJ3rm+8JVPg/0Wit0dq534X9isZwMcrp5Z6g+EKjv165Zns7RSgwV6/mgBdVz140Qwh2NkW3RBNE9c8EnFpKuzmhnZD89VPqFryVIiSRNlpp1Rpk/L8v1uXGhxtSUYsDTjKk5feohGgOQnWooHXx+9bMPMONl4oZeDkzdM8w77s0pb/tDiHFx6tmXfZmipB2dneR5fwGSgBgac4ucnbSRaO+Qa3U6lp/R5th5mmKTvFk2UJqQsJks8FDATNv7lzfvOjZH962jzYXXU5FLWZQSRZXRy3zqbp+0fsE43VR27g87bFW16VlUouuttafG6PX2uLR7nfsYdeR5+HBryN6UDLTYps4eQdMM7FhSsu2xygCJAAf2T63oUF6fv+lx67svw/qDYJHOjfd8UeKaWYk599y7fcT8T3vozPOumwCxcLCIFzBRc+xQOmHtNZnP7up9R3d61c9Qu8qmdhdflxOjzAyLu7w8uXk+sYyxr2VUTv6Pu03Sg9uyWaDX3VtWJ2qtS+1ZNf4noym+Bdam5KP1kbPi4Ej+J6Ub6msnX8hRUgx5fm4HL2o0AktNMHMiH7GVbur3qeNqaToVD9CMnYPNYHxr7p4ZVo2CFkY+B+nWFDRCnIuPT+TxhazmzTjc7rbVr2jY/2q+2hzyeU2UislDjYJkvQX+l4trrbf4gkUo+nkhYs7ePsVXW0fUrXT7bxv1bYgCPpOOES0cm+hQylH3XLCzMXjKUIKGS/zuwlNf/sJRSgCKYVAJ7SwRnwc9F4cpY2ugHLluGq/CFPO9Lcppt6OB1Y+qrV+yMXbfBQX86hZWNxw7E/yp382Y71Dh+p2Y4JTbTE7u3Pdyk30bmfkNlLL+y9Z6duRkb7tEEvRgSgaJYvQphKQ9JhfVWfOP0EIec3Bg230GIna9NR14rkbBOH3uje2bqaYKqPCsuvtr2S37cRKY488pXweHnxuDGSYmdxTbqJZsyGlslzcTk0oluiuBCisEfyIp7176cmC89lRu6+gtaHvHQ5QRm98auMdOyiCZQS7WzMdnTeO/rO/MTf6PvaQ+6rK2sbTKRYOF7bP1z9o4Mr3Hkf29/WcffrcyzV/d8fYZ2Z0bGi+qn1d61/o3c7JbRc34Kba6MlxOHpXURjlObMjjTt7WOorKIr9O4z43kgOr4PjpnylPdSOitp9T06r7x0DHGlbMdl/Pss9cw3F1Nm28ZY99kV8fdSORtGjw06pfyeHs/X2wso5l76WIqSI8bwnJo6t+i5FKJK+y2ksilAA9qA7/J+vySw4uJvuv/ap+L+r6DhxEG3qW0HA9zguPT5MaNR3Pc8Lo2Osjk5D9PX0+tGHlET0vBHSL/i68PbZ2ff8DJUK+zbAoKLnRPQ6itr257Zfa3W/UebKUJl/3HH/ikmd61d9pH1j0/1xmFk8p8Ii7M32vQj6nowkah/U90FFgyV9Rir6nUWjZFJyefB3Se8qGh3m/7LTyjMui87+vT9qR+cmB+68o+9xINpcEvZLW13MxahdVNWxb7U95GyJfhfRxFGl/p0czjDuce6toggpklX8Vr58MzpCxebelZKJM9zbPaJ5KjIeP7TOaKn219G/exBtYkLI3t59vSVZPsRlu9a17g0CtTb6WXlSegePsxH6kJLxpGiomDm/imJh2C5g1M+1ta0T33Op2R9ANDvnHq3N06HWf1Ha/MruDNrsj+dObtgSu/udy4LwhB33rxzTsb75rPa2phVdbU1/sH+1pCdBhir1v2gAACi8PVee8h3Zs/9DFJ1kpNf1nOg9YUbT0wdoEwAAAMRAQS4BBQAAiJsebVagoAUAAIgfFLUAAJB6WsiAM3EnRQAAAIgRFLUAAJB6gdKrJ7du2UsRAAAAYgRFLQAApJvwWGjMrZQAAAAgZlDUAgBAqimtv1u5Zns7RQAAAIgZFLUAAJBenLOsEBilBQAAiDEUtQAAkFrKmLaKlq0PUwQAAIAYQlELAACplZXeTdQEAACAmEJRCwAAqaSF+G1F89afUgQAAICYQlELAACFx+nRIQH3VlITAAAAYgxFLQAApI6R8vGJ42vWUgQAAIAYQ1ELAABFwJ0aq80aditfvjmkCAAAADGGohYAAFLFCL5nv8zeTREAAABiDkUtAACkSq9iK2c0PX2AIgAAAMQciloAAEgNzXiPGV3WRBEAAAASAEUtAACkRmj0nRW3/W0fRQAAAEgAFLUAAJAK2ggd+uw2igAAAJAQKGoBACAVjFBrp6x6cidFAAAASAgUtQAAkHycMy39WykBAABAgqCoBQCAxNNMr5+wausjFAEAACBBUNQCAEDiac9fRU0AAABIGBS1AACQaEaIR8Y1bV1PEQAAABIGRS0AACRalnu3c1vbUgQAAICEQVELAABFYEpSVBrBt04cX7OWIgAAACQQiloAAEisrDK38+WbQ4oAAACQQChqAQAgkQzne/Zn1N0UAQAAIKFQ1AIAQCId0GzljKanD1AEAACAhEJRCwAAiaMZ7xXCwzI+AAAAKYCiFgAAEidr9Fcmt27ZSxEAAAASDEUtAAAki/CYMv5KSgAAAJBwKGoBACBRAhV+p3LN1i0UAQAAIOFQ1AIAQOEVa5VazlnAzK2UAAAAIAVQ1AIAQOGZ4pS1gdHrp9zx5CMUAQAAIAVQ1AIAQBFoeiwszX3MeAwAAJAyKGoBACARtOAPT2zdup4iAAAApASKWgAASISAidt58e7eBQAAAEegqAUAgNhTzDwzccL071EEAACAFEFRCwAAhcdNQUdQezW7lS/fHFIEAACAFEFRCwAAhVfAeaKMNrt6yvS/UQQAAICUQVELAACx1svYqhlNTx+gCAAAACmDohYAAGJLG/OCOW4UlvEBAABIMRS1AAAQW1nG7q647W/7KAIAAEAKoagFAICC0wWYKEoboVXGX0kRAAAAUgpFLQAAxJKtaddWNm3dQhEAAABSCkUtAADEUuAJjNICAAAAiloAAIgfxczPJjc9/muKAAAAkGIoagEAoPDyvE5t6JfdQk0AAABIORS1AAAQK1rK301seuwBigAAAJByKGoBAKDwOMvb7McBk7dxlr/PBwAAAPGGohYAAGJDMbZj4viatRQBAAAAUNQCAEAx5Gdg9YDht/Llm0OKAAAAAChqAQAgHgzne7KZ8C6KAAAAAH1Q1AIAQCwcMGzNjKanD1AEAAAA6IOiFgAAnKcZz2rBmykCAAAAHIKiFgAACs+M7KbaHqa/UtXyeAdFAAAAgENQ1AIAQBFoehwGzpnx/RWUAAAAAF4CRS0AADgtMPoHlU1bt1AEAAAAeAkUtQAA4LQeWXYTNQEAAABeBkUtAAA4K2Rmc3XzY7+iCAAAAPAyKGoBAMBZWVl+CzUBAAAAjghFLQAAOMn43hMVzY+uowgAAABwRChqAQDASb3MXM+jxYAAAAAAjgJFLQAAOEcxtnPS2OnfoAgAAAAwKBS1AADgnCzjq/jyzSFFAAAAgEGhqAUAAKcYzvd40txFEQAAAOCoUNQCAEDhccGpdUxZw9ZMaN6+myIAAADAUaGoBQAAZ2jGewPBmykCAAAAHBOKWgAAcEaW6a9WtTzeQREAAADgmFDUAgCAGzhnWngrKQEAAADkBEUtAAAUwbFvqQ25/sGUlm2PUQQAAADICYpaAAAoPH7sqjb0y26iJgAAAEDOUNQCAEDJac5+PXnFY7+iCAAAAJAzFLUAAFByWS9zMzUBAAAAhgRFLQAAFMHgVx8bz3t8UtNj36cIAAAAMCQoagEAoPDM4FXtC5p/3r7TUAQAAAAYEhS1AABQeOLIhxvFvY4pE6Z+gyIAAADAkKGoBQCAknnB8FV8+eaQIgAAAMCQoagFAICCM8a87PJj45X39MjjvkgRAAAAYFhQ1AIAQMFxzl92z+z+UDef2PyH3RQBAAAAhgVFLQAAFIGmRyI81uPJZkoAAAAAw4aiFgAACs+Yl4zUvqD0116x6q87KQIAAAAMG4paAAAoOGEGLNnDOcsydhMlAAAAgBFBUQsAAAXHjTpU1PZq/f1pdzz+KEUAAACAEUFRCwAABaf5i5cfByJzCzUBAAAARgxFLQAAFNzBilYL8+uq1i2/pAgAAAAwYihqAQCg4DSTfcebbMa7uW8DAAAAQJ6gqAUAgILjZaNGsXEV+ybdvu37tAkAAAAgL1DUAgBAwcnRY49/gatl/MUrkQEAAADyAkUtAAAUXKCyj/VMKPsiRQAAAAAAAID42PGFf6ygJgAAAAAAAAAAAAAAMMbY/wek7ZrHUH/x4gAAAABJRU5ErkJggg=="
                    alt="Fixlab Logo" />
            </div>
            <div class="company-info">
                <h1>
                    Fixlab by
                    <span style="font-size: 12px; color: rgb(129, 129, 129);">
                        PT.Jaringan Pintar Nusantara
                    </span>
                </h1>
                <div class="address">
                    Jl. Btn Cijujung Permai No.11 Blok Y, Cijujung, Kec. Sukaraja, Kabupaten Bogor, Jawa Barat 16710<br>
                    Telepon: 0859-1066-87035 | Email: support@fixlab.id
                </div>
            </div>
            <div class="badge-section">
                <div class="badge">LAPORAN UPDATE</div>
                <div class="service-id">#{{ $service->id }}</div>
            </div>
        </div>

        <!-- Body -->
        <div class="body">
            <!-- Status & Meta Info -->
            <div class="card">
                <div class="card-title">Status Service</div>
                <div>
                    <div class="status-badge status-{{ strtolower($service->serviceStatus) }}">
                        {{ $service->serviceStatus }}
                    </div>
                </div>
                <table class="info-table">
                    <tr>
                        <td class="label">Update Terakhir</td>
                        <td class="value">{{ $service->updated_at->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor Referensi</td>
                        <td class="value">#{{ $service->id }}</td>
                    </tr>
                </table>
            </div>

            <!-- Info Grid -->
            <div class="grid-row">
                <div class="grid-col">
                    <!-- Customer Data -->
                    <div class="card">
                        <div class="card-title">Data Pelanggan</div>
                        <table class="info-table">
                            <tr>
                                <td class="label">Nama</td>
                                <td class="value">{{ $service->customer->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">No. HP</td>
                                <td class="value">{{ $service->customer->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Email</td>
                                <td class="value">{{ $service->customer->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Alamat</td>
                                <td class="value">{{ $service->customer->address ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="grid-col">
                    <!-- Device Data -->
                    <div class="card">
                        <div class="card-title">Data Perangkat</div>
                        <table class="info-table">
                            <tr>
                                <td class="label">Model</td>
                                <td class="value">{{ $service->Model ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">IMEI/SN</td>
                                <td class="value">{{ $service->IMEI ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Keluhan</td>
                                <td class="value">{{ $service->Keluhan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Kondisi Awal</td>
                                <td class="value">{{ Str::limit($service->Kondisi ?? '-', 50) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Diagnosis Section -->
            <div class="card">
                <div class="card-title">Diagnosa & Penyelesaian</div>
                <table class="info-table">
                    <tr>
                        <td class="label">Penyebab Masalah</td>
                        <td class="value">{{ $service->penyebab ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Deskripsi Kerusakan</td>
                        <td class="value">{{ $service->kerusakan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Penyelesaian</td>
                        <td class="value">{{ $service->penyelesaian ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Part/Material Digunakan</td>
                        <td class="value">{{ $service->partUsed ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Photo Section -->
            @php
                $media = $service->media ? $service->media->first() : null;
                $hasFoto = $media && $media->hasil && count($media->hasil) > 0;
            @endphp
            @if ($hasFoto)
                <div class="foto-section">
                    <div class="card-title">Foto Kondisi Akhir</div>
                    <div class="foto-grid">
                        @foreach ($media->hasil as $foto)
                            @php
                                $imagePath = storage_path('app/public') . '/' . $foto;
                            @endphp
                            @if (file_exists($imagePath))
                                <div class="foto-item">
                                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($imagePath)) }}"
                                        alt="Foto kondisi akhir">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Terms Section -->
            <div class="terms">
                <strong>Catatan Penting</strong>
                <div style="line-height: 1.5; margin-top: 6px;">
                    • Laporan ini adalah bukti sah layanan perbaikan yang telah dilakukan<br>
                    • Garansi berlaku 7 hari untuk layanan yang sama karakternya<br>
                    • Hasil perbaikan sudah diuji dan dinyatakan normal<br>
                    • Klaim kerusakan hanya berlaku jika disertakan bukti asli<br>
                    • Terima kasih atas kepercayaan Anda kepada Fixlab
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <strong>Fixlab</strong> • Telepon: 0859-1066-87035 | Email: support@fixlab.id
        </div>
    </div>

</body>

</html>
