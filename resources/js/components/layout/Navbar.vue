<template>
    <div class="navbar has-shadow is-fixed-top">
        <div class="container is-fluid">
            <div class="navbar-brand is-primary">
            <!-- Branding Image -->
            <span class="navbar-item">
                <router-link class="navbar-main-item" to="/" exact>
                      {{this.appName}}
                </router-link>
            </span>

            <!-- Collapsed Hamburger -->
            <span class="navbar-burger burger is-hoverable" @click="toggleMenu" :class="{'is-active': navIsActive}" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </div>

        <div class="navbar-menu" id="navMenu" :class="{'is-active': navIsActive}">
            <!-- Left Side Of Navbar -->
            <div class="navbar-start">
              <div class="navbar-item" v-if="this.$route.path !='/'">
                <search-bar></search-bar>
              </div>
            </div>

            <!-- Right Side Of Navbar -->
            <div class="navbar-end">
                <!-- Authentication Links -->
                <router-link class="navbar-item is-tab" to="/login" v-if="!$auth.check()">
                    <p>Login</p>
                </router-link>
                <router-link class="navbar-item is-tab" to="/register" v-if="!$auth.check()">
                    <p>Sign up</p>
                </router-link>
                <span class="navbar-item is-tab" v-if="$auth.check()">
                    <a href="/">Favorites</a>
                </span>
                <span class="navbar-item is-tab" v-if="$auth.check()">
                    <a href="/">Messages</a>
                </span>
                <span class="navbar-item has-dropdown is-hoverable navbar-selector" v-if="$auth.check()">
                    <div class="navbar-link">
                        <span class="has-lr-margins is-round">
                            <figure class="image is-32x32">
                                <img :src="this.profilePicURL">
                            </figure>
                        </span>
                        <span>
                            <a href="#">
                                <span>{{this.$auth.user().name}}</span> 
                            </a>
                        </span>
                    </div>
                    <div class="navbar-dropdown" id="dropDownMenu">
                        <div class="level navbar-item">
                            <div class="level-left">
                                <div class="level-item">
                                    <span class="icon">
                                    <i class="fa fa-sign-out"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <a href="#" onclick="">
                                        My Listings
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="navbar-divider">
                        <div class="level navbar-item">
                            <div class="level-left">
                                <div class="level-item">
                                    <span class="icon">
                                    <i class="fa fa-sign-out"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <a href="#" onclick="">
                                        Account
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="navbar-divider">
                        <div class="level navbar-item">
                            <div class="level-left">
                                <div class="level-item">
                                    <span class="icon">
                                    <i class="fa fa-sign-out"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <a href="#" @click.prevent="$auth.logout()">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </span>
            </div>
          </div>
        </div>
        	<!-- The Notifications
        <notifications group="success" :duration="3000" :width="300" animation-name=" v-fade-right" position="top right">
          <template slot="body" slot-scope="props">
                  <article class="message is-success">
                <div class="message-header">
                  {{props.item.title}}
                  <button class="delete" aria-label="delete" @click="props.close"></button>
                </div>
                      <div class="message-body" v-text="props.item.text">
                      </div>
                    </article>
            </template>
        </notifications>
        <notifications group="error" :duration="5000" :width="300" animation-name="v-fade-right" position="top right">
          <template slot="body" slot-scope="props">
              <article class="message is-danger">
                <div class="message-header">
                  {{props.item.title}}
                  <button class="delete" aria-label="delete" @click="props.close"></button>
                </div>
                <div class="message-body" v-text="props.item.text">
                </div>
              </article>
          </template>
        </notifications>
         End Notifications-->
    </div>
</template>


<script>
import SearchBar from "../SearchBar";

export default {
  props: ["appName"],
  components: { SearchBar },
  data() {
    let profileURL = "";
    if (this.$auth.user() != null) {
      profileURL = "public/uploads/avatars/" + this.$auth.user().profile_pic;
    }
    return {
      profilePicURL: profileURL,
      navIsActive: false,
      searchExpanded: false
    };
  },
  methods: {
    toggleMenu() {
      this.navIsActive = !this.navIsActive;
    },
    logout() {
      axios.post("/logout");
    }
  },
  computed: {}
};
</script>

<style>
.navbar {
  margin-bottom: 2em;
}
/* &[!searchExpanded]{
    border-radius: 30px;
    padding: 5px 5px;
     transition: all 1s ease;
    &::after{
      width: 0%;
      transition: all 0.3s ease;
    }
    i{
      pointer-events: none;
    }
    input{
      width: 28px;
      height: 25px;
      opacity:0;
      cursor: pointer;
      transition: opacity 0.5s ease, width 1s ease;
      -webkit-appearance:none
    } 
  } */
</style>

