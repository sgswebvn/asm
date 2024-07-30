<style>
    #loader{
        background-color: #c0c0c083;
        width: 100%;
        height: 100vh;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
    }
    #loader .item{
        width: 20px;
        border-radius: 20px;
        height: 70px;
        background-color: #dde669;
        animation: loader 1.5s infinite ease-in-out ;
    }
    #loader .item:nth-child(1){
        animation: loader 1.5s 0.6s infinite ease-in-out ;
    }
    #loader .item:nth-child(2){
        animation: loader 1.5s 0.4s infinite ease-in-out ;
    }
    #loader .item:nth-child(3){
        animation: loader 1.5s 0.2s infinite ease-in-out ;
    }
    #loader .item:nth-child(4){
        animation: loader 1.5s 0.4s infinite ease-in-out ;
    }
    #loader .item:nth-child(5){
        animation: loader 1.5s 0.6s infinite ease-in-out ;
    }
    @keyframes loader{
        0%{
            height: 70px;
        }
        50%{
            height: 20px;
            background-color: #da9408;
        }
        100%{
            height: 70px;

        }
    }
</style>
<div id="loader">
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
</div>
<script>
    const loader = document.querySelector('#loader');
    window.addEventListener('load',function(){
        loader.style.display = 'none';
    })
</script>