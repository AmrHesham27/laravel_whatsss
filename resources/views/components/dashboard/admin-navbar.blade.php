<nav id="sidebar">
    <div class="nav-body">
        <button class="close-btn toggle-view">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="p-4 pt-5 nav-body">
            <ul class="list-unstyled components mb-5">
                <li class="text-right <?php if($active == 'الصفحة الرئيسية') echo 'active'; ?>">
                    <a href="/admin">الصفحة الرئيسية</a>
                </li>

                <li class="text-right <?php if($active == 'عدل متجرك') echo 'active'; ?>">
                    <a href="/admin/editStore">عدل متجرك</a>
                </li>

                <li class="text-right <?php if($active == 'التصنيفات') echo 'active'; ?>">
                    <a href="/admin/categories">التصنيفات</a>
                </li>

                <li class="text-right <?php if($active == 'أضف تصنيف') echo 'active'; ?>">
                    <a href="/admin/categories/create">أضف تصنيف</a>
                </li>

                <li class="text-right <?php if($active == 'المنتجات') echo 'active'; ?>">
                    <a href="/admin/products">المنتجات</a>
                </li>

                <li class="text-right <?php if($active == 'أضف منتج') echo 'active'; ?>">
                    <a href="/admin/products/create">أضف منتج</a>
                </li>

                <li class="text-right <?php if($active == 'الكوبونات') echo 'active'; ?>">
                    <a href="/admin/coupons">الكوبونات</a>
                </li>

                <li class="text-right <?php if($active == 'أضف كوبون') echo 'active'; ?>">
                    <a href="/admin/coupons/create">أضف كوبون</a>
                </li>
            </ul>
        </div>
    </div>

</nav>