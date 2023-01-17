<nav id="sidebar">
    <div class="nav-body">
        <button class="close-btn">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="p-4 pt-5 nav-body">
            <ul class="list-unstyled components mb-5">

                <li class="<?php if($active == 'Home') echo 'active'; ?>">
                    <a href="/superAdmin">Home</a>
                </li>

                <li class="<?php if($active == 'Stores') echo 'active'; ?>">
                    <a href="/superAdmin/stores/">Stores</a>
                </li>

                <li class="<?php if($active == 'Add Store') echo 'active'; ?>">
                    <a href="/superAdmin/stores/add">Add Store</a>
                </li>
            </ul>
        </div>
    </div>
</nav>