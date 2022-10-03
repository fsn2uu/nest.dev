@auth
    <footer class="container py-5">
        <div class="row">
            <div class="col-12 col-md">
                Nest VRS &copy; 2017 - {{ date('Y') }}
            </div>
            <div class="col-6 col-md">
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Complexes</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="{{ route('complexes') }}">My Complexes</a>
                    </li>
                    <li>
                        <a href="{{ route('complexes.create') }}">Add a Complex</a>
                    </li>
                </ul>
                <h5>Reservations</h5>
                <ul class="list-unstyled text-small">
                    <li><a href="">My Reservations</a></li>
                    <li><a href="">Add a Reservation</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Units</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="{{ route('units') }}">My Units</a>
                    </li>
                    <li>
                        <a href="{{ route('units.create') }}">Add a Unit</a>
                    </li>
                </ul>
                <h5>Travelers</h5>
                <ul class="list-unstyled text-small">
                    <li><a href="">My Travelers</a></li>
                    <li><a href="">Add a Traveler</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Tasks</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="">My Tasks</a>
                    </li>
                    <li>
                        <a href="">Add a Task</a>
                    </li>
                </ul>
                <h5>Help</h5>
                <ul class="list-unstyled text-small">
                    <li>Feature Request</li>
                    <li>Report a Problem</li>
                </ul>
            </div>
        </div>
    </footer>
@else
    <footer class="container py-5">
        <div class="row">
            <div class="col-12 col-md">
                Nest VRM &copy; 2017 - {{ date('Y') }}
            </div>
            <div class="col-6 col-md">
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('pricing') }}">Pricing</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}">About Nest</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li>Developers</li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li>Privacy</li>
                    <li>Terms</li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Contact</h5>
                <ul class="list-unstyled text-small">
                    <li><a href="mailto:support@nestvrm.com"><i class="far fa-envelope"></i> Email Us</a></li>
                </ul>
            </div>
        </div>
    </footer>
@endauth
