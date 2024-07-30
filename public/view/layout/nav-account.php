        <style>
            .nav-account{
                display: flex;
                flex-direction: column;
            }
            .nav-account .item{
                display: flex;
                gap: 7px;
                font-size: 15px;
                align-items: center;
                padding: 20px;
                width: 300px;
                border-top: 1px solid #dcdcdc;
                color: #787878;
                border-left: 2px solid transparent;
                transition: .2s ease-in-out;
                text-transform: capitalize;
            }
            .nav-account .item:hover{
                background-color: #eeeeee;
                color: black;
                border-left: 2px solid #d8b979;
            }
            .nav-account a:last-child .item{
                border-bottom: 1px solid #dcdcdc;
            }
            .nav-account .active{
                border-left: 2px solid #d8b979;
                color: black;
            }
        </style>
        <div class="nav-account">
            <a href="./UserController.php?act=Product">
                <div class="item">
                <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Return</p>
                </div>
            </a>
            <a href="./UserController.php?act=Account">
                <div class="item <?php if($_GET['act'] == "Account") echo"active";?>">
                    <i class="fa-regular fa-user"></i>
                    <p>Account information</p>
                </div>
            </a>
            <a href="./UserController.php?act=Order">
                <div class="item <?php if($_GET['act'] == "Order") echo"active";?>">
                    <i class="fa-solid fa-prescription-bottle"></i>
                    <p>My order</p>
                </div>
            </a>
            <a href="./UserController.php?act=Promotion">
                <div class="item <?php if($_GET['act'] == "Promotion") echo"active";?>">
                <i class="fa-solid fa-ticket"></i>
                    <p>Promotion</p>
                </div>
            </a>
            <a onclick="return confirm('Do You Want To Log Out?');" href="./UserController.php?act=Logout">
                <div class="item">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p>Log out</p>
                </div>
            </a>
        </div>