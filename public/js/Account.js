const upload_image = document.querySelector('#upload_image');
const status_image = document.querySelector('#status_image');
upload_image.addEventListener('click',()=>{
    input_image.click();
    input_image.addEventListener('change',()=>{
        if(input_image.value != null){
            status_image.innerHTML = "Uploaded";
        }else{
            status_image.innerHTML = "";
        }
    })
})
document.querySelector('.btn_update').addEventListener('click',()=>{
    sessionStorage.setItem('scrollPostion', window.pageYOffset);
})
if(sessionStorage.getItem('scrollPostion') != 0){
    window.scrollTo(0,sessionStorage.getItem('scrollPostion'));
    sessionStorage.setItem('scrollPostion', 0);
}