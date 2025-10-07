
<nav class="navbar">
    <ul class="nav-list">
        <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <?php if (isset($_SESSION['user_id'])): ?>
        <li class="nav-item">
            <a href="profilo.php" class="nav-link">Profilo</a>
        </li>
        <?php else : ?>
            <li class="nav-item">
                <a href="login.php" class="nav-link">Login</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<style>
    .navbar {
        background-color: #333;
        padding: 1rem;
    }

    .nav-list {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    .nav-item {
        margin: 0 1rem;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
    }

    .nav-link:hover {
        color: #ddd;
    }
</style>