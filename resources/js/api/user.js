/*
	Imports the Roast API URL from the config.
*/
import { TASKLAND_CONFIG } from '../config.js';

export default {

  getUser: function(token){
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

    return axios.get( TASKLAND_CONFIG.API_URL + '/user' );
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

  logoutUser: function (token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

    return axios.post( TASKLAND_CONFIG.API_URL + '/logoutUser')
  },

  loadID: function (token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

    return axios.get( TASKLAND_CONFIG.API_URL + '/userId')
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