<div>
    <div class="container-fluid px-4">
        <div class="mt-3 mb-3">
            <h4>Kelola akun admin</h4>
            <div class="mx-2">
                <button type="button" class="btn btn-success" wire:click="$toggle('tambahPage')">Tambah akun</button>
            </div>
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
        @if ($tambahPage)
            <div class="col-lg-3">
                <div class="card mb-2">
                    <div class="card-header bg-success text-white">
                        Tambah akun admin
                    </div>
                    <div class="card-body">

                        <div class="">
                            <form wire:submit.prevent='simpan'>
                                <div class="mb-2">
                                    <label for="nama">Nama</label>
                                    <input required type="text" wire:model='nama' class="form-control"
                                        placeholder="isi nama">
                                </div>
                                <div class="mb-2">
                                    <label for="phone">phone</label>
                                    <input required type="tel" wire:model='phone' class="form-control"
                                        placeholder="isi phone">
                                </div>
                                <div class="mb-2">
                                    <label for="email">email</label>
                                    <input required type="email" wire:model='email' class="form-control"
                                        placeholder="isi email">
                                </div>
                                <div class="mb-2">
                                    <label for="password">password</label>
                                    <input required type="password" wire:model='password' class="form-control"
                                        placeholder="isi password">
                                </div>
                                <div class="mb-2">
                                    <label for="role">role</label>
                                    <select class="form-control" id="role" required wire:model='role'>
                                        <option value="">Pilih</option>
                                        <option value="superadmin">superadmin</option>
                                        <option value="admin">admin</option>
                                        <option value="finance">finance</option>
                                        <option value="operator">operator</option>
                                        <option value="read">read</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success form-control">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endif
        <div class="card">

       <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th>UUID</th>
                        <th>Nama</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>role</th>
                        <th>last seen</th>
                        <th>isaktif</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>
                                {{ $data->uuid }}
                            </td>
                            <td>
                                {{ $data->nama }}
                            </td>
                            <td>
                                {{ $data->phone }}
                            </td>
                            <td>
                                {{ $data->email }}
                            </td>
                            <td>
                                {{ $data->role }}
                            </td>
                            <td>
                                {{ $data->last_seen_at }} -
                                {{ \Carbon\Carbon::parse($data->last_seen_at)->diffForHumans() }}
                            </td>
                            <td>
                                @if ($data->id == auth('admin-web')->user()->id)
                                    {{ $data->isaktif == true ? 'aktif' : 'tidak aktif' }}
                                @else
                                    <button wire:click="ubahisaktif('{{ $data->id }}')" type="button"
                                        class="btn btn-sm rounded-pill @if ($data->isaktif) btn-success
                                    @else
                                        btn-danger @endif">{{ $data->isaktif == 1 ? 'aktif' : 'tidak aktif' }}</button>
                                @endif
                            </td>

                            <td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       </div>

        </div>

    </div>

</div>
