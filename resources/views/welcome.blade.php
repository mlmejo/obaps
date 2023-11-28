<x-guest-layout>
    <form action="{{ route('login') }}" method="post" class="m-auto w-100 p-3 rounded bg-white" style="max-width: 24rem;">
        <div class="text-center">
            <img src="{{ asset('images/carmen_seal.webp') }}" alt="Municipality of Carmen" height="80" width="80">
        </div>

        @csrf

        <div>
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>

        <div class="mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn mt-3 mb-2 w-100 btn-primary">Login</button>

        <small class="text-muted">Don't have an account? <a href="{{ route('register') }}">Register here</a></small>
    </form>
</x-guest-layout>
