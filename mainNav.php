<nav class="navbar navbar-expand-sm navbar-dark bg-dark px4">
    <!-- BRAND -->
    <a href="products.php" class="navbar-brand">
        <h1 class="h4 text-uppercase">Minimart Catalog</h1>
    </a>

    <!-- BUTTON -->
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#main-nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- LINKS -->
    <div class="collapse navbar-collapse" id="main-nav">
        <!-- left -->
        <ul class="navbar-nav">
            <li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="sections.php" class="nav-link">Sections</a></li>
        </ul>

        <!-- right -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="profile.php" class="nav-link fw-bold"><?= $_SESSION['username'] ?></a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Log out</a></li>
        </ul>
    </div>
</nav>