<template>
<div>

    <nav class="level">
      <!-- Left side -->
      <div class="level-left">
        <div class="level-item">
          <img src width="60px" height="40px">
        </div>
      </div>
      <!-- Right side -->
      <div class="level-right"></div>
    </nav>
    <div id="flow">
      <span class="flow-1"></span>
      <span class="flow-2"></span>
      <span class="flow-3"></span>
    </div>
    <div class="container is-fluid">
      <div class="columns is-vcentered full-height">
        <div class="column has-text-centered is-6">
          <div class="animated fadeInDown">
            <p class="is-size-1 is-size-3-mobile title">Taskland</p>
            <p class="m-5">Your team needs a better way to stay organized</p>
            <section>
            <!--<section v-if="!userData">-->
              <div class="field is-grouped is-grouped-centered m-5">
                <p class="control">
                  <a
                    class="button is-medium is-danger is-outlined"
                    @click="isComponentModalLogin = true"
                  >LOGIN</a>
                </p>

                <p class="control">
                  <a
                    class="button is-medium is-info is-outlined"
                    @click="isComponentModalRegister = true"
                  >REGISTER</a>
                </p>
              </div>
            </section>
          </div>
        </div>
        <div class="column is-6">
          <div class="animated fadeInUp is-size-6">
            <img class="image is-hidden-mobile" src alt>
             <img class="image is-hidden-mobile" src="../../../public/images/schema4.png" alt="">
            <div class="columns">
              <div class="column is-1">
                <img src="../../../public/images/arrow-tomato.png">
              </div>
              <div class="column is-11">
                <p>
                  Organize and manage your team’s plans, projects, and processes with Joy Nuts.
                  And empower everyone to focus on the work that grows your business.
                </p>
              </div>
            </div>
            <div class="columns">
              <div class="column is-1">
                <img src="../../../public/images/arrow-tomato.png">
              </div>
              <div class="column is-11">
                <p>
                  Keep your priorities straight and your goals in sight. Customize dashboards so you only see what
                  you want to see.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b-modal :active.sync="isComponentModalLogin" >
      <login></login>
    </b-modal>
    <b-modal :active.sync="isComponentModalRegister" >
      <register ></register>
    </b-modal>
  </div>

</template>

<script>
import Login from "./Login";
import Register from "./Register";
import router from "../routes"

import { mapGetters } from 'vuex'
export default {
  components: { Login, Register },
  data() {
    return {
      userInformation: null,
      isComponentModalLogin: false,
      isComponentModalRegister: false,
      LoginProps: {
        email: "",
        password: ""
      },

    };
  },
  computed: mapGetters([
    'isLogged', 'getUser'
  ]),
  created(){this.$store.dispatch("loadUser");},
  mounted() {
    // console.log(this.getUser)
    // if (Object.entries(this.getUser).length > 0) {
    //   router.push('Main')
    // }

  },
  methods: {
    logout: function() {
      this.$store.dispatch("logoutUser")
    }
  }
};
</script>

<style scoped>


.h-100 {
    height: 100%;
}

.jc-right {
    justify-content: flex-end;
}

.ma-5 {
    margin: 0px 15px;

}
.full-height {
    height: 100vh;
}

.level-item > img {
    z-index: 21;
}
.m-5 {
    margin-top: 30px;
}
.m-4 {
    margin: 0px 5px;
}

body > div > nav > div {
    font-size: 19px;
    color: #f8f2f5;
}

#login, #login > a, #register, #register a {
    z-index: 999;
    color: #575757;
    font-weight: 400;
}

nav > div.level-right > p > strong > a {
    font-family: 'Montserrat', sans-serif;
    color: #fffdf5;
    margin-left: 30px;
}

nav > div.level-right > p > strong > a:hover {
    color: #253674;
}


nav > div.level-left > div > img {
    margin-top: 10px;
}

.title {
    font-family: 'Waiting for the Sunrise', cursive;
    font-size: 110px !important;
}


#flow span {
    display: block;
    width: 200vw;
    height: 200vw;
    position: absolute;
    top: -180vw;
    left: -50vw;
    border-radius: 90vw;
    opacity: 0.6;
}

.flow-1 {
    background: #3281ff;
    -webkit-animation: rotating 20s linear infinite;
    -moz-animation: rotating 20s linear infinite;
    -ms-animation: rotating 20s linear infinite;
    -o-animation: rotating 20s linear infinite;
    animation: rotating 20s linear infinite;
}

.flow-2 {
    background: #f442ee;
    position: absolute;
    -webkit-animation: rotating 15s linear infinite;
    -moz-animation: rotating 15s linear infinite;
    -ms-animation: rotating 15s linear infinite;
    -o-animation: rotating 15s linear infinite;
    animation: rotating 15s linear infinite;
}

.flow-3 {
    background: #42eef4;
    position: absolute;
    -webkit-animation: rotating 7s linear infinite;
    -moz-animation: rotating 7s linear infinite;
    -ms-animation: rotating 7s linear infinite;
    -o-animation: rotating 7s linear infinite;
    animation: rotating 7s linear infinite;
}

@-webkit-keyframes rotating {
    from {
        -ms-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -ms-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes rotating {
    from {
        -ms-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -ms-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}


section {
    margin: 1em auto;
    max-width: 680px;
}

.modal-content {
    display: block;
    margin: 2em auto;
    max-width: 100vh;
    padding: 10px;
}

[class*="close-"] {
    border: 2px solid;
    border-radius: 100%;
    color: #FF3860;
    cursor: pointer;
    display: block;
    font-size: 1.75em;
    height: 50px;
    line-height: 50px;
    margin: 1em auto;
    overflow: hidden;
    padding: 0;
    position: relative;
    width: 50px;
}

.thum {
    display: block;
    overflow: hidden;
    position: relative;
    width: initial;
}


@media only screen and (min-width: 1024px) {
    .modal-content {
        padding: 0;
    }
    .thum img {
        width: 32%;
        -webkit-transition: all .45s ease-in-out;
        -moz-transition: all .45s ease-in-out;
        transition: all .45s ease-in-out;
    }
}

@media only screen and (max-width: 340px) {
    .thum img {
        display: block;
        margin: 0 auto 8px;
        width: 100%;
        -webkit-transition: all .45s ease-in-out;
        -moz-transition: all .45s ease-in-out;
        transition: all .45s ease-in-out;
    }
}

</style>
