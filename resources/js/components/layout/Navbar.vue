<template>
	<div class="navbar has-shadow is-fixed-top">
		<div class="container is-fluid">
			<div class="navbar-brand is-primary">
				<!-- Branding Image -->
				<span class="navbar-item">
					<router-link class="navbar-main-item" to="/" exact>{{this.appName}}</router-link>
				</span>

				<!-- Collapsed Hamburger -->
				<span
					class="navbar-burger burger is-hoverable"
					@click="toggleMenu"
					:class="{'is-active': navIsActive}"
					data-target="navMenu"
				>
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
					<router-link
						class="navbar-item is-tab"
						to="/create-listing"
						v-if="$auth.check()"
					>Post a listing</router-link>
					<router-link class="navbar-item is-tab" :to="{name: 'favorites'}" v-if="$auth.check()">
						<p>Favorites</p>
					</router-link>
					<router-link class="navbar-item is-tab" :to="{name: 'user-listings'}" v-if="$auth.check()">
						<p>My Listings</p>
					</router-link>
					<!-- <span class="navbar-item is-tab" v-if="$auth.check()">
                    <a href="/">Messages</a>
					</span>-->
					<a class="navbar-item is-tab" v-if="$auth.check()" @click.prevent="$auth.logout()">Logout</a>
				</div>
			</div>
		</div>
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
			profileURL =
				"public/uploads/avatars/" + this.$auth.user().profile_pic;
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

