<nav class="topnav navbar navbar-light">
    <div class="navBar-Button d-flex align-items-center">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
            <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <p>Child Development Center Management System</p>
    </div>

    <ul class="nav position-relative">
        <li class="nav-item">
            <section type="button" class="nav-link text-muted my-2 circle-icon" id="chatToggle">
                <span class="fe fe-message-circle fe-16"></span>
                <?php include './chat.php' ?>
            </section>
            
        </li>

        <li class="nav-item dropdown">
        <span class="nav-link text-muted pr-0 avatar-icon" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
                <div class="avatar-img rounded-circle avatar-initials-min text-center position-relative">
                </div>
            </span>
        </span>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href=""><i class="fe fe-user"></i>&nbsp;&nbsp;&nbsp;Profile</a>
            <a class="dropdown-log-out" href="#"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Log Out</a>
        </div>    
        </li>
    </ul>
</nav>