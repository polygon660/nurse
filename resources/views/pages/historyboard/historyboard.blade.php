@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ประวัติการเข้าใช้ทั้งหมด</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li> --}}
                        <li class="breadcrumb-item active">History Board</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- จัดการหน้าที่ -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">ประวัติการเข้าใช้ทั้งหมด</h3>
                </div>

                @livewire('historyboard.show')
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection
