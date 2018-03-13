<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" v-for="info in infos">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h4>{{ info.firstname + " " + info.lastname}}</h4></center></div>

                    <div class="panel-body">
                        <center>
                            <img v-show="info.image" class="img img-rounded" :src="info.image"/>
                        </center>
                        <p>Department: {{ info.department_id }}</p> 
                        <!-- <p>{{ message }}</p> -->
                    </div>
                    <p>
                        
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        props: [
            'msg'
        ],
        data() {
            return {
                infos: []
            }
        },
        created() {
            Echo.channel('channelevent')
            .listen('TriggerEvent', (e) => {
                this.infos = e
            })

            console.log(e);
        }
    }
    
</script>
