vm = new Vue({
    el: 'body',
    data: {
        host: '',
        date: '',
        db: '',
        type: '',
        last_bk: '',
        num_failed_bk: '',
        retried: '',
        status: '',
        observation: '',
        report_id: '',
        reports: [],
        requestID: '',
        observation: '',
        error_id: '',
        id_for_report: '',
        errors: []
    },
    ready: function() {
        this.getReports();
    },
    methods: {
        edit: function(id) {
            //alert(this);
            this.report_id = id;
            this.$http.get('/oracle/edit/' + id, function(response) {
                this.host = response.host;
                this.date = response.date;
                this.db = response.db;
                this.type = response.type;
                this.last_bk = response.last_bk;
                this.num_failed_bk = response.num_failed_bk;
                this.retried = response.retried;
                this.status = response.status;
                this.observation = response.observation;
                //console.log(response);
            });
        },
        borrar: function(id) {
            //alert(id);
                        //alert(id);
            swal({   
                title: "¿Estas seguro?",   
                text: "Una vez borrado , no se podra recuperar!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Si",   
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, 
            function(){ 
            vm.report_id = id;
            vm.$http.get('/oracle/delete/' + id, function(response) {
                location.reload();
            });
                swal("Deleted!", 
                    "Ha sido borrado.",
                    "success"); 
            });

        },
        validate: function() {
            return false;
            alert('cr');
        },
        // Add observation field to the modal
        addObservationToModal: function(id) {
            this.requestID = id;
            //console.log(this.requestID);
            //Loop throught the team array and find the id
            this.reports.forEach(function(report) {
                if (report.id == vm.requestID) {
                    // Assign description value the current clicked ocupation
                    vm.observation = report.observation;
                    //console.log(report.observation);
                }
            });
        },
        // add error to modal
        addErrorToModal: function(id)
        {
            //alert(id);
            this.error_id= id;
            //console.log(this.requestID);
            //Loop throught the team array and find the id
            this.reports.forEach(function(report)
            {
                if(report.id == vm.error_id)
                {
                    // Assign description value the current clicked ocupation
                    vm.id_for_report = report.id;
                    //console.log(report.observation);
                }
            });
        },
        // Display errors within the modalbox
        displayErrorsInModal: function(id)
        {
            this.$http.post('/getErrors' ,{id: id , entorno: 'oracle'},  function(errors){
                //console.log(errors);
                vm.errors = errors;
            })      }
        ,
        // Get all reports
        getReports: function() {
            this.$http.get('/oracle/reports', function(reports) {
                //console.log(reports);
                vm.reports = reports;
            })
        }
    }
});
// Jquery section
$(document).ready(function() {
    $('#bootstrap-table tr').each(function() {
        if (!this.rowIndex) return; // skip first row
        var customerId = $(this).find("td").eq(6).html();
        if (customerId == 'Si') {
            $(this).find("td").eq(6).parent().css({
                'background-color': '#DFF2BF'
            });
            var p = $(this).find("td").eq(6).parent();
        }
        if (customerId == 'No') {
            $(this).find("td").eq(6).parent().css({
                'background-color': '#FFBABA'
            });
            var p = $(this).find("td").eq(6).parent();
        }
        // compareTables1(customerId, i);
        //    $('input:submit').attr("disabled", true);
    });
});