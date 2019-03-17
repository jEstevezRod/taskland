<template>
<div id="fondo" class="columns">
    <div class="column is-flex justify-center align-center">

    <div id="container" class="has-margin-top-105">
        <h3>All you need</h3>
        <h1>taskland</h1>
        <h3>For everyone</h3>
    </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "HeroComponent"
    }
</script>

<style scoped>
    

    #fondo {
        background-color: rgb(245, 83, 83);
        font-family: 'Montserrat', sans-serif !important;
        margin: 0;
        height: 100%;
    }
    h1 {
        font-size: 5em;
        text-shadow: 5px 5px transparent, 8px 8px rgba(0, 0, 0, 0.19);
        margin: 0;
        -webkit-animation: slide-tr 1s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	    animation: slide-tr 1s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        font-weight: 800;
    }

    h3 {
        font-size: 1.5em;
        margin: 0 25px;
        font-weight: 600;
    }

    h3:before, h3:after {
        content: " ";
        position: absolute;
        border-top: 2px solid rgba(0,0,0, .3);
    }
    
    h3:nth-of-type(1):before{
        width: 3%;
        height: 4px;
        margin: 3% 0 0 -4%;
    }
    h3:nth-of-type(1):after{
        width: 45%;
        height: 4px;
        margin: 3% 0 0 2%;
    }
    h3:nth-of-type(2) {
        float: right;
        margin-top: -5%;
    }
    h3:nth-of-type(2):before{
        width: 100%;
        height: 4px;
        margin: 6% 0 0 -105%;
    }
    h3:nth-of-type(2):after{
        width: 10%;
        height: 4px;
        margin: 6% 0 0 3%;
    }


    h1, h3 {
        transform:matrix(1.00,-0.20,0.00,1.00,0,0);
        -ms-transform:matrix(1.00,-0.20,0.00,1.00,0,0);
        -webkit-transform:matrix(1.00,-0.20,0.00,1.00,0,0);
        text-transform: uppercase;
        color: rgba(224, 224, 224, 0.849) !important;
    }
    
    #container:before {
        content: " ";
        -webkit-clip-path: circle(50% at 50% 50%);
        clip-path: circle(50% at 50% 50%);
        background-color: rgba(0, 0, 0, 0.4);
        top: -350px; bottom: 0; left: 0; right: 0;
        position: absolute;
        margin: auto;
        height: 400px;
        width: 400px;
        animation: scale-up-hor-center 1s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }

    @media all and (max-width: 575px) { 
        #container:before {
            background-color: transparent;
        }
     }
    
@keyframes scale-up-hor-center {
  0% {
    transform: scale(0.1);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes slide-tr {
  0% {
    -webkit-transform: translateY(30) translateX(-100px) matrix(1.00,-0.20,0.00,1.00,0,0);
            transform: translateY(30px) translateX(-100px) matrix(1.00,-0.20,0.00,1.00,0,0);
  }
  100% {
    -webkit-transform: translateY(30px) translateX(10px) matrix(1.00,-0.20,0.00,1.00,0,0);
            transform: translateY(0px) translateX(0px) matrix(1.00,-0.20,0.00,1.00,0,0);
  }
}


</style>