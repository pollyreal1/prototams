<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 mx-auto">
                <button class="btn btn-primary" @click.prevent="redirect('scheduleindex')">Back</button>
                <br><br>
            </div>
            <div class="col-md-12 mx-auto">
                <CreateSchedule></CreateSchedule>
            </div>
        </div>
    </div>
</template>

<script>

    import createSchedule from '@/components/Schedule/Create'

    export default{
        components:{
            'CreateSchedule': createSchedule,
        }
    }

</script>
