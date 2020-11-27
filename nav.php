<div class="bg-white sticky-top">
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="navbar-brand">
            <h1 style="font-weight: 900; color: royalblue; background-color: yellow">
                Beelog
            </h1>
        </div>
        <div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="fa fa-navicon fa-2x fa-fw"></span>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li onclick="location.href = 'search_people.php'" class="nav-item btn px-3">Search
                </li>
                <li onclick="location.href = 'dashboard.php'" class="nav-item btn px-3 active">Feed
                </li>
                <li onclick="location.href = 'loggedin_profile.php'" class="nav-item btn px-3">
                    Profile</li>
                <li onclick="location.href = 'logout.php'" class="nav-item btn text-danger px-3">
                    <u>Logout</u>
                </li>
            </ul>
        </div>
    </nav>
</div>