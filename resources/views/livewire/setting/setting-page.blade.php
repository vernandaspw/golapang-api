<div>

    <div class="container-fluid px-4">

       <form wire:submit.prevent="save">
        <div class="mt-3">
            <h5 class="">Setting</h5>
            <button type="submit" class="btn btn-success py-2 px-5">PERBARUI</button>
           </div>
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

            <div class="row mb-5">
                <div class="col-lg-3 mt-2">
                    <div class="card mt-2">
                        <div class="card-header">Customer</div>
                        <div class="card-body">
                            <form wire:submit.prevent='save'>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee customer transaksi</div>
                                        <div class="">
                                            @uang($fee_customer_transaksi)
                                        </div>
                                    </div>
                                    <input wire:model='fee_customer_transaksi' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee customer transaksi member</div>
                                        <div class="">
                                            @uang($fee_customer_transaksi_member)
                                        </div>
                                    </div>
                                    <input wire:model='fee_customer_transaksi_member' type="number" class="form-control">
                                </div>
                                <hr>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee customer topup</div>
                                        <div class="">
                                            @uang($fee_customer_topup)
                                        </div>
                                    </div>
                                    <input wire:model='fee_customer_topup' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee customer tarik</div>
                                        <div class="">
                                            @uang($fee_customer_tarik)
                                        </div>
                                    </div>
                                    <input wire:model='fee_customer_tarik' type="number" class="form-control">
                                </div>



                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">min isi customer</div>
                                        <div class="">
                                            @uang($min_isi_customer)
                                        </div>
                                    </div>
                                    <input wire:model='min_isi_customer' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">max isi customer</div>
                                        <div class="">
                                            @uang($max_isi_customer)
                                        </div>
                                    </div>
                                    <input wire:model='max_isi_customer' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">min tarik customer</div>
                                        <div class="">
                                            @uang($min_tarik_customer)
                                        </div>
                                    </div>
                                    <input wire:model='min_tarik_customer' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">max tarik customer</div>
                                        <div class="">
                                            @uang($max_tarik_customer)
                                        </div>
                                    </div>
                                    <input wire:model='max_tarik_customer' type="number" class="form-control">
                                </div>
<hr>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login customer password</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_customer_password' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($customer_password) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($customer_password)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login customer otp wa</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_customer_otp_wa' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($customer_otp_wa) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($customer_otp_wa)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login customer otp email</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_customer_otp_email' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($customer_otp_email) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($customer_otp_email)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 mt-2">
                    <div class="card mt-2">
                        <div class="card-header">Mitra</div>
                        <div class="card-body">
                            <form wire:submit.prevent='save'>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee mitra transaksi</div>
                                        <div class="">
                                            @uang($fee_mitra_transaksi)
                                        </div>
                                    </div>
                                    <input wire:model='fee_mitra_transaksi' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee mitra transaksi member</div>
                                        <div class="">
                                            @uang($fee_mitra_transaksi_member)
                                        </div>
                                    </div>
                                    <input wire:model='fee_mitra_transaksi_member' type="number" class="form-control">
                                </div>
                                <hr>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee mitra topup</div>
                                        <div class="">
                                            @uang($fee_mitra_topup)
                                        </div>
                                    </div>
                                    <input wire:model='fee_mitra_topup' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">fee mitra tarik</div>
                                        <div class="">
                                            @uang($fee_mitra_tarik)
                                        </div>
                                    </div>
                                    <input wire:model='fee_mitra_tarik' type="number" class="form-control">
                                </div>



                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">min isi mitra</div>
                                        <div class="">
                                            @uang($min_isi_mitra)
                                        </div>
                                    </div>
                                    <input wire:model='min_isi_mitra' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">max isi mitra</div>
                                        <div class="">
                                            @uang($max_isi_mitra)
                                        </div>
                                    </div>
                                    <input wire:model='max_isi_mitra' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">min tarik mitra</div>
                                        <div class="">
                                            @uang($min_tarik_mitra)
                                        </div>
                                    </div>
                                    <input wire:model='min_tarik_mitra' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">max tarik mitra</div>
                                        <div class="">
                                            @uang($max_tarik_mitra)
                                        </div>
                                    </div>
                                    <input wire:model='max_tarik_mitra' type="number" class="form-control">
                                </div>

                                <hr>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login mitra password</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_mitra_password' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($mitra_password) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($mitra_password)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login mitra otp wa</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_mitra_otp_wa' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($mitra_otp_wa) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($mitra_otp_wa)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login mitra otp email</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_mitra_otp_email' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($mitra_otp_email) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($mitra_otp_email)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 mt-2">
                    <div class="card mt-2">
                        <div class="card-header">Admin</div>
                        <div class="card-body">
                            <form wire:submit.prevent='save'>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login admin password</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_admin_password' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($admin_password) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($admin_password)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login admin otp wa</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_admin_otp_wa' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($admin_otp_wa) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($admin_otp_wa)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-start align-items-center align-content-center">
                                        <div class="">Login admin otp email</div>
                                        <div class="form-check form-switch ms-2">
                                            <input wire:click='toggle_admin_otp_email' class="form-check-input"
                                                type="checkbox" id="flexSwitchCheckChecked"
                                                @if ($admin_otp_email) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                @if ($admin_otp_email)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 mt-2">
                    <div class="card mt-2">
                        <div class="card-header">Umum</div>
                        <div class="card-body">
                            <form wire:submit.prevent='save'>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">biaya iklan perhari</div>
                                        <div class="">
                                            @uang($biaya_iklan_perhari)
                                        </div>
                                    </div>
                                    <input wire:model='biaya_iklan_perhari' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">biaya iklan perprovinsi</div>
                                        <div class="">
                                            @uang($biaya_iklan_perprovinsi)
                                        </div>
                                    </div>
                                    <input wire:model='biaya_iklan_perprovinsi' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">biaya iklan perkota</div>
                                        <div class="">
                                            @uang($biaya_iklan_perkota)
                                        </div>
                                    </div>
                                    <input wire:model='biaya_iklan_perkota' type="number" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">mininal saldo kredit mitra</div>
                                        <div class="">
                                            @uang($min_saldo_kredit_mitra)
                                        </div>
                                    </div>
                                    <input wire:model='min_saldo_kredit_mitra' type="number" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

       </form>


    </div>

</div>
