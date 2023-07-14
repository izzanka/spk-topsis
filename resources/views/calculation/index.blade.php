@extends('layout.app')

@section('content')

<div class="mt-4">
    <div class="card" x-data="{ open: false }">
      <div class="card-body">
        <div class="row" @click="open = ! open" type="button">
            <div class="col-10">
                <b>Nilai Kriteria Tiap Alternatif</b>
            </div>
            <div class="col-2 text-end">
              <i class="bi bi-caret-down-fill"></i>
            </div>
        </div>
        <div x-show="open" x-transition>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            No
                        </th>
                        <th scope="col" class="text-center">
                            Kode
                        </th>
                        <th scope="col" class="text-center">
                            Nama Alternatif
                        </th>
                        @foreach ($kriteria as $k)
                        <th scope="col" class="text-center">
                            {{ $k['name']}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatif_kriteria as $index => $ak)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $ak[0] }}
                            </td>
                            <td class="text-center">
                                {{ $ak[1] }}
                            </td>
                            @for ($i=0; $i < count($kriteria); $i++)
                                <td class="text-center">
                                    {{ $ak[$i+2] }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<div class="mt-3">
    <div class="card" x-data="{ open: false }">
      <div class="card-body">
        <div class="row" @click="open = ! open" type="button">
            <div class="col-10">
                <b>Langkah 1: Menghitung Matriks Keputusan Ternormalisasi</b>
            </div>
            <div class="col-2 text-end">
              <i class="bi bi-caret-down-fill"></i>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="text-center mt-4">
                <img src="{{ asset('storage/images/4.png') }}" alt="">
            </div>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            No
                        </th>
                        <th scope="col" class="text-center">
                            Kode
                        </th>
                        <th scope="col" class="text-center">
                            Nama Alternatif
                        </th>
                        @foreach ($kriteria as $k)
                        <th scope="col" class="text-center">
                            {{ $k['name']}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($normalisasi as $index => $n)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $n[0] }}
                            </td>
                            <td class="text-center">
                                {{ $n[1] }}
                            </td>
                            @for ($i=0; $i < count($kriteria); $i++)
                                <td class="text-center">
                                    {{ $n[$i+2] }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    <tr>
                        <th class="text-center" colspan="3">
                            Bobot
                        </th>

                        @foreach ($bobot as $index => $b)
                            <th class="text-center">
                                {{ $bobot[$index] }}
                            </th>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<div class="mt-3">
    <div class="card" x-data="{ open: false }">
      <div class="card-body">
        <div class="row" @click="open = ! open" type="button">
            <div class="col-10">
                <b>Langkah 2: Menghitung Matriks Keputusan Ternormalisasi dan Terbobot</b>
            </div>
            <div class="col-2 text-end">
              <i class="bi bi-caret-down-fill"></i>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="text-center mt-4">
                <img src="{{ asset('storage/images/5.png') }}" alt="">
            </div>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            No
                        </th>
                        <th scope="col" class="text-center">
                            Kode
                        </th>
                        <th scope="col" class="text-center">
                            Nama Alternatif
                        </th>
                        @foreach ($kriteria as $k)
                        <th scope="col" class="text-center">
                            {{ $k['name']}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($normxbobot as $index => $nb)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $nb[0] }}
                            </td>
                            <td class="text-center">
                                {{ $nb[1] }}
                            </td>
                            @for ($i=0; $i < count($kriteria); $i++)
                                <td class="text-center">
                                    {{ $nb[$i+2] }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<div class="mt-3">
    <div class="card" x-data="{ open: false }">
      <div class="card-body">
        <div class="row" @click="open = ! open" type="button">
            <div class="col-10">
                <b>Langkah 3: Mencari Nilai Solusi Ideal Positif (MAX) dan Solusi Ideal Negatif (MIN)</b>
            </div>
            <div class="col-2 text-end">
              <i class="bi bi-caret-down-fill"></i>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="text-center mt-4">
                <img src="{{ asset('storage/images/6-1.png') }}" alt="">
                <img src="{{ asset('storage/images/6-2.png') }}" alt="" class="ms-4">
            </div>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($kriteria as $k)
                        <th scope="col" class="text-center">
                            {{ $k['name']}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <th>MAX (y+)</th>
                        @foreach ($ymax as $index => $ym )
                            <td class="text-center">
                                {{ $ymax[$index] }}
                            </td>
                        @endforeach
                    </tr>
                    <tr class="text-center">
                        <th>MIN (y-)</th>
                        @foreach ($ymin as $index => $ym )
                            <td class="text-center">
                                {{ $ymin[$index] }}
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<div class="mt-3">
    <div class="card" x-data="{ open: false }">
      <div class="card-body">
        <div class="row" @click="open = ! open" type="button">
            <div class="col-10">
                <b>Langkah 4: Menghitung Nilai D+ dan D- Untuk Setiap Alternatif</b>
            </div>
            <div class="col-2 text-end">
              <i class="bi bi-caret-down-fill"></i>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="text-center mt-4">
                <img src="{{ asset('storage/images/7-1.png') }}" alt="">
                <img src="{{ asset('storage/images/7-2.png') }}" alt="" class="ms-4">
            </div>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="text-center">
                            No
                        </th>
                        <th class="text-center">
                            Kode
                        </th>
                        <th class="text-center">
                            Nama Alternatif
                        </th>
                        <th class="text-center">
                            D+
                        </th>
                        <th class="text-center">
                            D-
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dplusmin as $index => $dpm)
                    @php
                        $dpm_count = count($dpm);
                    @endphp
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $dpm[0] }}
                            </td>
                            <td class="text-center">
                                {{ $dpm[1] }}
                            </td>
                            <td class="text-center">
                                {{ $dpm[$dpm_count - 2] }}
                            </td>
                            <td class="text-center">
                                {{ $dpm[$dpm_count - 1] }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<div class="mt-3 mb-4">
    <div class="card" x-data="{ open: false }">
      <div class="card-body">
        <div class="row" @click="open = ! open" type="button">
            <div class="col-10">
                <b>Langkah 5: Menghitung Nilai Preferensi</b>
            </div>
            <div class="col-2 text-end">
              <i class="bi bi-caret-down-fill"></i>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="text-center mt-4">
                <img src="{{ asset('storage/images/8.png') }}" alt="">
            </div>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="text-center">
                            No
                        </th>
                        <th class="text-center">
                            Kode
                        </th>
                        <th class="text-center">
                            Nama Alternatif
                        </th>
                        <th class="text-center">
                            Preferensi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dplusmin as $dpm)
                        @php
                            $dpm_count = count($dpm);
                            $preferensi = round($dpm[$dpm_count - 1] / ($dpm[$dpm_count - 1] + $dpm[$dpm_count - 2]), 4);
                        @endphp
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $dpm[0] }}
                            </td>
                            <td class="text-center">
                                {{ $dpm[1] }}
                            </td>
                            <td class="text-center">
                                {{ $preferensi }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>



@endsection
