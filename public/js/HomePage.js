document.querySelector('#ShowAll').addEventListener('click', function(){
    window.location = 'UserController.php?act=Product';
})
const search_input = document.querySelector('#search_input');
const icon_search_input = document.querySelector('#icon_search_input');
icon_search_input.addEventListener('click',()=>{
    console.log('clicked')
    if(search_input.style.width == "30vh" && search_input.style.backgroundColor == "white" && icon_search_input.className == "fa-solid fa-magnifying-glass"){
        search_input.style.width = "0px";
        search_input.style.backgroundColor = "transparent";
    }else{
        search_input.style.width = "30vh";
        search_input.style.backgroundColor = "white";
    }
    const result_search = document.querySelector('.result-search');
    const listItem = document.querySelectorAll(".item-result-search");
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
})
if(document.querySelector('.info_name') != null){
    const info_name = document.querySelectorAll('.info_name');
    for (let i = 0; i < info_name.length; i++) {
        console.log(info_name[i].textContent);
        if(info_name[i].textContent.length > 17){
            info_name[i].innerHTML = info_name[i].textContent.slice(0,17) + "...";
        }
    }
}
const product = document.querySelectorAll('.product');
for (let i = 0; i < product.length; i++) {
    if(i >= 8){
        product[i].style.display = "none";
    }
}

