<template>
    <div class="container-fluid" style="margin-top:10px">
        <div class="row">
            <!-- {{ infos }} -->
            <div class="col-md-2" v-for="info in infos" v-if="info !== null" >
                
                <div class="panel panel-default" style="max-height: 310px; min-height: 310px; min-width: 230px;">
                    <div class="panel-heading"><center><h4><b>{{ info.firstname + " " + info.lastname}}</b></h4></center></div>
                    <div class="panel-body">
                        <center>
                            <img v-bind:src="info.image" width="150" />
                        </center>
                        <p>Department: {{ info.department_id }}</p> 
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
                infos: [],
                image: null
            }
        },
        created() {
            console.log("Listening...")
            Echo.channel('channelevent')

            .listen('TriggerEvent', (data) => {
                // data = _.flatten(data);
               
                this.infos = data;
                // this.image = data[0].image
                
            })


        }
    }
    
</script>
