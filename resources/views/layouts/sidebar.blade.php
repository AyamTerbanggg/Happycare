<div class="sidebar">
    <div class="brand">HappyCare Admin</div>
    <div class="nav">
        <a href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">Users</a>
        <a href="/admin/hospitals" class="{{ request()->is('admin/hospitals*') ? 'active' : '' }}">Hospitals</a>
        <a href="/admin/tourism" class="{{ request()->is('admin/tourism*') ? 'active' : '' }}">Tourism</a>
        <a href="/admin/contacts" class="{{ request()->is('admin/contacts*') ? 'active' : '' }}">Contacts</a>
        <a href="/admin/email" class="{{ request()->is('admin/email*') ? 'active' : '' }}">Email Server</a>
        <a href="/admin/settings" class="{{ request()->is('admin/settings') ? 'active' : '' }}">General Settings</a>
        <a href="/">Ke Website Utama</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div> 