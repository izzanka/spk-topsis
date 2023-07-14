@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Data Nilai Alternatif</span>
    <hr>
    @include('layout.alert')
    <div class="card rounded-1">
        <div class="card-body">
            @if($alternatif_criterias)
                <table class="table table-bordered">
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
                            @foreach ($criterias as $criteria)
                            <th scope="col" class="text-center">
                                {{ $criteria->name }}
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
                                <td class="text-center">
                                    {{ $ac->alternatif->code }}
                                </td>
                                <td class="text-center">
                                    {{ $ac->alternatif->name }}
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
                                    <a class="btn btn-danger btn-sm" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $ac->id }}').submit();"><i class="bi bi-trash me-1"></i> Hapus</a>
                                </td>
                                <form id="delete-form-{{ $ac->id }}" action="" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
            @endif
        </div>
    </div>
</div>

@endsection
