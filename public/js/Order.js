const cancel_btn = document.querySelectorAll('.cancel_btn');
for (let i = 0; i < cancel_btn.length; i++) {
    cancel_btn[i].addEventListener('click',()=>{
        let id_cancel = cancel_btn[i].getAttribute('id_order');
        sessionStorage.setItem('scrollPostion',window.pageYOffset);
        if(confirm('Do You Want To Cancel This Order?')){
            window.location = `./UserController.php?act=Order&cancel=${id_cancel}`;
        }
    })
}
const status = document.querySelectorAll('.status');
status.forEach(e => {
    if(e.textContent == "unconfirm"){
        e.innerHTML = "Unconfirm...";
        e.style.color = "#c6a45f";
    }else if(e.textContent == "cancel"){
        e.innerHTML = "Cancelled";
        e.style.color = "#ee4d2d";
    }else{
        e.innerHTML = "Confirmed";
        e.style.color = "#43ee2d";
    }
});
if(sessionStorage.getItem('scrollPostion') != 0){
    window.scrollTo(0,sessionStorage.getItem('scrollPostion'));
    sessionStorage.setItem('scrollPostion', 0);
}
