@extends('admin.layouts.app')

@section('mainContent')

    <div class="ibox-content mt-lg-5">
        <h2 class="font-bold">Permission denied</h2>
        <div class="row">
            <div class="col-12">
                @if(isset($message))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
