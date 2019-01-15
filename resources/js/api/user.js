/*
	Imports the Roast API URL from the config.
*/
import { TASKLAND_CONFIG } from '../config.js';

export default {

  getUser: function(token){
    return axios.get( TASKLAND_CONFIG.API_URL + '/user?token=' + token );
  },

  getUserHasPassword: function() {
    return axios.get( TASKLAND_CONFIG.API_URL + '/userCheckPass');
  },

  setFirstPassword: function(password) {
    return axios.put( TASKLAND_CONFIG.API_URL + '/setPassword/', { password : password});
  },

  postCreateUser: function(data){
    return axios.post( TASKLAND_CONFIG.API_URL + '/newUser', {
      name: data.name,
      email: data.email,
      password: data.password,
      passwordConfirmation: data.passwordConfirmation});
  },

  getLoginUser: function (data) {
    return axios.post( TASKLAND_CONFIG.API_URL + '/loginUser', {
      email: data.email,
      password: data.password
    })
  },
  getLoginUserGithub: function () {
    return axios.get('http://localhost:8000/login/github')
        .then( function (data) {
          console.log(data);
          router.push('main')
        })
  }
  ,

  logoutUser: function (token) {
    return axios.post( TASKLAND_CONFIG.API_URL + '/logoutUser?token=' + token)
  }

  /*
    PUT  /api/v1/user
  */
  /* putUpdateUser: function( public_visibility, favorite_coffee, flavor_notes, city, state ){
    return axios.put( TASKLAND_CONFIG.API_URL + '/user',
      {
        public_visibility: public_visibility,
        favorite_coffee: favorite_coffee,
        flavor_notes: flavor_notes,
        city: city,
        state: state
      }
    ); */
  /*}  */
}