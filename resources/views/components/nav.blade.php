<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Vixiloc Faucet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ ($title == "Home") ? "active" : "" }}" aria-current="page" href="">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ ($title == "Claim") ? "active" : "" }}" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Faucet List
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/claim/fey">Feyorra</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/claim/trx">Tron</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="https://vixiloc.co.id">Vixiloc</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
