<template>
    <div class="container-fluid" style="margin-top:10px">
        <div class="row">
            <!-- {{ infos }} -->
            <div class="col-md-6">
                <p>{{ counter }}</p>
               
         <!--        <div class="panel panel-default" style="max-height: 310px; min-height: 310px; min-width: 230px;">
                    <div class="panel-heading"><center><h4><b>{{ info.firstname + " " + info.lastname}}</b></h4></center></div>
                    <div class="panel-body">
                        <center>
                            <img v-bind:src="info.image" width="150" />

                        </center>
                        <p>Department: {{ info.department_id }}</p> 
                    </div>
                    <p>
                        
                    </p>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
    var myArray = [];
    export default {
        // props: [
        //     'msg'
        // ],
        data() {
            return {
                counter: null
            }
        },
        created() {
            console.log("Listening...")
            Echo.channel('counter-channel')

            .listen('CounterEvent', (data) => {
                // data = _.flatten(data);
                console.log(data);
                this.counter = data;
                
                // this.image = data[0].image
                
            })


        }
    }
    
</script>
