<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
            	{{ $store.state.auth.name }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="redirect('HelloWorld')">EDTR <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="redirect('scheduleindex')">Schedule <span class="sr-only">(current)</span></a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="#" @click="logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
	export default {
		methods: {
			logout () {
				this.$store.state.auth = ''
				window.location.href = '/'
			}
		}
	}
</script>
