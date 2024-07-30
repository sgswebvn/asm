        <style>
            .nav-admin{
                display: flex;
                flex-direction: column;
                background-color: #d8b979;
                width: 20% ;
                padding: 10px;
            }
            .nav-admin>.item{
                display: flex;
                flex-direction: column;
                padding: 10px 0;
                border-bottom: 1px solid #755719;
            }
            .nav-admin>.item:first-child{
                border-top: 1px solid #755719;
            }
            .nav-admin>.item:last-child{
                border: 2px solid transparent;
                background-color:#b9a06f;
                margin-top:10px;
                border-radius:5px;
                cursor: pointer;
            }
            .nav-admin>.item:last-child:hover{
                border: 2px solid white;
                transition:.2s ease-in-out;
            }
            .nav-admin>.item .name{
                padding: 0 15px 0px;
                display: flex;
                gap: 10px;
                font-size: 17px;
                color: white;
                cursor: pointer;
                justify-content: space-between;
            }
            .nav-admin>.item .name i{
                transition:.2s ease-in-out;
            }
            .nav-admin>.item .items{
                overflow: hidden;
                display:flex;
                flex-direction:column;
                gap:5px;
            }
            .nav-admin>.item .items div{
                padding-left: 10px;
                background-color: #dfc083;
                border-radius: 5px;
                display: flex;
                gap: 10px;
                padding: 10px;
                font-size: 15px;
                color: white;
                border-left:2px solid transparent;
                transition:.2s ease-in-out;
            }
            .nav-admin>.item .items .active{
                border-left:2px solid #ae7502;
                background-color: #f3deb5;
                box-shadow: 0 0 5px 0px rgb(190, 190, 190);
                
            }
            .nav-admin>.item .items div:hover{
                border-left:2px solid #ae7502;
                background-color: #f3deb5;
            }
        </style>
        <div class="nav-admin">
            <div class="item">
                <div class="name name-nav-admin">
                    <p>Category</p>
                    <i class="fa-solid fa-caret-right icon-name-nav-admin" style="<?php if($_GET['act'] == "AdminCategory") echo"transform:rotate(90deg);";else echo"transform:rotate(0deg);";?>"></i>
                </div>
                <div class="items items-nav-admin" style="<?php if($_GET['act'] == "AdminCategory") echo"height:auto;";else echo"height:0px;";?>">
                   <a href="./UserController.php?act=AdminCategory&option=list">
                    <div <?php if($_GET['act'] == "AdminCategory" && $_GET['option'] == "list") echo"class='active'";?>>
                    <i class="fa-solid fa-list-check"></i>
                        <p>Manager</p>
                    </div>
                    </a>
                    <a href="./UserController.php?act=AdminCategory&option=add">
                    <div <?php if($_GET['act'] == "AdminCategory" && $_GET['option'] == "add") echo"class='active'";?>>
                        <i class="fa-solid fa-plus"></i>
                        <p>Add New</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="name name-nav-admin">
                    <p>Product</p>
                    <i class="fa-solid fa-caret-right icon-name-nav-admin" style="<?php if($_GET['act'] == "AdminProduct") echo"transform:rotate(90deg);";else echo"transform:rotate(0deg);";?>"></i>
                </div>
                <div class="items items-nav-admin" style="<?php if($_GET['act'] == "AdminProduct") echo"height:auto;";else echo"height:0px;";?>">
                   <a href="./UserController.php?act=AdminProduct&option=list">
                    <div <?php if($_GET['act'] == "AdminProduct" && $_GET['option'] == "list") echo"class='active'";?>>
                    <i class="fa-solid fa-list-check"></i>
                        <p>Manager</p>
                    </div>
                    </a>
                    <a href="./UserController.php?act=AdminProduct&option=add">
                    <div <?php if($_GET['act'] == "AdminProduct" && $_GET['option'] == "add") echo"class='active'";?>>
                        <i class="fa-solid fa-plus"></i>
                        <p>Add New</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="name name-nav-admin">
                    <p>User</p>
                    <i class="fa-solid fa-caret-right icon-name-nav-admin" style="<?php if($_GET['act'] == "AdminUser") echo"transform:rotate(90deg);";else echo"transform:rotate(0deg);";?>"></i>
                </div>
                <div class="items items-nav-admin" style="<?php if($_GET['act'] == "AdminUser") echo"height:auto;";else echo"height:0px;";?>">
                   <a href="./UserController.php?act=AdminUser&option=list">
                    <div <?php if($_GET['act'] == "AdminUser" && $_GET['option'] == "list") echo"class='active'";?>>
                    <i class="fa-solid fa-list-check"></i>
                        <p>Manager</p>
                    </div>
                    </a>
                    <a href="./UserController.php?act=AdminUser&option=add">
                    <div <?php if($_GET['act'] == "AdminUser" && $_GET['option'] == "add") echo"class='active'";?>>
                        <i class="fa-solid fa-plus"></i>
                        <p>Add New</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="name name-nav-admin">
                    <p>Order</p>
                    <i class="fa-solid fa-caret-right icon-name-nav-admin" style="<?php if($_GET['act'] == "AdminOrder") echo"transform:rotate(90deg);";else echo"transform:rotate(0deg);";?>"></i>
                </div>
                <div class="items items-nav-admin" style="<?php if($_GET['act'] == "AdminOrder") echo"height:auto;";else echo"height:0px;";?>">
                   <a href="./UserController.php?act=AdminOrder&option=list">
                    <div <?php if($_GET['act'] == "AdminOrder" && $_GET['option'] == "list") echo"class='active'";?>>
                    <i class="fa-solid fa-list-check"></i>
                        <p>Manager</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <a href="./UserController.php?act=Product" class="name name-nav-admin">
                    <p>Home</p>
                    <i class="fa-solid fa-house"></i>
                </a>
            </div>
        </div>
<script>
    const name_nav_admin = document.querySelectorAll('.name-nav-admin');
    const icon_name_nav_admin = document.querySelectorAll('.icon-name-nav-admin');
    const items_nav_admin = document.querySelectorAll('.items-nav-admin');
    for(let i = 0; i < name_nav_admin.length; i++){
        if(sessionStorage.getItem('name_nav_admin' + i) == "open"){
            name_nav_admin[i].style.padding = "0px 15px 10px";
                items_nav_admin[i].style.height = "auto";
                icon_name_nav_admin[i].style.transform = "rotate(90deg)";
        }else{
            if(items_nav_admin[i].style.height == "0px"){
                name_nav_admin[i].style.padding = "0px 15px 0px";
                items_nav_admin[i].style.height = "0px";
                icon_name_nav_admin[i].style.transform = "rotate(0deg)";
            }
        }
        if(icon_name_nav_admin[i].style.transform == "rotate(90deg)"){
            name_nav_admin[i].style.padding = "0px 15px 10px";
        }
        name_nav_admin[i].addEventListener('click',function(){
            if(items_nav_admin[i].style.height != "0px"){
                sessionStorage.setItem('name_nav_admin' + i,"close");
                name_nav_admin[i].style.padding = "0px 15px 0px";
                items_nav_admin[i].style.height = "0px";
                icon_name_nav_admin[i].style.transform = "rotate(0deg)";
            }else{
                sessionStorage.setItem('name_nav_admin' + i,"open");
                name_nav_admin[i].style.padding = "0px 15px 10px";
                items_nav_admin[i].style.height = "auto";
                icon_name_nav_admin[i].style.transform = "rotate(90deg)";

            }
        })
    }
</script>