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
                            class="form-control form-control-solid w-250px ps-12" placeholder="Cari ustadz" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        Tambah ustadz
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
                            <th class="min-w-150px">ustadz</th>
                            <th class="min-w-100px">No. Telp</th>
                            <th class="min-w-150px">Alamat</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($list_ustadz as $ustadz)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="#">
                                            <div class="symbol-label">
                                                <img src="{{ $ustadz->photo }}" alt="{{ $ustadz->name }}" width="50px" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary mb-1">{{ $ustadz->name }}</a>
                                        <span>{{ $ustadz->email ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $ustadz->phone }}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{ $ustadz->address }}</div>
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
                                                data-bs-target="#edit_category{{ $ustadz->id }}">
                                                Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#delete_category{{ $ustadz->id }}">
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
                    <h3 class="modal-title">Tambah ustadz</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.ustadz.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3 justify-content-center d-flex">

                            <div class="image-input image-input-circle image-input-empty image-input-outline"
                                data-kt-image-input="true"
                                style="background-image: url({{ asset('back/media/svg/avatars/blank.svg') }})">
                                <div class="image-input-wrapper w-125px h-125px"></div>

                                <label
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Change avatar">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                            class="path2"></span></i>

                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>

                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Cancel avatar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>

                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Remove avatar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama</label>
                            <input type="text" class="form-control form-control-solid" id="name" name="name"
                                placeholder="Nama Ustadz" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Telp</label>
                            <input type="text" class="form-control form-control-solid" id="phone" name="phone"
                                placeholder="+628xxxxxxxxxx" value="{{ old('phone') }}">
                            <small class="text-muted">
                                Gunakan format no telp internasional, contoh: <code>+62</code>
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control form-control-solid" id="email" name="email"
                                placeholder="email@torkatatech.com" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label ">Alamat</label>
                            <textarea class="form-control form-control-solid" id="address" name="address" rows="3"
                                placeholder="Deskripsi ustadz">{{ old('address') }}</textarea>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah ustadz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($list_ustadz as $ustadz)
        <div class="modal fade" tabindex="-1" id="edit_category{{ $ustadz->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit ustadz</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.ustadz.update', $ustadz->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3 justify-content-center d-flex">

                                <div class="image-input image-input-circle image-input-outline" data-kt-image-input="true"
                                    style="background-image: url({{ asset('back/media/svg/avatars/blank.svg') }})">
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url({{ $ustadz->photo }})"></div>

                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Change avatar">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>

                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>

                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label required">Nama</label>
                                <input type="text" class="form-control form-control-solid" id="name"
                                    name="name" placeholder="Nama Ustadz" value="{{ $ustadz->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No Telp</label>
                                <input type="text" class="form-control form-control-solid" id="phone"
                                    name="phone" placeholder="+628xxxxxxxxxx" value="{{ $ustadz->phone }}">
                                <small class="text-muted">
                                    Gunakan format no telp internasional, contoh: <code>+62</code>
                                </small>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control form-control-solid" id="email"
                                    name="email" placeholder="email@torkatatech.com" value="{{ $ustadz->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label ">Alamat</label>
                                <textarea class="form-control form-control-solid" id="address" name="address" rows="3"
                                    placeholder="Deskripsi ustadz">{{ $ustadz->address }}</textarea>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update ustadz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="delete_category{{ $ustadz->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus ustadz</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.ustadz.destroy', $ustadz->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus ustadz <strong>{{ $ustadz->name }}</strong>?</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus ustadz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/list_ustadz.js') }}"></script>
@endsection
