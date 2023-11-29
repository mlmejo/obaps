<x-guest-layout>
    <form action="{{ route('register') }}" method="post" class="m-auto w-100 p-3 rounded bg-white"
        style="max-width: 28rem;">
        <div class="text-center">
            <img src="{{ asset('images/carmen_seal.webp') }}" alt="Municipality of Carmen" height="80" width="80">
        </div>

        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required autofocus>
        </div>

        <div class="mt-3">
            <label for="email">Email address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>
        </div>

        <button type="submit" class="btn mt-3 mb-2 w-100 btn-primary">Register</button>

        <small class="text-muted">Already have an account? <a href="{{ url('/') }}">Login here</a></small>
    </form>
</x-guest-layout>
