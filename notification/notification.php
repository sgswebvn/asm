<style>
    #notification{
        position: fixed;
        bottom:70px;
        right:500px;
        z-index: 100;
        font-family: 'Dosis', sans-serif;
        font-weight:800;
    }
    .notification .item{
        background-color:white;
        color:#d8b979;
        font-size:19px;
        height: fit-content;
        display:flex;
        align-items:center;
        gap:10px;
        padding:10px 20px;
        border-radius:5px;
        border:2px solid #d8b979;
        width: 60vh;
        position: absolute;
        text-transform:capitalize;
        overflow: hidden;
    }
    .notification .item::after{
        content: "";
        width: 100%;
        height: 3px;
        position: absolute;
        bottom: 0;
        left: 100%;
        animation: notification_time 5s linear ;
    }
    .notification .fail::after{
        background-color: #de0404;
    }
    .notification .success::after{
        background-color: #00c324;
    }
    @keyframes notification_time {
        from{
            left:0;
        }
        to{
            left: 100%;
        }
    }
</style>
<body>
<script>
    let template = `<div class='notification' id='notification'></div>`;
    document.body.insertAdjacentHTML('beforeend', template);
</script>
<?php 
    function fail($content){
        echo"<script>
        document.querySelector('.notification').insertAdjacentHTML('afterbegin',`
                            <div class='item fail'>
                                <i class='fa-regular fa-circle-xmark'></i>
                                <p>". $content ."</p>
                            </div>`);
        let setTimeOut = setTimeout(()=>{
        document.querySelector('.notification').removeChild(document.querySelector('.notification').firstElementChild);
        }, 5000);
    </script>";
    }
    function success($content){
        echo"<script>
        document.querySelector('.notification').insertAdjacentHTML('afterbegin',`
                            <div class='item success'>
                                <i class='fa-regular fa-circle-check'></i>
                                <p>". $content ."</p>
                            </div>`);
        let setTimeOut = setTimeout(()=>{
        document.querySelector('.notification').removeChild(document.querySelector('.notification').firstElementChild);
        }, 5000);
    </script>";
    }
?>
</body>
