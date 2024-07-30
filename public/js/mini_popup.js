let td_content = document.querySelectorAll('.td');
for(let i = 0; i < td_content.length; i++){
   let origin_td = td_content[i].textContent;
    if(td_content[i].textContent.length > 10){
        td_content[i].innerHTML = td_content[i].textContent.slice(0,10) + "...";
    }
    td_content[i].addEventListener('mouseenter',()=>{
        if(td_content[i].textContent.length > 10){
            let p = document.createElement('p');
            p.innerText = origin_td;
            p.classList = "popup";
            td_content[i].appendChild(p);
        }
    })
    td_content[i].addEventListener('mouseleave',()=>{
        if(td_content[i].textContent.length > 10){
        td_content[i].removeChild(td_content[i].lastElementChild);
        }
    })
   
}