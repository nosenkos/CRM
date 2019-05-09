<div class="container">
    <div class="row">
        <div class="col-12">
            @if(\Session::has('success'))
                <div class="alert alert-success">{{ \Session::get('success') }}</div>
            @endif

            @if(\Session::has('error'))
                <div class="alert alert-danger">{{ \Session::get('error') }}</div>
            @endif
        </div>
    </div>
</div>
