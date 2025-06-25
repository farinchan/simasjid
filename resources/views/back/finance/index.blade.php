@extends('back.app')
@section('content')
    <div id="kt_content_container" class="container-fluid">

        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    Laporan Keuangan
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <div class="btn-group">

                        <a href="#" class="btn btn-light-primary" id="export_excel">
                            <i class="ki-duotone ki-file-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Export Excel
                        </a>
                        <a class="btn btn-light-primary" href="">

                            <i class="ki-duotone ki-printer fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                            Print PDF
                        </a>
                    </div>
                    <div class="btn-group">

                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_finance">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Transaksi
                        </a>

                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row mb-10">
                    <div class="col-md-4">

                        <label class="form-label fs-6 fw-bold">Paket Umrah</label>
                        <select class="form-select form-select-solid" data-control="select2"
                            data-placeholder="Select an option" name="schedule_id" id="schedule_id">
                            <option value="1">Semua Paket</option>

                        </select>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label fs-6 fw-bold">Dari Tanggal</label>
                        <input type="date" name="date_start" class="form-control form-control-solid"
                            placeholder="Date Start" id="date_start"
                            value="{{ \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fs-6 fw-bold">Sampai Tanggal</label>
                        <input type="date" name="date_end" class="form-control form-control-solid" placeholder="Date End"
                            id="date_end" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="fs-5 fw-bold text-gray-700 me-3 fs-3">Total Income:</span>
                                    <span class="fs-5 fw-bold text-success fs-2" id="total_income">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="fs-5 fw-bold text-gray-700 me-3 fs-3">Total Expense:</span>
                                    <span class="fs-5 fw-bold text-danger fs-2" id="total_expense">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="d-flex  align-items-center">
                                    <span class="fs-5 fw-bold text-gray-700 me-3 fs-3">Balance:</span>
                                    <span class="fs-5 fw-bold fs-2  text-danger " id="balance">Rp 0 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_finance">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-200px">Transaksi</th>
                            <th class="min-w-125px">Tanggal</th>
                            <th class="min-w-150px">Jumlah</th>
                            <th class="min-w-50px">Type</th>
                            <th class="min-w-200px">Payment Info</th>
                            <th class="min-w-100px">Lampiran</th>
                            <th class="min-w-300px">Log</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" tabindex="-1" id="add_finance">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Keuangan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('back.finance.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="form-label required">Kategori Transaksi</label>
                            <div class="input-group">
                                <select class="form-select" name="transaction_id" required>
                                    <option value="">Pilih Kategori Transaksi</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('transaction_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->type }} - {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#add_category_modal">
                                    <i class="ki-duotone ki-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Tambah Kategori -->
                        <div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('back.finance.category.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCategoryLabel">Tambah Kategori Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label required">Tipe</label>
                                                <select class="form-select" name="type" required>
                                                    <option value="income">Pemasukan</option>
                                                    <option value="expense">Pengeluaran</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Nama Kategori</label>
                                                <input type="text" class="form-control" name="name" required placeholder="Nama kategori">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" placeholder="Deskripsi transaksi keuangan" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Jumlah</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" placeholder="Jumlah transaksi keuangan"
                                    value="{{ old('amount') }}" oninput="formatRupiah(this)" required />
                            </div>
                            <input type="hidden" id="rupiah_value" name="amount" value="{{ old('amount') }}">
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Tanggal</label>
                            <input type="datetime-local" class="form-control" placeholder="Tanggal transaksi keuangan"
                                name="date" value="{{ old('date') }}" required />
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label ">Metode Pembayaran</label>
                                <input type="text" class="form-control" placeholder="Metode Pembayaran"
                                    name="payment_method" value="{{ old('payment_method') }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label ">No Ref</label>
                                <input type="text" class="form-control" placeholder="No Ref" name="payment_reference"
                                    value="{{ old('payment_reference') }}" />
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label ">Note</label>
                            <textarea class="form-control" placeholder="Note" name="payment_note">{{ old('payment_note') }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Lampiran</label>
                            <input type="file" class="form-control" name="attachment" />
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#table_finance').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('back.finance.datatables') }}",
                    data: function(d) {
                        d.schedule_id = $('#schedule_id').val();
                        d.date_start = $('#date_start').val();
                        d.date_end = $('#date_end').val();
                    }
                },
                columns: [{
                        data: 'transaction',
                        name: 'transaction'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'payment_info',
                        name: 'payment_info'
                    },
                    {
                        data: 'attachment',
                        name: 'attachment'
                    },
                    {
                        data: 'log',
                        name: 'log'
                    }
                ]
            });

            let summary = {
                total_income: 0,
                total_expense: 0,
                total_balance: 0
            };

            table.on('xhr', function() {
                let json = table.ajax.json();
                summary.total_income = json.total_income;
                summary.total_expense = json.total_expense;
                summary.total_balance = json.total_balance;

                console.log(summary);
                $('#total_income').text('Rp ' + summary.total_income.toLocaleString());
                $('#total_expense').text('Rp ' + summary.total_expense.toLocaleString());
                if (summary.total_balance >= 0) {
                    $('#balance').removeClass('text-danger').addClass('text-success');
                } else {
                    $('#balance').removeClass('text-success').addClass('text-danger');
                }
                $('#balance').text('Rp ' + summary.total_balance.toLocaleString());

                $('#export_excel').attr('href',
                    "{{ route('back.finance.export') }}?schedule_id=" +
                    $('#schedule_id').val() + "&date_start=" + $('#date_start').val() + "&date_end=" +
                    $(
                        '#date_end').val());

            });

            $('#schedule_id').on('change', function() {
                table.ajax.reload();
            });

            $('#date_start').on('change', function() {
                table.ajax.reload();
            });

            $('#date_end').on('change', function() {
                table.ajax.reload();
            });




        });
    </script>
@endsection
