<ul class="sidebar-nav">
    <li class="sidebar-header">
        Pages
    </li>
    @if(auth()->user()->isAdmin())
        <li class="sidebar-item {{ (request()->is('admin/dashboard')) ? 'active' : ''}}">
            <a class="sidebar-link" href="{{route('admin.dashboard')}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item {{ (request()->is('admin/category*')) ? 'active' : ''}}">
            <a class="sidebar-link" href="{{route('admin.category')}}">
                <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Category</span>
            </a>
        </li>

        <li class="sidebar-item {{ (request()->is('admin/product*')) ? 'active' : ''}}">
            <a class="sidebar-link" href="{{route('admin.product')}}">
                <i class="align-middle" data-feather="box"></i> <span class="align-middle">Product</span>
            </a>
        </li>

        <li class="sidebar-item {{ (request()->is('admin/order*')) ? 'active' : ''}}">
            <a class="sidebar-link" href="{{route('admin.order')}}">
                <i class="align-middle" data-feather="package"></i> <span class="align-middle">Order</span>
            </a>
        </li>
    @elseif(auth()->user()->isUser())
        <li class="sidebar-item {{ (request()->is('user/profile*')) ? 'active' : ''}}">
            <a class="sidebar-link" href="{{route('user.profile')}}">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">User Settings</span>
            </a>
        </li>
    @endif
</ul>
