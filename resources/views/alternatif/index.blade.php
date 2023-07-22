@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Data Alternatif</span>
    <hr>
    @include('layout.alert')
    <div class="card rounded-1 mb-5">
        <div class="card-header">
            <div class="row">
                {{-- <div class="col-3">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control rounded-1" placeholder="Pencarian...">
                        <button class="btn btn-primary"><i class="bi bi-search me-1"></i> Cari</button>
                    </div>
                </div> --}}
                <div class="col-5">
                    <a class="btn btn-sm btn-success" href="{{ route('alternatifs.create') }}"><i class="bi bi-plus"></i> Tambah Data Alternatif</a>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                        <th scope="col" class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alternatifs as $alternatif)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $alternatif->code }}
                            </td>
                            <td class="text-center">
                                {{ $alternatif->name }}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-warning btn-sm" href="{{ route('alternatifs.edit', $alternatif->id) }}"><i class="bi bi-pencil-square me-1"></i> Ubah</a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $alternatif->id }}').submit();"><i class="bi bi-trash me-1"></i> Hapus</a>
                            </td>
                            <form id="delete-form-{{ $alternatif->id }}" action="{{ route('alternatifs.destroy', $alternatif->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak ada data alternatif.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $alternatifs->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
