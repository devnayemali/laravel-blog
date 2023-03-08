<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('back.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('back.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#post"
            aria-expanded="true" aria-controls="post">
            <i class="fas fa-fw fa-cog"></i>
            <span>Post</span>
        </a>
        <div id="post" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('post.index') }}">Post List</a>
                <a class="collapse-item" href="{{ route('post.create') }}">Add New Post</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category"
            aria-expanded="true" aria-controls="category">
            <i class="fas fa-fw fa-cog"></i>
            <span>Category</span>
        </a>
        <div id="category" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('category.index') }}">Category List</a>
                <a class="collapse-item" href="{{ route('category.create') }}">Add New Category</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub_category"
            aria-expanded="true" aria-controls="sub_category">
            <i class="fas fa-fw fa-cog"></i>
            <span>Sub Category</span>
        </a>
        <div id="sub_category" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('sub-category.index') }}">Sub Category List</a>
                <a class="collapse-item" href="{{ route('sub-category.create') }}">Add New Sub Category</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTag"
            aria-expanded="true" aria-controls="collapseTag">
            <i class="fas fa-fw fa-cog"></i>
            <span>Tag</span>
        </a>
        <div id="collapseTag" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('tag.index') }}">Tag List</a>
                <a class="collapse-item" href="{{ route('tag.create') }}">Add New Tag</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
