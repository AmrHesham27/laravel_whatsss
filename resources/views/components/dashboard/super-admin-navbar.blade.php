<nav id="sidebar">
    <div class="nav-body">
        <button class="close-btn">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="p-4 pt-5 nav-body">
            <ul class="list-unstyled components mb-5">

                <li class="text-right <?php if($active == 'الصفحة الرئيسية') echo 'active'; ?>">
                    <a href="/superAdmin">الصفحة الرئيسية</a>
                </li>

                <li class="text-right <?php if($active == 'المتاجر') echo 'active'; ?>">
                    <a href="/superAdmin/stores/">المتاجر</a>
                </li>

                <li class="text-right <?php if($active == 'أضف متجر') echo 'active'; ?>">
                    <a href="/superAdmin/stores/add">أضف متجر</a>
                </li>
            </ul>
        </div>
    </div>
</nav>