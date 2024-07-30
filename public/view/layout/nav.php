<?php include ('../model/User.php'); ?>
<style>
        .nav{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 10px;
            background-color: white;
            margin-bottom: 30px;
            position: sticky;
            z-index:10;
            top:0;
            right:0;
            font-family: 'Signika', sans-serif;
        }
        .nav a .logo{
            width: 150px;
            height: 70px;
            object-fit: contain;
        }
        .nav .search{
            display: flex;
            justify-content: flex-start;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px 15px;
            gap: 10px;
            border-radius: 10px;
            position: relative;
        }
        .nav .search i{
            cursor: pointer;
        }
        .nav .search input{
            border: 0;
            background-color: transparent;
            width: 330px;
            outline: black;
            font-size: 15px;
        }
        .nav .search .result-search{
            position: absolute;
            top:100%;
            border: 2px solid #eeeeee;
            border-top:0;
            left:0;
            margin-top:10px;
            padding: 10px;
            background-color:white;
            border-radius:5px;
            width: 100%;
            display:none;
            flex-direction:column;
            gap:10px;
            max-height:450px;
            overflow: scroll;
            z-index: 50;
            overflow-x:hidden;
        }
        .nav .search .result-search::-webkit-scrollbar {
            width: 6px;
        }
        .nav .search .result-search::-webkit-scrollbar-thumb{
            border-radius: 20px;
            background-color: #d8b979;
            color: #f0f0f0;
        }
        .nav .search .result-search::-webkit-scrollbar-thumb:hover{
            background-color: #c6a45f;
        }
        .nav .search .result-search::-webkit-scrollbar-track {
            background-color: #ffffff;
        }
        .nav .search .result-search .item a{
            display:flex;
            align-items:center;
            gap:10px;
            background-color:white;
            transition:.2s ease-in-out;
        }
      
        .nav .search .result-search .item:hover{
            background-color:#f0f0f0;
        }
        .nav .search .result-search .item img{
            width: 50px;
            height: 50px;
            object-fit:cover;
        }
        .nav .search .result-search .item p{
            color:#c6a45f;
            font-size:17px;
            text-transform: capitalize;
        }
        .nav .search .result-search .item span{
            color:#6f5727;
            font-size:17px;
            text-transform: capitalize;
        }
        .nav .login{
            background-color: #d8b979;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 15px;
            transition: .2s ease-in-out;
            border: 1px solid #d8b979;
            box-shadow: 0 0 5px 0px rgb(190, 190, 190);
        }
        .nav .user{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 0 7px 0px rgb(190, 190, 190);

        }
        .nav .login:hover{
            background-color: white;
            color: #d8b979;
        }
        .nav .admin{
            display:flex;
            align-items:center;
            gap:20px;
        }
        .nav .admin .manager{
            padding:5px 15px;
            border-radius:10px;
            background-color:#d8b979;
            border:1px solid #d8b979;
            color:white;
            transition:.2s ease-in-out;
            box-shadow: 0 0 7px 0px rgb(190, 190, 190);
            font-family: 'Dosis', sans-serif;
        }
        .nav .admin .manager:hover{
            background-color:white;
            color:#d8b979;
        }
    </style>
    <div class="nav">
            <a href="./UserController.php?act=HomePage"><img class="logo" src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/logo.png" alt=""></a>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass" id="icon_search_input"></i>
                <input type="text" id="search_input" placeholder="Search something">
                <div class="result-search">
                <?php 
                    $n = new Product("","","","","","");
                    $t = $n->get();
                    while ($i = $t->fetch()){
                ?>
                        <div class="item item-result-search" name="<?=$i['name'];?>">
                            <a href="./UserController.php?act=Product&product=<?=$i['id'];?>">
                            <img src="../../public/uploads/<?=$i['image'];?>" alt="">
                            <div>
                                <p><?=$i['name'];?></p>
                                <span><?php calculate($i['price'],$i['discount']);?></span>
                            </div>
                        </a>
                        </div>
                <?php }?>
                </div>
            </div>
            <?php if(!isset($_SESSION['username']) || $_SESSION['username'] == null) {?>
                <a href="./UserController.php?act=Login" class="login">Login</a>
            <?php }else{?>
                <?php 
                    $n = new User($_SESSION['username'],"","","","","","","","");
                    $r = $n -> get_username();
                ?>
                <div class="admin">
                    <?php if($r['role'] == "staff") {?>
                    <a class="manager" href="./UserController.php?act=AdminOrder&option=list">Manager</a>
                    <?php }?>
                    <a href="./UserController.php?act=Account"><img class="user" src="../../public/uploads/<?= $r['image'];?>" alt=""></a>
                </div>
            <?php }?>
    </div>
    <script>
        if(document.querySelector('#search_input') != null){
        const search_input = document.querySelector('#search_input');
        const result_search = document.querySelector('.result-search');
        const icon_search_input = document.querySelector('#icon_search_input');
        const a_item_search = document.querySelectorAll(".a_item_search");
        const listItem = document.querySelectorAll(".item-result-search");
        listItem.forEach(e => {
            e.addEventListener('click',()=>{
                sessionStorage.setItem('scrollPostion',window.pageYOffset);
            })
        });
        search_input.addEventListener('input',()=>{
            icon_search_input.className = "fa-regular fa-circle-xmark";
            sessionStorage.setItem('search_content',search_input.value);
            const filter = search_input.value.toLowerCase();
            listItem.forEach((i) =>{
                let text = i.getAttribute('name');
                if(text.toLowerCase().includes(filter.toLowerCase())){
                    i.style.display = "";
                }else{
                    i.style.display = "none";
                }
            });
        })
        search_input.addEventListener('focus',()=>{
            search_input.value = sessionStorage.getItem('search_content');
            result_search.style.display = "flex";
            const filter = search_input.value.toLowerCase();
            listItem.forEach((i) =>{
                let text = i.getAttribute('name');
                if(text.toLowerCase().includes(filter.toLowerCase())){
                    i.style.display = "";
                }else{
                    i.style.display = "none";
                }
            });

            search_input.addEventListener('focusout',()=>{
                let time = setTimeout(() => {
                    result_search.style.display = "none";
                }, 200);
            })
        })
        if(sessionStorage.getItem('search_content') != null){
            search_input.value = sessionStorage.getItem('search_content');
        }else{
            sessionStorage.setItem('search_content',"");
        }
        icon_search_input.addEventListener('click',()=>{
            if(icon_search_input.className == "fa-regular fa-circle-xmark"){
                search_input.value ="";
                sessionStorage.setItem('search_content',"");
                icon_search_input.className = "fa-solid fa-magnifying-glass";
            }
        })
        if( search_input.value != ""){
            icon_search_input.className = "fa-regular fa-circle-xmark";
        }else{
            icon_search_input.className = "fa-solid fa-magnifying-glass";
        }
        }
    </script>