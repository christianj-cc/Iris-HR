<div class="user-dropdown">
    <div class="user-icon" id="user-icon">
        <i class="fas fa-user-circle"></i>
    </div>
    <div class="dropdown-menu" id="dropdown-menu">
        <button class="dropdown-profile" onclick="window.location.href='profile.php'">
            <i class="fas fa-user"></i> Profile
        </button>
        <form action="../DATABASE/db_loggedout.php" method="post" class="dropdown-logout">
            <button type="submit">
                <i class="fa fa-sign-out"></i> Logout
            </button>
        </form>
    </div>
</div>