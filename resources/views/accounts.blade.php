@extends('layouts.master')

@section('content')
    <content.accounts.search></content.accounts.search>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Accounts</h3>
        </div>
        <content.accounts.table></content.accounts.table>
    </div>
@endsection