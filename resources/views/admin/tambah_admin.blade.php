@extends('admin.layout')
@section('content')
    <!-- Main content -->
    <section class="content container mt-5 pt-5">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title">Dasboard</h3> --}}

                <div class="card-tools">
                    <a type="button" class="btn btn-tool" data-card-widget="remove" title="Remove" href="{{ url('/admin/list_admin') }}">
                        <i class="fas fa-times" href=""></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('/admin/create_user') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control @error('name') is-invalid @enderror"
                               value="{{ isset($user)? $user->name : old('name') }}" name="name" type="text"/>
                        @error('name')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control @error('email') is-invalid @enderror"
                               value="{{ isset($user)? $user->email : old('email') }}" name="email" type="text"/>
                        @error('email')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    @if(!isset($user))
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control @error('password') is-invalid @enderror"
                               value="{{ isset($user)? $user->password : old('password') }}" name="password" type="password"/>
                        @error('password')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror"
                               value="{{ isset($user)? $user->password : old('password_confirmation') }}" name="password_confirmation" type="password"/>
                        @error('password')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    @endif
                    <div class="form-group">
                        <label>Role</label>

                        <select class="form-control @error('role') is-invalid @enderror" name="role">
                            {{-- @foreach($prodi as $p)
                                <option value="{{ $p->id_prodi }}"> {{ $p->prodi }}</option>
                            @endforeach --}}
                            <option value="1">Admin</option>
                            <option value="2">Petugas</option>
                            <option value="3">User</option>
                        </select>
                        @error('role')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>

                        <select class="form-control @error('jeni_kelamin') is-invalid @enderror" name="jenis_kelamin">
                            {{-- @foreach($user as $a)
                                <option value="{{ $a->jenis_kelamin }}"> {{ $a->admin }}</option>
                            @endforeach --}}
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>

                        </select>
                        @error('jenis_kelamin')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control @error('tanggal_lahir') is-invalid @enderror"
                               value="{{ isset($user)? $user->tanggal_lahir : old('tanggal_lahir') }}"
                               name="tanggal_lahir" type="date"/>
                        @error('tanggal_lahir')
                        <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>

            </div>


            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
