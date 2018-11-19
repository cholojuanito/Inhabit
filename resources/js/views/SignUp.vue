<template>
<div class="container has-top-margin">
    <div class="column is-6 is-offset-3">
        <div class="box">
            <div class="title has-text-centered">Sign up</div>

            <form class="form-horizontal" method="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="_method" value="POST">

                <label for="name" class="label">Name</label>
                <div class="field">
                    <div class="control is-expanded has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
                        <input v-model="form.name" id="name" type="text" class="input" name="name"  placeholder="John Smith" required autofocus> 
                        <strong class="help is-danger" v-if="form.errors.has('name')">{{form.errors.get('name')}}</strong>
                    </div>
                </div>

                <div class="field">
                    <label for="email" class="label">E-Mail</label>

                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input v-model="form.email" id="email" type="email" class="input" v-bind:class="{ 'is-danger': form.errors.has('email') }" name="email" placeholder="john@smith.net" required> 
                        <strong class="help is-danger" v-if="form.errors.has('email')">{{form.errors.get('email')}}</strong>
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="label">Password</label>

                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input v-model="form.password" id="password" type="password" class="input" v-bind:class="{ 'is-danger': form.errors.has('password') }" name="password" required> 
                        <strong class="help is-danger" v-if="form.errors.has('password')">{{form.errors.get('password')}}</strong>
                    </div>
                </div>

                <div class="field">
                    <label for="password-confirm" class="label">Confirm Password</label>

                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input v-model="form.password_confirmation" id="password-confirm" type="password" class="input"  v-bind:class="{ 'is-danger': form.errors.has('password') }" name="password_confirmation" required>
                        <strong class="help is-danger" v-if="form.errors.has('password')">{{form.errors.get('password')}}</strong>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">
                            Sign up
                        </button>
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
                </div> -->
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
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      }),
      csrf: CSRF
    };
  },
  methods: {
    onSubmit() {
      this.$auth.register({
        data: {
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation
        },
        rememberMe: true,
        fetchUser: true,
        redirect: {
          name: "browse",
          params: { successRegistrationRedirect: true }
        },
        success: function() {
          this.onSuccess();
        },
        error: function(errors) {
          this.onFailure(errors.response.data);
        }
      });
    },
    onSuccess() {
      // This is my ugly work around for now
      this.$auth.login({
        data: {
          email: this.form.email,
          password: this.form.password
        },
        rememberMe: true,
        fetchUser: true,
        success: function() {},
        error: function(errors) {
          this.onFailure(errors.response.data);
        }
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


