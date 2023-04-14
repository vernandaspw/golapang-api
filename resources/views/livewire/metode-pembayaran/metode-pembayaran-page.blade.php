<div>
    <div class="container-fluid px-4">
        <div class="mt-3">
            <h4>
                Metode pembayaran
            </h4>
            <button wire:click="$toggle('tambahPage')" type="button" class="btn btn-success">Tambah</button>
        </div>
        <div class="my-3">
            @if (session('alert'))
            <div class="alert alert-danger">
             {{ session('alert') }}
            </div>
            @endif
            @if (session('alertsuccess'))
            <div class="alert alert-success">
             {{ session('alertsuccess') }}
            </div>
            @endif
        </div>
        @if($ubahPage)
        <div class="col-lg-4">
            <div class="mt-2 card">
                <div class="card-header">
                    Ubah data
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='perbarui'>

                        <div class="mb-2">
                            <label for="nama">nama</label>
                            <input type="text" wire:model='nama' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="keterangan">keterangan</label>
                            <input type="text" wire:model='keterangan' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="istampil">istampil</label>
                            <select wire:model='istampil' id="istampil" class="form-control">
                                <option value="true">tampil</option>
                                <option value="false">tidak tampil</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="isaktif">isaktif</label>
                            <select wire:model='isaktif' id="isaktif" class="form-control">
                                <option value="true">aktif</option>
                                <option value="false">tidak aktif</option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-success form-control">Perbarui</button>
                        <button type="button" wire:click='batalUbah' class="btn mt-1 btn-secondary form-control">Batal</button>
                    </form>
                </div>
            </div>
        </div>
        @else
        @if($tambahPage)
        <div class="col-lg-4">
            <div class="mt-2 card">
                <div class="card-header">
                    Tambah data
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='simpan'>


                        <div class="mb-2">
                            <label for="nama">nama</label>
                            <input type="text" wire:model='nama' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="keterangan">keterangan</label>
                            <input type="text" wire:model='keterangan' class="form-control">
                        </div>



                        <button type="submit" class="btn btn-success form-control">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        <div class="mt-2">
           <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>is tampil</th>
                                <th>is aktif</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>

                                    <td>
                                        {{ $data->nama }}
                                    </td>
                                    <td>
                                        {{ $data->keterangan }}
                                    </td>
                                    <td>
                                        <button wire:click="ubahistampil('{{ $data->id }}')" type="button"
                                            class="btn btn-sm rounded-pill @if ($data->istampil) btn-success
                                        @else
                                            btn-danger @endif">{{ $data->istampil == 1 ? 'tampil' : 'tidak tampil' }}</button>
                                    </td>
                                    <td>
                                        <button wire:click="ubahisaktif('{{ $data->id }}')" type="button"
                                            class="btn btn-sm rounded-pill @if ($data->isaktif) btn-success
                                        @else
                                            btn-danger @endif">{{ $data->isaktif == 1 ? 'aktif' : 'tidak aktif' }}</button>
                                    </td>
                                    <td>
                                        <button type="button" wire:click="ubahPage('{{ $data->id }}')" class="btn btn-warning
                                            ">Ubah</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           </div>
        </div>
        @endif
    </div>
</div>