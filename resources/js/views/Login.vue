<template>
	<div class="container has-top-margin">
		<div class="column is-6 is-offset-3">
			<div class="box">
				<div class="title has-text-centered">Login</div>

				<form
					class="form-horizontal"
					method="POST"
					@submit.prevent="onSubmit"
					@keydown="form.errors.clear($event.target.name)"
				>
					<input type="hidden" name="_token" :value="csrf">
					<input type="hidden" name="_method" value="POST">

					<div class="field">
						<label for="email" class="label">E-Mail</label>

						<div class="control has-icons-left">
							<span class="icon is-small is-left">
								<i class="fa fa-envelope"></i>
							</span>
							<input
								v-model="form.email"
								id="email"
								type="email"
								class="input"
								v-bind:class="{ 'is-danger': form.errors.has('invalid_login') }"
								name="invalid_login"
								placeholder="john@smith.net"
								required
							>
						</div>
					</div>

					<div class="field">
						<label for="password" class="label">Password</label>

						<div class="control has-icons-left">
							<span class="icon is-small is-left">
								<i class="fa fa-lock"></i>
							</span>
							<input
								v-model="form.password"
								id="password"
								type="password"
								class="input"
								v-bind:class="{ 'is-danger': form.errors.has('invalid_login') }"
								name="invalid_login"
								required
							>
						</div>
					</div>

					<div class="content">
						<strong class="help is-danger" v-if="form.errors.has('invalid_login')">{{form.notification}}</strong>
					</div>

					<div class="field">
						<div class="control">
							<button type="submit" class="button is-primary">Login</button>
						</div>
					</div>
					<!-- <div class="is-divider" data-content="OR"></div>
                <div class="field">
                    <span>Sign up with </span>
                </div>
                <div class="field is-grouped is-grouped-centered">
                    <div class="control">
                        <a href="{{ url('/auth/facebook') }}" class="is-fb-button">
                            <span class="icon">
                                <i class="fa fa-facebook"></i>
                            </span>
                            <span>Facebook</span>
                        </a>
                    </div>
					</div>-->
				</form>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			form: new Form({
				email: "",
				password: ""
			}),
			csrf: CSRF
		};
	},
	methods: {
		onSubmit() {
			this.$auth.login({
				data: {
					email: this.form.email,
					password: this.form.password
				},
				rememberMe: true,
				fetchUser: true,
				success: function(response) {
					this.onSuccess();
				},
				error: function(errors) {
					this.onFailure(errors.response.data);
				}
			});
		},
		onSuccess() {
			// Get the user's data so it is available
			this.$auth
				.fetch()
				.then(response => this.$auth.user(response.data.data.user))
				.catch(function() {});

			this.getUsersInfo();
		},

		getUsersInfo() {
			this.$store
				.dispatch("listings/getUserListings", this.$auth.user().user.id)
				.then(response => {})
				.catch(errors => {
					console.log("Issue getting user's listings");
				});

			this.$store
				.dispatch(
					"listings/getFavoriteListings",
					this.$auth.user().user.id
				)
				.then(response => {})
				.catch(errors => {
					console.log("Issue getting favorites");
				});
		},
		onFailure(errorData) {
			this.form.onFail(errorData);
		}
	}
};
</script>

<style>
.has-top-margin {
	margin-top: 10%;
}
</style>