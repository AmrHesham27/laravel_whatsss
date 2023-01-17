<nav id="sidebar">
    <div class="nav-body">
        <button class="close-btn">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="p-4 pt-5 nav-body">
            <ul class="list-unstyled components mb-5">
                <li class="<?php if($active == 'Home') echo 'active'; ?>">
                    <a href="/admin">Home</a>
                </li>

                <li class="<?php if($active == 'Edit Store') echo 'active'; ?>">
                    <a href="/admin/editStore">Edit Store</a>
                </li>

                <li class="<?php if($active == 'Categories') echo 'active'; ?>">
                    <a href="/admin/categories">Categories</a>
                </li>

                <!-- <li class="active">
                    <a href="/admin/categories">Categories</a>
                </li> -->
            </ul>
        </div>
    </div>

</nav>