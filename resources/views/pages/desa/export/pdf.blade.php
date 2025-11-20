<!DOCTYPE html>
<html>

<head>
    <title>Export Data SDGs Desa</title>
    <style>
        body {
            font-family: Arial;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        th {
            width: 10%;
            font-weight: normal;
        }

        td {
            width: 90%
        }

        h2 {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <table class="table table-bordered table-sm">
        {{-- DESA P2 --}}
        <tr>
            <th><b>P2</b></th>
            <td style="width: 90% !important;"><b>DESKRIPSI LOKASI</b></td>
        </tr>
        <tr>
            <th>P201</th>
            <td>Provinsi: {{ $p2->kode_provinsi ?? '-' }}</td>
        </tr>
        <tr>
            <th>P202</th>
            <td>Kabupaten: {{ $p2->kode_kabupaten ?? '-' }}</td>
        </tr>
        <tr>
            <th>P203</th>
            <td>Kecamatan: {{ $p2->kode_kecamatan ?? '-' }}</td>
        </tr>
        <tr>
            <th>P204</th>
            <td>Desa: {{ $p2->kode_desa ?? '-' }}</td>
        </tr>
        <tr>
            <th>P205</th>
            <td>Email Desa: {{ $p2->email ?? '-' }}</td>
        </tr>
        <tr>
            <th>P206</th>
            <td>Alamat Web Desa: {{ $p2->url_web ?? '-' }}</td>
        </tr>
        <tr>
            <th>P207</th>
            <td>Alamat Facebook Desa: {{ $p2->url_facebook ?? '-' }}</td>
        </tr>
        <tr>
            <th>P208</th>
            <td>Alamat Twitter Desa: {{ $p2->url_twitter ?? '-' }}</td>
        </tr>
        <tr>
            <th>P209</th>
            <td>Alamat Instagram Desa: {{ $p2->url_instagram ?? '-' }}</td>
        </tr>
        <tr>
            <th>P210</th>
            <td>Alamat YouTube Desa: {{ $p2->url_youtube ?? '-' }}</td>
        </tr>
        <tr>
            <th>P211</th>
            <td>Status Pemerintahan: {{ $p2->status_pemerintahan ?? '-' }}</td>
        </tr>
        <tr>
            <th>P212</th>
            <td>Jumlah RW (tulis angka): {{ $p2->jml_rw ?? '-' }}</td>
        </tr>
        <tr>
            <th>P213</th>
            <td>Jumlah RT (tulis angka): {{ $p2->jml_rt ?? '-' }}</td>
        </tr>
        <tr>
            <th>P214</th>
            <td>SK Pendirian Desa: {{ $p2->no_sk_pendirian_desa ?? '-' }}</td>
        </tr>
        <tr>
            <th>P215</th>
            <td>SK Bupati/Walikota atau Gubernur tentang Peta Desa:
                {{ $p2->no_sk_peta_desa ?? '-' }}</td>
        </tr>
        <tr>
            <th>P216</th>
            <td>Luas Wilayah (Ha): {{ $p2->luas_wilayah ?? '-' }}</td>
        </tr>
        <tr>
            <th>P217</th>
            <td>Lokasi Desa terletak di pulau (sebutkan nama pulau): {{ $p2->lokasi_desa ?? '-' }}
            </td>
        </tr>
        <tr>
            <th>P218</th>
            <td>Topografi terluas wilayah desa: {{ $p2->topografi ?? '-' }}</td>
        </tr>
        <tr>
            <th>P219</th>
            <td>Jumlah warga di lereng/puncak (jiwa): {{ $p2->jml_warga ?? '-' }}</td>
        </tr>
        <tr>
            <th>P220</th>
            <td>Kantor kepala desa/balai desa: {{ $p2->balai_desa ?? '-' }}</td>
        </tr>
        <tr>
            <th>P221</th>
            <td>Kepemilikan kantor kepala desa/balai desa: {{ $p2->kepemilikan ?? '-' }}</td>
        </tr>
        <tr>
            <th>P222</th>
            <td>Lokasi kantor kepala desa/balai desa: {{ $p2->lokasi_balai_desa ?? '-' }}</td>
        </tr>
        <tr>
            <th>P223</th>
            <td>Penyelenggaraan pemerintahan desa utamanya dilaksanakan di :
                {{ $p2->tempat_pemerintah_desa ?? '-' }}</td>
        </tr>
        <tr>
            <th>P224</th>
            <td>Jam kerja di kantor desa : {{ $p2->jam_kerja ?? '-' }} <br>
                Jam Mulai: {{ $p2->mulai_pukul ?? '-' }} <br>
                Jam Akhir: {{ $p2->akhir_pukul ?? '-' }}
            </td>
        </tr>
        <tr>
            <th>P225</th>
            <td>Koordinat lokasi kegiatan pemerintahan desa <br>
                1.Koordinat Garis Lintang (latitude) {{ $p2->lintang ?? '-' }} <br>
                2.Lintang : <br>
                3.Garis bujur (longitude) Timur {{ $p2->bujur }}
            </td>
        </tr>
        <tr>
            <th>P226</th>
            <td>Ketinggian lokasi kegiatan pemerintahan desa dari permukaan air laut (DPAL) :
                {{ $p2->ketinggian_lok ?? '-' }} meter</td>
        </tr>
        <tr>
            <th>P227</th>
            <td>Panjang garis pantai (km) :
                {{ $p2->pjg_garis_pantai ?? '-' }} Km</td>
        </tr>
        {{-- END DESA P2 --}}
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>
        @if ($p3)
            <tr>
                <th><b>P3</b></th>
                <td style="width: 90% !important;"><b>DESKRIPSI PEMERINTAHAN DESA</b></td>
            </tr>
            <tr>
                <th>P301</th>
                <td>Nama kepala desa (dan foto): {{ $p3->nama_kades ?? '-' }}</td>
            </tr>
            <tr>
                <th>P302</th>
                <td>NIK kepala desa: {{ $p3->nik_kades ?? '-' }}</td>
            </tr>
            <tr>
                <th>P303</th>
                <td>Nomor HP: {{ $p3->hp_kades ?? '-' }}</td>
            </tr>
            <tr>
                <th>P304</th>
                <td>Menjabat kepala desa sejak tahun: {{ $p3->awal_jabatan_kades ?? '-' }}</td>
            </tr>
            <tr>
                <th>P305</th>
                <td>Nama sekretaris desa: {{ $p3->nama_sekdes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P306</th>
                <td>NIK sekretaris desa: {{ $p3->nik_sekdes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P307</th>
                <td>Nomor HP: {{ $p3->hp_sekdes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P308</th>
                <td>Menjabat sekretaris desa sejak tahun: {{ $p3->awal_jabatan_sekdes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P309</th>
                <td>Nama bendahara desa: {{ $p3->nama_bendes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P310</th>
                <td>NIK bendahara desa: {{ $p3->nik_bendes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P311</th>
                <td>Nomor HP: {{ $p3->hp_bendes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P312</th>
                <td>Menjabat bendahara desa sejak tahun: {{ $p3->awal_jabatan_bendes ?? '-' }}</td>
            </tr>
            <tr>
                <th>P313</th>
                <td>Nama kepala urusan tata usaha: {{ $p3->nama_kpl_tu ?? '-' }}</td>
            </tr>
            <tr>
                <th>P314</th>
                <td>NIK kepala urusan tata usaha: {{ $p3->nik_kpl_tu ?? '-' }}</td>
            </tr>
            <tr>
                <th>P315</th>
                <td>Nomor HP: {{ $p3->hp_kpl_tu ?? '-' }}</td>
            </tr>
            <tr>
                <th>P316</th>
                <td>Menjabat kepala urusan tata usaha sejak tahun: {{ $p3->awal_jabatan_kpl_tu ?? '-' }}</td>
            </tr>
            <tr>
                <th>P317</th>
                <td>Nama kepala urusan keuangan: {{ $p3->nama_kpl_uang ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P318</th>
                <td>NIK kepala urusan keuangan: {{ $p3->nik_kpl_uang ?? '-' }}</td>
            </tr>
            <tr>
                <th>P319</th>
                <td>Nomor HP: {{ $p3->hp_kpl_uang ?? '-' }}</td>
            </tr>
            <tr>
                <th>P320</th>
                <td>Menjabat kepala urusan keuangan sejak tahun: {{ $p3->awal_jabatan_kpl_uang ?? '-' }}</td>
            </tr>
            <tr>
                <th>P321</th>
                <td>Nama kepala urusan perencanaan: {{ $p3->nama_kpl_rencana ?? '-' }}</td>
            </tr>
            <tr>
                <th>P322</th>
                <td>NIK kepala urusan perencanaan: {{ $p3->nik_kpl_rencana ?? '-' }}</td>
            </tr>
            <tr>
                <th>P323</th>
                <td>Nomor HP: {{ $p3->hp_kpl_rencana ?? '-' }}</td>
            </tr>
            <tr>
                <th>P324</th>
                <td>Menjabat kepala urusan perencanaan sejak tahun: {{ $p3->awal_jabatan_kpl_rencana ?? '-' }}</td>
            </tr>
            <tr>
                <th>P325</th>
                <td>Nama kepala seksi pemerintahan: {{ $p3->nama_kepsek_pemerintahan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P326</th>
                <td>NIK kepala seksi pemerintahan: {{ $p3->nik_kepsek_pemerintahan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P327</th>
                <td>Nomor HP: {{ $p3->hp_kepsek_pemerintahan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P328</th>
                <td>Menjabat kepala seksi pemerintahan sejak tahun: {{ $p3->awal_jabatan_kepsek_pemerintahan ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P329</th>
                <td>Nama kepala seksi kesejahteraan: {{ $p3->nama_kepsek_kesejahteraan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P330</th>
                <td>NIK kepala seksi kesejahteraan: {{ $p3->nik_kepsek_kesejahteraan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P331</th>
                <td>Nomor HP: {{ $p3->hp_kepsek_kesejahteraan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P332</th>
                <td>Menjabat kepala seksi kesejahteraan sejak tahun:
                    {{ $p3->awal_jabatan_kepsek_kesejahteraan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P333</th>
                <td>Nama kepala seksi pelayanan: {{ $p3->nama_kepsek_pelayanan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P334</th>
                <td>NIK kepala seksi pelayanan: {{ $p3->nik_kepsek_pelayanan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P335</th>
                <td>Nomor HP: {{ $p3->hp_kepsek_pelayanan ?? '-' }}</td>
            </tr>
            <tr>
                <th>P336</th>
                <td>Menjabat kepala seksi pelayanan sejak tahun: {{ $p3->awal_jabatan_kepsek_pelayanan ?? '-' }}</td>
            </tr>
        @endif
        @if ($pegawai->count())
            @foreach ($pegawai as $p)
                <tr>
                    <th>P337</th>
                    <td>Nama pegawai desa lainnya {{ $p->pegawai_ke }}: {{ $p->nama_pegawai_desa ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P338</th>
                    <td>NIK pegawai desa lainnya {{ $p->pegawai_ke }}: {{ $p->nik_pegawai_desa ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P339</th>
                    <td>Nomor HP: {{ $p->hp_pegawai_desa ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P340</th>
                    <td>Menjabat pegawai desa lainnya sejak tahun {{ $p->pegawai_ke }}:
                        {{ $p->awal_jabatan_pegawai_desa ?? '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <th>P357</th>
                <td style="text-align: center">
                    Tidak ada data Anggota Pegawai Lainnya.
                </td>
            </tr>
        @endif
        @if ($bpd->count())
            @foreach ($bpd as $p)
                <tr>
                    <th>P357</th>
                    <td>Nama anggota Badan Permusyawaratan Desa (BPD){{ $p->anggota_ke }}:
                        {{ $p->nama_anggota_bpd ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P358</th>
                    <td>NIK anggota Badan Permusyawaratan Desa (BPD) {{ $p->anggota_ke }}:
                        {{ $p->nik_anggota_bpd ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P359</th>
                    <td>Nomor HP: {{ $p->hp_anggota_bpd ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P360</th>
                    <td>Menjabat anggota Badan Permusyawaratan Desa (BPD) sejak tahun {{ $p->anggota_ke }}:
                        {{ $p->awal_jabatan_anggota_bpd ?? '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <th>P357</th>
                <td style="text-align: center">
                    Tidak ada data Anggota BPD.
                </td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>
        <tr>
            <th><b>P4</b></th>
            <td style="width: 90% !important;"><b>MUSYAWARAH DESA</b></td>
        </tr>
        @if ($p4->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P401</th>
                <td>
                    Musyawarah desa tahun sebelumnya <br>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Bulan Ke (tulis angka)</th>
                            <th>Agenda Musyawarah</th>
                            <th>Dokumen Musyawarah</th>
                        </tr>

                        @foreach ($p4 as $loopItem)
                            <tr>
                                <td style="width: 5% !important">{{ $loop->iteration }}</td>
                                <td style="width: 15% !important">{{ $loopItem->bulan_ke ?? '-' }}</td>
                                <td style="width: 30% !important">{!! base64_decode($loopItem->agenda_musyawarah ?? '') !!}</td>
                                <td style="width: 50% !important">Dokumen Musyawarah</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P401</th>
                <td style="text-align: center">
                    Tidak ada data P4.
                </td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>

        <tr>
            <th><b>P5</b></th>
            <td style="width: 90% !important;"><b>REGULASI DESA</b></td>
        </tr>
        @if ($p501->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P501</th>
                <td>
                    Peraturan Desa tahun sebelumnya <br>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nomor Dokumen</th>
                            <th>Bulan (tulis angka)</th>
                            {{-- <th>Dokumen Musyawarah</th> --}}
                            <th>Tentang</th>
                        </tr>

                        @foreach ($p501 as $loopItem)
                            <tr>
                                <td style="width: 5% !important">{{ $loop->iteration }}</td>
                                <td style="width: 20% !important">{{ $loopItem->no_dokumen ?? '-' }}</td>
                                <td style="width: 10% !important">{{ $loopItem->bulan ?? '-' }}</td>
                                {{-- <td style="width: 25% !important">Dokumen Musyawarah</td> --}}
                                <td style="width: 65% !important">{{ $loopItem->tentang ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P503</th>
                <td style="text-align: center">
                    Tidak ada data P501.
                </td>
            </tr>
        @endif
        @if ($p502->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P502</th>
                <td>
                    Peraturan Kepala Desa tahun sebelumnya <br>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nomor Dokumen</th>
                            <th>Bulan (tulis angka)</th>
                            {{-- <th>Dokumen Musyawarah</th> --}}
                            <th>Tentang</th>
                        </tr>

                        @foreach ($p502 as $loopItem)
                            <tr>
                                <td style="width: 5% !important">{{ $loop->iteration }}</td>
                                <td style="width: 20% !important">{{ $loopItem->no_dokumen ?? '-' }}</td>
                                <td style="width: 10% !important">{{ $loopItem->bulan ?? '-' }}</td>
                                {{-- <td style="width: 25% !important">Dokumen Musyawarah</td> --}}
                                <td style="width: 65% !important">{{ $loopItem->tentang ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P503</th>
                <td style="text-align: center">
                    Tidak ada data P502.
                </td>
            </tr>
        @endif
        @if ($p503->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P503</th>
                <td>
                    SK Kepala Desa tahun sebelumnya <br>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nomor Dokumen</th>
                            <th>Bulan (tulis angka)</th>
                            {{-- <th>Dokumen Musyawarah</th> --}}
                            <th>Tentang</th>
                        </tr>

                        @foreach ($p503 as $loopItem)
                            <tr>
                                <td style="width: 5% !important">{{ $loop->iteration }}</td>
                                <td style="width: 20% !important">{{ $loopItem->no_dokumen ?? '-' }}</td>
                                <td style="width: 10% !important">{{ $loopItem->bulan ?? '-' }}</td>
                                {{-- <td style="width: 25% !important">Dokumen Musyawarah</td> --}}
                                <td style="width: 65% !important">{{ $loopItem->tentang ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P503</th>
                <td style="text-align: center">
                    Tidak ada data P503.
                </td>
            </tr>
        @endif
        @if ($p5->count())
            <tr>
                <th>P504</th>
                <td>RPJM Desa berlaku sampai tahun: {{ $p5->rpjm_berlaku ?? '-' }}</td>
            </tr>
            <tr>
                <th>P505</th>
                <td>RKP Desa: {{ $p5->rkp_desa ?? '-' }}</td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>

        <tr>
            <th><b>P6</b></th>
            <td style="width: 90% !important;"><b>APBDesa DAN ASET DESA</b></td>
        </tr>
        @if ($p601->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P601</th>
                <td>Anggaran pendapatan desa tahun sebelumnya
                    <table>
                        <tr>
                            <th style="width: 70% !important">Anggaran Pendapatan</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p601->anggaran_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">1. Dana Desa bersumber dari APBN</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->apbn, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">2. Pendapatan Asli Desa (PADes)</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->pades, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">3. Bagian dari hasil pajak daerah dan retribusi daerah
                            </th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->pajak_daerah, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">4. Alokasi Dana Desa (bagian dari dana perimbangan yang
                                diterima kabupaten/kota)</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p601->alokasi_dana_desa, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">5. Bantuan keuangan dari APBD Provinsi</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->apbd_prov, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">6. Bantuan keuangan dari APBD Kabupaten/kota</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->apbd_kab, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">7. Hibah dan sumbangan dari pihak ketiga</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->hibah, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">8. Lain–lain pendapatan desa yang sah</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p601->lain_lain, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>
        @else
            <tr>
                <th>P601</th>
                <td style="text-align: center">
                    Tidak ada data P601.
                </td>
            </tr>
        @endif
        @if ($p602->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P602</th>
                <td>Anggaran pembelanjaan desa tahun sebelumnya
                    <table>
                        <tr>
                            <th style="width: 70% !important">Anggaran Pengeluaran</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p602->anggaran_pengeluaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">1. Bidang penyelenggaraan pemerintahan desa</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p602->penyelenggaraan_desa, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">2. Bidang pelaksanaan pembangunan desa</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p602->pembangunan_desa, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">3. Bidang pemberdayaan masyarakat</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p602->pemberdayaan_desa, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">4. Bidang pembinaan kemasyarakatan</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p602->bina_masyarakat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">5. Belanja Modal (tanah, bangunan, jalan, jembatan,
                                komputer, dll.)</th>
                            <td style="width: 30% !important">
                                Rp.{{ number_format($p602->belanja_modal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">6. Penyertaan modal ke BUMDes</th>
                            <td style="width: 30% !important">Rp.{{ number_format($p602->bumdes, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th style="width: 70% !important">7. Lainnya (belanja tak terduga, konsumsi rapat, dll.)
                            </th>
                            <td style="width: 30% !important">Rp.{{ number_format($p602->lainnya, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </td>

            </tr>
        @else
            <tr>
                <th>P602</th>
                <td style="text-align: center">
                    Tidak ada data P602.
                </td>
            </tr>
        @endif
        @if ($p603->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P603</th>
                <td>
                    Nilai aset desa <br>
                    <table>
                        <tr>
                            <th>Aset</th>
                            <th>Volume</th>
                            <th>Satuan Volume</th>
                            <th>Nilai Rp</th>
                        </tr>

                        @foreach ($p603 as $loopItem)
                            <tr>
                                <td style="width: 50% !important">{{ $loopItem->aset }}</td>
                                <td style="width: 10% !important">{{ $loopItem->volume ?? '-' }}</td>
                                <td style="width: 15% !important">{{ $loopItem->satuan_volume ?? '-' }}</td>
                                <td style="width: 25% !important">
                                    Rp.{{ number_format($loopItem->nilai, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P603</th>
                <td style="text-align: center">
                    Tidak ada data P603.
                </td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>

        <tr>
            <th><b>P7</b></th>
            <td style="width: 90% !important;"><b>LAYANAN</b></td>
        </tr>
        @if ($p7->count())
            <tr>
                <th>P701</th>
                <td>
                    1. Komputer/PC/laptop yang masih berfungsi di kantor kepala desa/lurah:
                    {{ $p7->teknologi ?? '-' }} <br>
                    2. Fasilitas internet di kantor kepala desa/lurah: {{ $p7->internet ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P702</th>
                <td>
                    1. Sistem informasi desa: {{ $p7->info_desa ?? '-' }} <br>
                    2. Sistem keuangan desa: {{ $p7->keuangan_desa ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P703</th>
                <td>
                    Jumlah surat terangan tidak mampu/miskin yang dikeluarkan setahun terakhir (jumlah):
                    {{ $p7->srt_tidak_mampu ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P704</th>
                <td>
                    1. Jumlah penduduk yang belum merekam eKTP (jiwa): {{ $p7->blm_ektp ?? '-' }} <br>
                    2. Jumlah penduduk yang belum tercatat di KK (jiwa): {{ $p7->blm_kk ?? '-' }}
                </td>
            </tr>
        @endif
        @if ($p705->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P705</th>
                <td>
                    Kerja sama desa <br>
                    <table>
                        <tr>
                            <th>Pihak yang diajak kerja sama</th>
                            <th>
                                Lingkup kerja sama <br>
                                1. Antardesa <br>
                                2. Dengan pemerintah daerah <br>
                                3. Dengan pemerintah pusat <br>
                                4. Dengan swasta <br>
                                5. Dengan lembaga internasional
                            </th>
                            <th>Tahun kerja sama berakhir</th>
                            <th>Jumlah pemanfaat (jiwa)</th>
                            <th>Nilai kerja sama (Rp)</th>
                        </tr>

                        @foreach ($p705 as $loopItem)
                            <tr>
                                <td style="width: 40% !important">{{ $loopItem->pihak_kerjasama }}</td>
                                <td style="width: 20% !important">{{ $loopItem->lingkup_kerjasama ?? '-' }}</td>
                                <td style="width: 10% !important">{{ $loopItem->akhir_kerjasama ?? '-' }}</td>
                                <td style="width: 10% !important">{{ $loopItem->jml_jiwa ?? '-' }}</td>
                                <td style="width: 20% !important">
                                    Rp.{{ number_format($loopItem->nilai_kerjasama, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P705</th>
                <td style="text-align: center">
                    Tidak ada data P705.
                </td>
            </tr>
        @endif
        @if ($p7->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P706</th>
                <td>
                    1. Nama pendamping desa: {{ $p7->nama_pdesa ?? '-' }} <br>
                    2. Jenis kelamin pendamping desa: {{ $p7->jk_pdesa ?? '-' }} <br>
                    3. No HP pendamping desa: {{ $p7->hp_pdesa ?? '-' }}
                </td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>

        <tr>
            <th><b>P8</b></th>
            <td style="width: 90% !important;"><b>LEMBAGA KEMASYARAKATAN DESA</b></td>
        </tr>
        @if ($p8->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P800</th>
                <td>
                    Jumlah jenis lembaga kemasyarakatan desa <br>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah pengurus (jiwa)</th>
                            <th>Jumlah anggota (jiwa)</th>
                        </tr>

                        @foreach ($p8 as $loopItem)
                            <tr>
                                <td style="width: 40% !important">{{ $loopItem->id_lembaga }}</td>
                                <td style="width: 30% !important">{{ $loopItem->jml_pengurus ?? '-' }}</td>
                                <td style="width: 30% !important">{{ $loopItem->jml_anggota ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P8</th>
                <td style="text-align: center">
                    Tidak ada data P8.
                </td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>

        <tr>
            <th><b>P9</b></th>
            <td style="width: 90% !important;"><b>BADAN USAHA MILIK DESA</b></td>
        </tr>
        @if ($p9->count())
            <tr>
                <th>P901</th>
                <td>
                    Nama Bumdes: {{ $p9->nama_bumdes ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P902</th>
                <td>
                    Email: {{ $p9->email ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P903</th>
                <td>
                    Alamat web: {{ $p9->web_bumdes ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P904</th>
                <td>
                    Alamat Facebook: {{ $p9->fb_bumdes ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P905</th>
                <td>
                    Alamat Twitter: {{ $p9->twitter_bumdes ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P906</th>
                <td>
                    Alamat desa: {{ $p9->alamat_desa ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>P907</th>
                <td>
                    Alamat Youtube: {{ $p9->yt_bumdes ?? '-' }}
                </td>
            </tr>
            <tr>
                <th style="width: 15%; vertical-align: top;">P908</th>
                <td>
                    Modal awal <br>
                    1. dari pemerintah desa (Rp): Rp.{{ number_format($p9->modal_awal, 0, ',', '.') }} <br>
                    2. dari warga desa (Rp): Rp.{{ number_format($p9->modal_awal, 0, ',', '.') }}<br>
                    3. dari pihak lain (Rp): Rp.{{ number_format($p9->modal_awal, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th>P909</th>
                <td>
                    Omset setahun terakhir (Rp): Rp.{{ number_format($p9->omset_setahun, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th>P910</th>
                <td>
                    Keuntungan bersih setahun terakhir (Rp):
                    Rp.{{ number_format($p9->keuntungan_bersih, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th>P911</th>
                <td>
                    Keuntungan kotor belum dikurangi pajak setahun terakhir (Rp):
                    Rp.{{ number_format($p9->keuntungan_kotor, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th>P912</th>
                <td>
                    Nilai aset Bumdes (Rp): Rp.{{ number_format($p9->aset_bumdes, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th>P913</th>
                <td>
                    Sumbangan diberikan kepada PADesa (Rp): Rp.{{ number_format($p9->sumbangan_padesa, 0, ',', '.') }}
                </td>
            </tr>
        @endif
        @if ($p914->count())
            @foreach ($p914 as $p)
                <tr>
                    <th>P914</th>
                    <td>Nama pembina/komisaris {{ $p->komisaris_ke }}:
                        {{ $p->nama_komisaris ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P916</th>
                    <td>NIK:
                        {{ $p->nik_komisaris ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P917</th>
                    <td>No HP: {{ $p->hp_komisaris ?? '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <th>P914</th>
                <td style="text-align: center">
                    Tidak ada data pembina/komisaris.
                </td>
            </tr>
        @endif
        @if ($p923->count())
            @foreach ($p923 as $p)
                <tr>
                    <th>P923</th>
                    <td>Nama pengawas {{ $p->pengawas_ke }}:
                        {{ $p->nama_pengawas ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P924</th>
                    <td>NIK:
                        {{ $p->nik_pengawas ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P925</th>
                    <td>No HP: {{ $p->hp_pengawas ?? '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <th>P923</th>
                <td style="text-align: center">
                    Tidak ada data pengawas.
                </td>
            </tr>
        @endif
        @if ($p932->count())
            @foreach ($p932 as $p)
                <tr>
                    <th>P932</th>
                    <td>Nama direksi {{ $p->direksi_ke }}:
                        {{ $p->nama_direksi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P933</th>
                    <td>NIK:
                        {{ $p->nik_direksi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>P934</th>
                    <td>No HP: {{ $p->hp_direksi ?? '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <th>P932</th>
                <td style="text-align: center">
                    Tidak ada data direksi.
                </td>
            </tr>
        @endif
        @if ($p941->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P941</th>
                <td>
                    Unit usaha Bumdes <br>
                    <table>
                        <tr>
                            <th>Unit usaha</th>
                            <th>Jumlah unit usaha</th>
                            <th>Jumlah pekerja (jiwa)</th>
                            <th>Keuntungan bersih tahun lalu (Rp)</th>
                            <th>Omset tahun lalu (Rp)</th>
                            <th>Aset unit usaha tahun lalu (Rp)</th>
                        </tr>

                        @foreach ($p941 as $loopItem)
                            <tr>
                                <td style="width: 30% !important">{{ $loopItem->unit_usaha_bumdes }}</td>
                                <td style="width: 5% !important">{{ $loopItem->jml_unit_usaha ?? '-' }}</td>
                                <td style="width: 5% !important">{{ $loopItem->jml_pekerja ?? '-' }}</td>
                                <td style="width: 20% !important">
                                    Rp.{{ number_format($loopItem->keuntungan_bersih, 0, ',', '.') }}</td>
                                <td style="width: 20% !important">
                                    Rp.{{ number_format($loopItem->omset_thn_lalu, 0, ',', '.') }}</td>
                                <td style="width: 20% !important">
                                    Rp.{{ number_format($loopItem->aset_thn_lalu, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <tr>
                <th>P941</th>
                <td style="text-align: center">
                    Tidak ada data P941.
                </td>
            </tr>
        @endif
        <tr>
            <th style="padding: 10px !important"></th>
            <td style="padding: 10px !important"></td>
        </tr>

        <tr>
            <th><b>P10</b></th>
            <td style="width: 90% !important;"><b>INFRASTRUKTUR DESA</b></td>
        </tr>
        @if ($p10->count())
            <tr>
                <th style="width: 15%; vertical-align: top;">P1001</th>
                <td>
                    Transportasi dari kantor kepala desa ke kantor camat dan kantor bupati <br>

                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th rowspan="2">Sarana transportasi yang biasa digunakan sebagian besar penduduk
                                </th>
                                <th rowspan="2">Sarana transportasi yang biasa digunakan (kode 1)</th>
                                <th colspan="2">Jika ada angkutan umum</th>
                                <th rowspan="2">Jarak Tempuh (km)</th>
                                <th rowspan="2">Waktu Tempuh (menit)</th>
                                <th rowspan="2">Biaya Transportasi (x Rp 1000)</th>
                            </tr>

                            <tr>
                                <th>Jenis Angkutan Umum (kode 2)</th>
                                <th>Angkutan Umum yang utama (kode 2)</th>
                            </tr>
                        </thead>


                        @php
                            $kantor = [
                                '1. kantor camat',
                                '2. kantor bupati',
                                '3. kantor camat lain terdekat',
                                '4. kantor bupati lain terdekat',
                            ];
                        @endphp

                        <tbody>
                            @foreach ($p10 as $loopItem)
                                <tr>
                                    <td>{{ $loopItem->sarana_yg_digunakan ?? '-' }}</td>
                                    <td>{{ $loopItem->sarana_transportasi ?? '-' }}</td>
                                    <td>{{ $loopItem->angkutan_umum ?? '-' }}</td>
                                    <td>{{ $loopItem->angkutan_umum_utama ?? '-' }}</td>
                                    <td>{{ $loopItem->jarak_tempuh ?? '-' }}</td>
                                    <td>{{ $loopItem->waktu_tempuh ?? '-' }}</td>
                                    <td>Rp.{{ number_format($loopItem->biaya, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table style="margin-top: 10px;">
                        <tr>
                            <td>
                                <b>Kode 1</b> <br>
                                1. angkutan umum <br>
                                2. kendaraan pribadi <br>
                                3. sepeda, becak, bentor, delman <br>
                                4. jalan kaki, dll
                            </td>

                            <td>
                                <b>Kode 2</b> <br>
                                1. Ojek sepeda motor <br>
                                2. kendaraan bermotor roda 3 atau lebih <br>
                                3. perahu (bermotor maupun tidak bermotor) <br>
                                4. Pesawat terbang <br>
                                5. Lainnya (becak, delman, pedati, dll)
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        @else
            <tr>
                <th>P10</th>
                <td style="text-align: center">Tidak ada data P10.</td>
            </tr>
        @endif
    </table>

</body>

</html>
