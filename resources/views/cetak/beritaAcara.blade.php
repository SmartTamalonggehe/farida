<!DOCTYPE html>
<html lang="en">

@include('cetak.head')

{{-- use carbon --}}
@php
    use Carbon\Carbon;
    $prodi_id = $BA->jadwal->prodi->id;
@endphp

<body>
    {{-- <img src="{{ asset('uogp.png') }}" alt="" srcset="" class="img float-left"> --}}
    <img src="{{ public_path('uogp.png') }}" class="float-left img" alt="" srcset="">
    <div class="text-center">
        <h2 class="mt-1">UNIVERSITAS OTTOW GEISSLER PAPUA</h2>
        <h2 class="mt-1">PROGRAM STUDI SISTEM INFORMASI</h2>
        <h4 class="mt-1">Jln. Perkutut Kotaraja 99225 Jayapura - Papua Tlp.(0967)581562 Fax(0967)581133
        </h4>
    </div>
    <hr class="garis_surat mt-2">
    <hr>
    <h3 class="mt-1 text-center">BERITA ACARA</h3>
    <table class="mt-2">
        <tr>
            <td style="width: 100px">DOSEN</td>
            <td>:</td>
            <td>{{ $BA->jadwal->dosen->nama }}</td>
        </tr>
        <tr>
            <td>KODE MK</td>
            <td>:</td>
            <td>{{ $BA->jadwal->matkul->kode }}</td>
        </tr>
        <tr>
            <td>MATA KULIAH</td>
            <td>:</td>
            <td>{{ $BA->jadwal->matkul->nama }}</td>
        </tr>
        <tr>
            <td>SKS/SMT</td>
            <td>:</td>
            <td>{{ $BA->jadwal->matkul->sks }} / {{ $BA->jadwal->semester }}</td>
        </tr>
        <tr>
            <td>RUANGAN</td>
            <td>:</td>
            <td>{{ $BA->jadwal->ruangan->kode }}</td>
        </tr>
    </table>
    {{-- table --}}
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>NO</th>
                <th>HARI/TGL</th>
                <th>MATERI KULIAH</th>
                <th>JMLH MHS</th>
                <th>FOTO</th>
                <th>PARAF MHS</th>
                <th>PARAF DOSEN</th>
                <th>PARAF PEMERIKSA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Carbon::parse($item->tgl)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $item->materi }}</td>
                    <td>{{ $item->jmlh_mhs }}</td>
                    <td>
                        <img src="{{ public_path($item->foto) }}" alt="" srcset="" class="img">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="width: 600px; margin: 5rem auto">
        <h3 class="text-center">Mengetahui</h3>
        <div class="mt-4">
            {{-- ttd dekan --}}
            <div class="float-left">
                <p class="text-center" style="margin-bottom: 50px">Dekan</p>
                <p>Fegie Y Wattimena, ST., M,Kom</p>
            </div>
            <div class="float-right">
                <p class="text-center" style="margin-bottom: 50px">Ketua Prodi</p>
                {{-- 1 = Axelon Samuel Renyaan, S.SI., MT --}}
                {{-- 2 = Inggrid Nortalia Kailola, M.Si	 --}}
                {{-- 3 = Doodle Dandy Waromi, S.T., M.T --}}
                @if ($prodi_id == 1)
                    <p>Axelon Samuel Renyaan, S.SI., MT</p>
                @elseif ($prodi_id == 2)
                    <p>Inggrid Nortalia Kailola, M.Si</p>
                @else
                    <p>Doodle Dandy Waromi, S.T., M.T</p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
