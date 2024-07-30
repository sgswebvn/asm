if(document.querySelector('.btn-option') != null){
    const btn_option = document.querySelectorAll('.btn-option');
    const info_option = document.querySelectorAll('.info_option');
    const order_btn = document.querySelector('#order_btn');
    if(document.querySelector('#order_btn') != null){
        for (let i = 0; i < btn_option.length; i++) {
            function active(i){
                btn_option[i].classList = "active btn-option";
                btn_option[i].disabled = true;
                for (let e = 0; e < btn_option.length; e++){
                    if(btn_option[i] == btn_option[e]){
                        btn_option[e].classList = "active btn-option";
                        btn_option[e].disabled = true;
                    }else{
                        sessionStorage.setItem('btn_option' + e,"close");
                        btn_option[e].classList = "btn-option";
                        btn_option[e].disabled = false;
                    }
                }
                if(btn_option[i].getAttribute('type_option') == "delivery"){
                    info_option[i].style.display = "block";
                    order_btn.name = "order_deliver";
                    for (let e = 0; e < btn_option.length; e++){
                        if(btn_option[i] == btn_option[e]){
                            info_option[e].style.display = "block";
                        }else{
                            info_option[e].style.display = "none";
                        }
                    }
                }else{
                    info_option[i].style.display = "block";
                    order_btn.name = "order_store";
                    for (let e = 0; e < btn_option.length; e++){
                        if(btn_option[i] == btn_option[e]){
                            info_option[e].style.display = "block";
                        }else{
                            info_option[e].style.display = "none";
                        }
                    }
                }
            }
            if(sessionStorage.getItem('btn_option' + i) == "open"){
                active(i);
            }
            btn_option[i].addEventListener('click',()=>{
                if(btn_option[i].disabled == false){
                    sessionStorage.setItem('btn_option' + i,"open");
                    active(i);
                }
            })
            
        }
    }
    if(document.querySelector('#order_btn') != null){
        order_btn.addEventListener('click',()=>{
            sessionStorage.setItem('scrollPostion',window.pageYOffset);
        })
    }
}
document.querySelector('#return').addEventListener('click',()=>{
    window.location = "./UserController.php?act=Product";
})
if(document.querySelectorAll('.item-cart') != null){
    const price = document.querySelectorAll('.item-cart');
    const total = document.querySelectorAll('.total-cart-item');
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
        total[i].innerText = parseInt(price[i].getAttribute('price')) * parseInt(amount_number_item[i].textContent) + ".000đ";
            let sum = 0;
            total.forEach((i) => {
                let item = parseInt(i.textContent);
                sum+= item;
            })
            total_all.innerHTML = sum + ".000đ"; 
    }
    for(let i = 0; i<price.length;i++){
        calculate(i);   
    }
    let quantity = price.length;
    document.querySelector('.quantity_number').innerHTML = quantity;
}
if(document.querySelector('.total-all-cart') != null){
    const price = document.querySelector('.total-all-cart');
    const transport_fee = document.querySelector('.transport_fee');
    const total = document.querySelector('.total');
    const total_input = document.querySelector('#total_input');
    let sum = "";
    sum = parseInt(price.textContent) + parseInt(transport_fee.textContent);
    if(parseInt(sum) == 0){
        total.innerHTML = sum + "đ"; 
        total_input.value = sum + "đ";
    }else{
        total.innerHTML = sum + ".000đ"; 
        total_input.value = sum + ".000đ";
    }

}
if(sessionStorage.getItem('scrollPostion') != 0){
    window.scrollTo(0,sessionStorage.getItem('scrollPostion'));
    sessionStorage.setItem('scrollPostion', 0);
}