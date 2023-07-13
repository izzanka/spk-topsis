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
                <b>Matriks Keputusan Ternormalisasi</b>
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
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>


@endsection
