@extends('layouts.master')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Accounts</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <content.accounts.table></content.accounts.table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection