@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Data Nilai Alternatif</span>
    <hr>
    @include('layout.alert')
    <div class="card rounded-1 mb-5">
        <div class="card-body">
            @if($alternatif_criterias)
            <div class="table-responsive">
                 <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">
                                No
                            </th>
                            {{-- <th scope="col" class="text-center">
                                Kode
                            </th> --}}
                            <th scope="col" class="text-center">
                                Kode Alternatif
                            </th>
                            @foreach ($criterias as $criteria)
                            <th scope="col" class="text-center">
                                {{ $criteria->code }}
                            </th>
                            @endforeach
                            <th scope="col" class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alternatif_criterias as $ac)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                {{-- <td class="text-center">
                                    {{ $ac->alternatif->code }}
                                </td> --}}
                                <td class="text-center">
                                    {{ $ac->alternatif->code }}
                                </td>
                                @foreach ($criterias as $criteria)
                                    <td class="text-center">
                                        @php
                                            $criteria_name = Illuminate\Support\Str::slug(strtolower($criteria->name), '_');
                                        @endphp
                                        {{ $ac[$criteria_name] }}
                                    </td>
                                @endforeach
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm" href="{{ route('alternatif.values.edit', $ac->id) }}"><i class="bi bi-pencil-square me-1"></i> Ubah</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $criterias->count() + 4 }}" class="text-center">
                                    Tidak ada data nilai alternatif.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
