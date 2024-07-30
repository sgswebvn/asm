if(document.querySelector('#detail') != null){
    const detail = document.querySelector('#detail');
    const exit_detail = document.querySelector('#exit-detail');
    function hide(){
        detail.style.display = "none";
        sessionStorage.setItem('scrollPostion',window.pageYOffset);
        window.location = "./UserController.php?act=Product";
    }
    exit_detail.addEventListener('click',hide);
    document.body.addEventListener('click', function(e){
        if(e.target.matches("#detail")){
            hide();
        }
    });
}
if(document.querySelector('.name-list-product') != null){
const name_list_product = document.querySelectorAll('.name-list-product');
const icon_name_list_product = document.querySelectorAll('.icon-name-list-product');
const list_item = document.querySelectorAll('.list-item');
function check_name_list_product(i){
    if(sessionStorage.getItem('name_list_product' + i) != "auto" || sessionStorage.getItem('name_list_product' + i) == null) {
        list_item[i].style.height = "auto";
        icon_name_list_product[i].style.transform = "rotate(0deg)";
    }else{
        list_item[i].style.height = "0px";
        icon_name_list_product[i].style.transform = "rotate(180deg)";
    }
}
for(let i = 0; i < name_list_product.length; i++){
    check_name_list_product(i);
    name_list_product[i].addEventListener('click',function(){
        // console.log('clicked')   
        sessionStorage.setItem('name_list_product' + i,list_item[i].style.height);
        if(list_item[i].style.height != "0px"){
            list_item[i].style.height = "0px";
            icon_name_list_product[i].style.transform = "rotate(180deg)";
        }else{
            list_item[i].style.height = "auto";
            icon_name_list_product[i].style.transform = "rotate(0deg)";
        }
        check_name_list_product(i);
    })
}
}
const name_detail_item = document.querySelectorAll('.name-detail-item');
const icon_detail_item = document.querySelectorAll('.icon-detail-item');
const contain_detail_item = document.querySelectorAll('.contain-detail-item');
for(let i = 0; i < name_detail_item.length; i++){
    name_detail_item[i].addEventListener('click',function(){
        if(contain_detail_item[i].style.height != "0px"){
            contain_detail_item[i].style.height = "0px";
            icon_detail_item[i].style.transform = "rotate(180deg)";
        }else{
            contain_detail_item[i].style.height = "auto";
            icon_detail_item[i].style.transform = "rotate(0deg)";

        }
    })
}
if(document.querySelectorAll('.price-item') != null){
    const price_item = document.querySelector('.price-item');
    const total = document.querySelector('.total-item');
    const increase_amount_number = document.querySelectorAll('.increase-amount-number');
    const decrease_amount_number = document.querySelectorAll('.decrease-amount-number');
    const amount_number = document.querySelector('.amount-number');
    function calculate(i){
        total.innerText = "+ " + parseInt(price_item.textContent) * parseInt(amount_number.textContent) + ".000đ";
    }
    if(document.querySelector('.total-item') != null){
        const name_item = document.querySelector('.name_item');
        const option_item = document.querySelectorAll('.option-item');
        const id_product = document.querySelector('.id_product');
        total.addEventListener('click',()=>{
            sessionStorage.setItem('scrollPostion',window.pageYOffset);
            let quantity = amount_number.textContent;
            let name = name_item.textContent;
            let price = price_item.textContent;
            let id = id_product.getAttribute("id_product");
            let option = "";
            let image = id_product.getAttribute("image");
            for (let i = 0; i < option_item.length; i++){
                if(option_item[i].checked == true){
                    if(option === ""){
                        option = option_item[i].value;
                    }else{
                        option = option + ", " + option_item[i].value;
                    }
                }
            }
            window.location = `./UserController.php?act=Product&id=${id}&name=${name}&price=${price}&quantity=${quantity}&option=${option}&image=${image}`;
        })
    }
    for(let i = 0; i<increase_amount_number.length;i++){
        increase_amount_number[i].addEventListener('click',()=>{
            amount_number.innerText = parseInt(amount_number.textContent) + 1;
            calculate(i);
        })
        decrease_amount_number[i].addEventListener('click',()=>{
           if(parseInt(amount_number.textContent) > 1){
               amount_number.innerText = parseInt(amount_number.textContent) - 1;
               calculate(i);
           }
        })
    }
}
if(document.querySelectorAll('.item-cart') != null){
    const price = document.querySelectorAll('.item-cart');
    const total = document.querySelectorAll('.total-cart-item');
    const increase_amount_number = document.querySelectorAll('.increase-amount-cart');
    const decrease_amount_number = document.querySelectorAll('.decrease-amount-cart');
    const amount_number = document.querySelectorAll('.amount-cart');
    const amount_number_item = document.querySelectorAll('.amount-cart-item');
    const total_all = document.querySelector('.total-all-cart');
        let sum = 0;
        total.forEach((i) => {
            let item = parseInt(i.textContent);
            sum+= item;
        })
        if(sum == 0){
            total_all.innerHTML = sum + "đ"; 
        }else{
            total_all.innerHTML = sum + ".000đ"; 
        }
    function calculate(i){
        total[i].innerText = parseInt(price[i].getAttribute('price')) * parseInt(amount_number[i].textContent) + ".000đ";
            let sum = 0;
            total.forEach((i) => {
                let item = parseInt(i.textContent);
                sum+= item;
            })
            total_all.innerHTML = sum + ".000đ"; 
    }
    for(let i = 0; i<price.length;i++){
        let id_product = price[i].getAttribute('id_product');
        calculate(i);
        increase_amount_number[i].addEventListener('click',()=>{
            amount_number[i].innerText = parseInt(amount_number[i].textContent) + 1;
            amount_number_item[i].innerText = parseInt(amount_number[i].textContent);
            calculate(i);
            sessionStorage.setItem('scrollPostion',window.pageYOffset);
            window.location = `./UserController.php?act=Product&id_product=${id_product}&change_quantity=${parseInt(amount_number[i].textContent)}`;
        })
        decrease_amount_number[i].addEventListener('click',()=>{
           if(parseInt(amount_number[i].textContent) > 1){
               amount_number[i].innerText = parseInt(amount_number[i].textContent) - 1;
                amount_number_item[i].innerText = parseInt(amount_number[i].textContent);
                calculate(i);
                sessionStorage.setItem('scrollPostion',window.pageYOffset);
                window.location = `./UserController.php?act=Product&id_product=${id_product}&change_quantity=${parseInt(amount_number[i].textContent)}`;
           }
        })
        
    }
}
if(document.querySelector('.item-product') != null){
    let input_display = document.querySelectorAll('.input_display');
    let item_product = document.querySelectorAll('.item-product');
    function check_input_checked(i){
        if(sessionStorage.getItem('input_checked' + i) == "true" || sessionStorage.getItem('input_checked' + i) == null){
            input_display[i].checked = true;
            item_product[i].style.height = "auto";
        }else{
            input_display[i].checked = false;
            item_product[i].style.height = "0px";
        }
    }
    for(let i = 0; i<input_display.length;i++){
        // sessionStorage.setItem('input_checked' + i,input_display[i].checked);
        check_input_checked(i);
        input_display[i].addEventListener('change',()=>{
            sessionStorage.setItem('input_checked' + i,input_display[i].checked);
            if(input_display[i].checked == "true"){
                item_product[i].style.height = "auto";
            }else{
                item_product[i].style.height = "0px";
            }
            check_input_checked(i);
        })
    }
}
if(document.querySelector('.item_product_small') != null){
    const item_product_small = document.querySelectorAll('.item_product_small');
    for (let i = 0; i < item_product_small.length; i++) {
        let id_product = item_product_small[i].getAttribute('id_product');
        item_product_small[i].addEventListener('click',()=>{
            sessionStorage.setItem('scrollPostion',window.pageYOffset);
            window.location = `./UserController.php?act=Product&product=${id_product}`;
        })
    }
}
if(document.querySelector(".delete_item_cart") != null){
    const delete_item_cart = document.querySelectorAll(".delete_item_cart");
    delete_item_cart.forEach((e)=>{
        e.addEventListener('click',()=>{
            sessionStorage.setItem('scrollPostion',window.pageYOffset);
        })
    })
}
if(document.querySelector('.pay_btn') != null){
    document.querySelector('.pay_btn').addEventListener('click',()=>{
        window.location = "./UserController.php?act=Checkout";
    })
}
if(sessionStorage.getItem('scrollPostion') != 0){
    window.scrollTo(0,sessionStorage.getItem('scrollPostion'));
    sessionStorage.setItem('scrollPostion', 0);
}
