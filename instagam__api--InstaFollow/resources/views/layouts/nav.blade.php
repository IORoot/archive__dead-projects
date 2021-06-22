<div class="menu">
    <p class="menu-label">
        Main Menu
    </p>
    <ul class="menu-list">
        <router-link tag="li" exact to="/"><a>Home</a></router-link>
        <li>
            <a>Settings</a>
            <ul>
                <router-link tag="li" to="/settings"><a>User Settings</a></router-link>
                <router-link tag="li" to="/appsettings"><a>App Settings</a></router-link>
                <router-link tag="li" to="/comments"><a>Comments</a></router-link>
                <router-link tag="li" to="/hashtags"><a>Hashtags</a></router-link>
                <router-link tag="li" to="/debug"><a>Debug</a></router-link>
            </ul>
        </li>
        <router-link tag="li" to="/timed"><a>Run</a></router-link>
    </ul>
</div>