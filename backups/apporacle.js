new Vue({
	el: 'body',
	data: {
		reports: [],
		host: '',
		date: '',
		db: '',
		type: '',
		last_bk: '',
		num_failed_bk: '',
		retried: '',
		status: '',
		observation: '',
		report_id: ''
	},
	ready: function()
	{
		// load reports
		this.getReports();
	},
	methods: {
		// Get reports
		getReports: function()
		{
			this.$http.get('/oracle/reports' , function(reports){
				this.reports = reports;
				console.log(reports);
			});
		},
		// Edit a report
		edit: function(id)
		{
			//alert(this);
			//console.log(this);
			this.report_id = id;

			this.$http.get('/oracle/edit/'+ id, function(response){
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
				//
				// Refresh the page calling getReports again
				this.getReports();
			});
			
		},
		// Delete a report
		borrar: function(id)
		{
			//alert(id);
			
			this.report_id = id;

			this.$http.get('/oracle/delete/'+ id, function(response){
				//location.reload();
				//console.log(response);
				// Refresh the page calling getReports again
				this.getReports();

			});
		},
		validate: function()
		{
			return false;
			alert('cr');
		}
	}
});

function passDataToModalBox()
{
	//alert('passing data to modal');
	console.log(($this).parent());
}

$(document).ready(function(){

	    $('#bootstrap-table tr').each(function() {
            if (!this.rowIndex) return; // skip first row
            
            var customerId = $(this).find("td").eq(6).html();
            if(customerId == 'Si')
            {
            	$(this).find("td").eq(6).parent().css({'background-color': '#DFF2BF'});
            	var p = $(this).find("td").eq(6).parent();
            	console.log(p);
            }
           if(customerId == 'No')
            {
            	$(this).find("td").eq(6).parent().css({'background-color': '#FFBABA'});
            	var p = $(this).find("td").eq(6).parent();
            	console.log(p);
            }
           // compareTables1(customerId, i);
    	//    $('input:submit').attr("disabled", true);

        });
});