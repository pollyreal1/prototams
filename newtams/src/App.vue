<template>
	<div id="app">
		<!-- <img src="./assets/logo.png"> -->

		<div v-if="$store.state.auth">
			<Navigation></Navigation>
			<router-view/>
		</div>
		<div v-else>

			<div class="container mt-5">
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<div class="card">
							<div class="card-header">Login</div>
							<div class="card-body">

								<div class="alert alert-danger" v-if="message">
									{{ message }}
								</div><br />

								<notif :notif="notif"></notif>

								<form @submit.prevent="login()" method="POST">

									<div class="row">
										<div class="col-md-3">Username</div>
										<div class="col-md-9">
											<input type="email" v-model="auth.email" class="form-control" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">Password</div>
										<div class="col-md-9">
											<input type="password" v-model="auth.password" class="form-control" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-9 text-right">
											<button :disabled="!button_enabled" class="btn btn-default">
												{{ button_signin }}
											</button>
										</div>
									</div>
									<div class="clearfix"></div><br />

								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import HeaderNav from '@/components/Includes/Nav';

export default {
	name: 'App',
	components:{
		'Navigation': HeaderNav,
	},
	data () {
		return {
			auth: {
				email: '',
				password: '',
			},
			button_signin: 'Sign in',
			button_enabled: true,
			notif: '',
			message: '',
		}
	},

	methods: {
		login () {

			this.button_enabled = false
			this.button_signin = "Signing in"

			this.$axios.post(this.$store.state.server_path + 'login', this.auth)
			.then(res => {

				// this.notif = res.data
				this.message = res.data.message

				if (res.data.status == 'success') {
					this.$store.state.auth = res.data.data
				}
				else {
					this.$store.state.auth = null
				}
				this.button_signin = "Sign in"
				this.button_enabled = true
			})
			.catch(err => console.log(err))

		}
	}

}
</script>

<style>
/* #app {
font-family: 'Avenir', Helvetica, Arial, sans-serif;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
text-align: center;
color: #2c3e50;
margin-top: 60px;
} */
</style>
