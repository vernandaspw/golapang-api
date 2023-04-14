<div>
    <div class="container-fluid px-4">
        <div class="mt-3">
            <h4>
                Bank untuk tarik saldo
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
                        @if($img)
                            <img src="{{ Storage::url($img) }}" width="50" alt="">
                        @endif
                        <div class="mb-2">
                            <label for="img">img</label>
                            <input type="file" wire:model='new_img' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="nama">nama</label>
                            <input type="text" wire:model='nama' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="fee">fee</label>
                            <input type="number" wire:model='fee' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="keterangan">keterangan</label>
                            <input type="text" wire:model='keterangan' class="form-control">
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
                            <label for="img">img</label>
                            <input type="file" wire:model='img' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="nama">nama</label>
                            <input type="text" wire:model='nama' class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="fee">fee</label>
                            <input type="number" wire:model='fee' class="form-control">
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
                                <th>img</th>
                                <th>Nama</th>
                                <th>isaktif</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($data->img) }}" width="50" alt="">
                                    </td>
                                    <td>
                                        {{ $data->nama }}
                                    </td>
                                    <td>
                                        @uang($data->fee)
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
