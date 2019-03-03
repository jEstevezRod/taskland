<template>
            <div class="column is-three-fifths-mobile is-offset-one-fifth-mobile is-4-tablet is-3-desktop" >
          <div class="my-box">
            <figure class="is-flex justify-center">
              <div class="image is-64x64">
                <img src="https://bulma.io/images/placeholders/128x128.png">
              </div>
            </figure>
            <div class="is-flex flex-column has-text-centered has-padding-5 ">
              <strong class="is-capitalized">{{user.name}}</strong>
              <small>@{{user.name}}{{user.id}}</small>
            </div>
          </div>
        </div>
</template>

<script>
import { TASKLAND_CONFIG } from '../../config.js';

export default {
    props: ['member'],
    data(){
      return {
        user : {}
      }
    },
    mounted(){
        console.log(this.member)
      axios.get(TASKLAND_CONFIG.API_URL + `/user/${this.member.user_id}` )
      .then( response => {
        this.user = response.data.user;
      })
    }

}
</script>

<style scoped>
.my-box {
  padding: 10px;
  border: 1px solid #d3d3d3;
  border-radius: 7px;
  display: flex;
  flex-flow: column nowrap;
}


</style>
