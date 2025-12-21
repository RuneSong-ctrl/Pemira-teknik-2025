<div class="app-header white box-shadow-z1 border-bottom">
    <div class="navbar navbar-toggleable-sm flex-row align-items-center px-4 py-2">
        
        <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3 text-muted btn btn-icon">
            <i class="material-icons">&#xe5d2;</i>
        </a>

        <div class="d-flex flex-column">
            <h5 class="mb-0 text-dark font-weight-bold" id="pageTitle" ng-bind="$state.current.data.title">
                {{ $title ?? 'Dashboard' }}
            </h5>
            <small class="text-muted hidden-xs-down" style="font-size: 0.8rem;">Administrator Panel</small>
        </div>

        <ul class="nav navbar-nav ml-auto flex-row align-items-center">
            <li class="nav-item">
                <a href="/logout" class="btn-logout-custom d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons mr-2 text-danger" style="font-size: 1.2rem;">power_settings_new</i>
                    <span class="font-weight-600">Logout</span>
                </a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>

    </div>
</div>

<style>
    /* Styling Navbar agar lebih rapi */
    .app-header {
        height: 70px; /* Samakan dengan padding-top di master layout */
        display: flex;
        align-items: center;
        z-index: 1020; /* Pastikan di atas konten */
    }

    /* Styling Tombol Logout Custom */
    .btn-logout-custom {
        background-color: #fff;
        border: 1px solid #e1e4e8;
        padding: 8px 20px;
        border-radius: 50px; /* Pill shape */
        color: #444;
        transition: all 0.3s ease;
        text-decoration: none !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .btn-logout-custom:hover {
        background-color: #ffeaea; /* Merah sangat muda saat hover */
        border-color: #ffcccc;
        color: #dc3545;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.1);
    }
    
    .font-weight-600 {
        font-weight: 600;
    }
</style>