@extends('templates.index')
@section('content')
    <section>
        <div class="container">
            <div class="row p-4 d-flex">
                <form action="" method="post" id="form">
                    @csrf
                    <label for="to">Feyorra Address from
                        <a href="https://faucetpay.io/?r=551204"><b>Faucetpay.io</b></a></label>
                    <input type="text" name="to" id="to" onchange="save()" oninput="save()" onpaste="save()"
                        placeholder="0x0000000dEad" class="form-control mb-3" />

                    {!! htmlFormSnippet() !!}

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        Claim Now
                    </button>
                </form>
            </div>
        </div>
    </section>
    @include('components.listpayout')
@endsection
@push('morejs')
    <script>
        if (localStorage.getItem("address") != null) {
            $("#to").val(localStorage.getItem("address"));
        }

        function save() {
            localStorage.setItem("address", $("#to").val())
        }
    </script>
@endpush
@push('alertlists')
    @error('g-recaptcha-response')
        <script>
            Swal.fire(
                'Oh no!',
                'Please solve the captcha!',
                'warning'
            )
        </script>
    @enderror
    @error('to')
        <script>
            Swal.fire(
                'Oh no!',
                '{{ $message }}',
                'warning'
            )
        </script>
    @enderror
    @if (session()->has('limit'))
        <script>
            Swal.fire(
                'Oh no!',
                '{{ session('limit') }}',
                'error'
            )
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Wohoo!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif
    @if (session()->has('invalid'))
        <script>
            Swal.fire(
                'Oh no!',
                '{{ session('invalid') }}',
                'error'
            )
            </script>
    @endif
    @if (session()->has('time'))
    <script>
            Swal.fire(
                'Oh no!',
                '{{ session('time') }}',
                'error'
            )
        </script>
        @endif
@endpush
