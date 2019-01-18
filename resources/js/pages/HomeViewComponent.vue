<template>
  <div>

    <up-side-component></up-side-component>

    <!--<b-modal :active.sync="!userWithPass.hasPassword" >-->
      <!--<section class="box">-->
        <!--<div class="p-5">-->
          <!--<p class="title has-text-centered">Set a password</p>-->
          <!--<p>You didn't set any password because you logged by a social media account.</p>-->
          <!--<p>It's for that reason that should set a passwork for you account in this website :</p>-->

        <!--</div>-->
        <!--<b-field label="Password">-->
          <!--<b-input type="password" v-model="password" password-reveal placeholder="Your password"></b-input>-->
        <!--</b-field>-->
        <!--<b-field label="Write your password again">-->
          <!--<b-input type="password" v-model="password2" password-reveal placeholder="Repeat password"></b-input>-->
        <!--</b-field>-->
        <!--<div class="field">-->
          <!--<div class="control has-text-centered">-->
            <!--<a class="button is-info" @click="setPassword">Set password</a>-->
          <!--</div>-->
        <!--</div>-->
        <!--<p>{{infoo}}</p>-->
      <!--</section>-->
    <!--</b-modal>-->

    <p>{{isLogged}}</p>

    <administration-component></administration-component>

    <cookie-law theme="dark-lime">
      <div slot-scope="props" class="w-100 has-text-centered">
        <span>This website uses cookies to ensure you get the best experience on our website.</span>
        <button class="skew button is-danger is-pulled-right m-5" @click="props.close">
          <span>Ignore me</span>
        </button>
        <button class="skew button is-success is-pulled-right m-5" @click="props.accept">
          <span>I accept</span>
        </button>
      </div>
    </cookie-law>

    <feed-component></feed-component>

  </div>
</template>

<script>
import CookieLaw from "vue-cookie-law";
import UpSideComponent from "../components/main/UpSideComponent.vue";
import AdministrationComponent from "../components/main/AdministrationComponent.vue";
import FeedComponent from "../components/main/FeedComponent.vue";
import { mapGetters } from 'vuex'
export default {
  name: "MainComponent",
  data() {
    return {
      password: "",
      password2: "",
      responsePassword: "",
      isCardModalActive: false,
      hasPass: '',
      data2: '',
    };
  },
  components: {
    CookieLaw,
    UpSideComponent,
    AdministrationComponent,
    FeedComponent
  },
  created() {
    this.$store.dispatch("loadUser");
  },
  mounted() {
    this.data2 = this.$store.getters.getUser;

  },
  computed: mapGetters([
    'isLogged', 'getUser', "getToken"
  ]),

  methods: {

    setPassword: function() {
      this.$store.dispatch("putFirstPassword", {
        password: this.password
      })
      this.isCardModalActive = false;
    },

    logout: function() {
      this.$store.dispatch("logoutUser")
    }
  }
};
</script>

<style scoped>
.w-100 {
  width: 100%;
}
.m-5 {
  margin: 0 5px;
}
.p-5 {
  padding: 15px 0;
}
.hidden {
  visibility: hidden
}
</style>