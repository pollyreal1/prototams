import Vue from 'vue';

export default Vue.mixin({

    notifications: {
        toastr: {
            timeout: 5000,
            title: '',
            message: '',
            type: 'success'
        }
    },

    methods:{

        // method, url, params, options
		axiosRequest (method, url, params, headers, api_token = true) {

			// ***************
			const instance = this.$axios({
				method: method,
				url: url,
				data: params,
				headers: headers,
				timeout: 60000,
				responseType: 'json',
			});

			// ***************
			let checker = instance
			// ***************
			checker.then(res => {
				this.$store.state.errorStatus = '';
			})
			checker.catch(error => {
				if (!error.response) {
					// network error
					this.$store.state.errorStatus = 'Error: Network Error';
				} else {
					this.$store.state.errorStatus = error.response.data.message;
				}
			})
			// RETURN INSTANCE
			return instance;
		},

        mixinsToastr(title = null, msg = null, type = 'success'){
            this.toastr({ message: msg, title: title, type: type });
        },

        // FOR ROUTE
		redirect(name,params){
			this.$router.push({ name: name, params: params })
		},


    toWeekDay(id){
      let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      return weekday[id];
    },

        toHumanTime(time){
            return new Date('7/10/2013 '+time).toLocaleTimeString().replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
        },

        timeConvert(n) {
          var num = n;
          var hours = (num / 60);
          var rhours = Math.floor(hours);
          var minutes = (hours - rhours) * 60;
          var rminutes = (Math.round(minutes) == 0) ? '00' : Math.round(minutes);
          return rhours + ":" + rminutes + ':00';
        },

        timeConvertToHuman(n) {
          var num = n;
          var hours = (num / 60);
          var rhours = Math.floor(hours);
          var minutes = (hours - rhours) * 60;
          var rminutes = (Math.round(minutes) == 0) ? '00' : Math.round(minutes);
          return (rhours == 0) ? (rminutes + ' mins') : (rhours + " hr " + rminutes + ' mins');
        }


    },

});
