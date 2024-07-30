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
const confirm_btn = document.querySelectorAll('.confirm_btn');
for (let i = 0; i < confirm_btn.length; i++) {
    confirm_btn[i].addEventListener('click',()=>{
        let id_confirm = confirm_btn[i].getAttribute('id_order');
        sessionStorage.setItem('scrollPostion',window.pageYOffset);
        if(confirm('Do You Want To Confirm This Order?')){
            window.location = `./UserController.php?act=AdminOrder&option=list&confirm=${id_confirm}`;
        }
    })
}
const unconfirm_btn = document.querySelectorAll('.unconfirm_btn');
for (let i = 0; i < unconfirm_btn.length; i++) {
    unconfirm_btn[i].addEventListener('click',()=>{
        let id_unconfirm = unconfirm_btn[i].getAttribute('id_order');
        sessionStorage.setItem('scrollPostion',window.pageYOffset);
        if(confirm('Do You Want To Unconfirm This Order?')){
            window.location = `./UserController.php?act=AdminOrder&option=list&unconfirm=${id_unconfirm}`;
        }
    })
}
const delete_btn = document.querySelectorAll('.delete_btn');
for (let i = 0; i < delete_btn.length; i++) {
    delete_btn[i].addEventListener('click',()=>{
        let id_delete = delete_btn[i].getAttribute('id_order');
        sessionStorage.setItem('scrollPostion',window.pageYOffset);
        if(confirm('Do You Want To Delete This Order?')){
            window.location = `./UserController.php?act=AdminOrder&option=list&delete=${id_delete}`;
        }
    })
}
if(sessionStorage.getItem('scrollPostion') != 0){
    window.scrollTo(0,sessionStorage.getItem('scrollPostion'));
    sessionStorage.setItem('scrollPostion', 0);
}