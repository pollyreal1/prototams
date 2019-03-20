import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import ScheduleIndex from '@/components/Schedule/Index'
import ScheduleAll from '@/components/Schedule/All'

Vue.use(Router)



export default new Router({
    routes: [
        {path: '/',name: 'HelloWorld',component: HelloWorld},
        // {path: '/',name: 'scheduleindex',component: ScheduleIndex},
        {path: '/schedule',name: 'scheduleindex',component: ScheduleAll},
    ]
})
