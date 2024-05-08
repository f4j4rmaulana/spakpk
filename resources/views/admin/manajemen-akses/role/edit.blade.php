@extends('admin.layouts.master')

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Update Role dan Permission</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.role.update', Crypt::encryptstring($role->id)) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Role</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'name') }}" id="name" name="name" value="{{old('name', $role->name)}}" required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <hr>
                        @foreach ($permissions as $groupname => $permission)
                            <div class="mb-3">
                                <label for="check" class="fw-bolder form-label mb-3">{{ $groupname }}</label>
                                <div class="d-flex flex-row align-items-center flex-wrap gap-4">
                                    @foreach ($permission as $item)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="permissions[]" type="checkbox" role="switch" id="flexSwitchCheckChecked" value="{{ $item->name }}" {{ in_array($item->name, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ $item->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="mb-3 d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.role.index') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
