@extends('back.app')
@section('content')
    <div id="kt_content_container" class=" container-xxl ">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-category-filter="search"
                            class="form-control form-control-solid w-250px ps-12" placeholder="Cari kajian" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        Tambah kajian
                    </a>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_ecommerce_category_table .form-check-input"
                                        value="1" />
                                </div>
                            </th>
                            <th class="min-w-150px">Tanggal</th>
                            <th class="min-w-150px">Ustadz</th>
                            <th class="min-w-150px">Tema Kajian</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($list_kajian as $kajian)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold">{{ \Carbon\Carbon::parse($kajian->datetime)->translatedFormat('l') }}</div>
                                        <div class="text-muted">{{ \Carbon\Carbon::parse($kajian->datetime)->translatedFormat('d F Y, H:i') }}</div>
                                    </div>
                                </td>
                                <td class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="#">
                                            <div class="symbol-label">
                                                <img src="{{ $kajian->ustadz->photo }}" alt="{{ $kajian->ustadz->name }}" width="50px" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary mb-1">{{ $kajian->ustadz->name }}</a>
                                        <span>{{ $kajian->ustadz->phone ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $kajian->theme }}</div>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#edit_category{{ $kajian->id }}">
                                                Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#delete_category{{ $kajian->id }}">
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add_category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah kajian</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.kajian-time.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="datetime" class="form-label required">Tanggal</label>
                            <input type="datetime-local" class="form-control form-control-solid" id="datetime" name="datetime"
                                placeholder="Tanggal kajian" value="{{ old('datetime') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label required">Khatib</label>
                            <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#add_category"
                                data-placeholder="Pilih Ustadz" name="ustadz_id" id="ustadz_id" required>
                                <option value="">Pilih Ustadz</option>
                                @foreach ($list_ustadz as $ustadz)
                                    <option value="{{ $ustadz->id }}" {{ old('ustadz_id') == $ustadz->id ? 'selected' : '' }}>
                                        {{ $ustadz->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="theme" class="form-label required">Tema Kajian</label>
                            <input type="text" class="form-control form-control-solid" id="theme"
                                name="theme" placeholder="Tema Kajian" value="{{ old('theme') }}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($list_kajian as $kajian)
        <div class="modal fade" tabindex="-1" id="edit_category{{ $kajian->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit kajian</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.kajian-time.update', $kajian->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="datetime" class="form-label required">Tanggal & Waktu</label>
                                <input type="datetime-local" class="form-control form-control-solid" id="datetime"
                                    name="datetime" placeholder="Tanggal kajian" value="{{ $kajian->datetime }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label required">Khatib</label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#edit_category{{ $kajian->id }}"
                                    data-placeholder="Pilih Ustadz" name="ustadz_id" id="ustadz_id" required>
                                    <option value="">Pilih Ustadz</option>
                                    @foreach ($list_ustadz as $ustadz)
                                        <option value="{{ $ustadz->id }}"
                                            {{ $kajian->ustadz_id == $ustadz->id ? 'selected' : '' }}>
                                            {{ $ustadz->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="theme" class="form-label required">Tema Kajian</label>
                                <input type="text" class="form-control form-control-solid" id="theme"
                                    name="theme" placeholder="Tema Kajian" value="{{ $kajian->theme }}" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="delete_category{{ $kajian->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus kajian</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.kajian-time.destroy', $kajian->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus waktu kajian <strong>{{ \Carbon\Carbon::parse($kajian->date)->translatedFormat('d F Y') }}</strong>?</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus kajian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/list_jumat.js') }}"></script>
@endsection
