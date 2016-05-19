$(document).ready(function () {
        $('#oracleReports').jtable({
            title: 'Reportes Oracle',
            paging: true,
            pageSize: 5,
            //sorting: true,
            
           
            actions: {
                listAction: '/oracle/list',
                createAction: '/oracle/create',
                updateAction: '/oracle/update',
                deleteAction: '/oracle/delete'
            },
            toolbar: {
            items: [{
                tooltip: 'Click here to export this table to excel',
                icon: '/images/excell.png',
                text: 'Exportar Excel',
                click: function () {
                    alert('This item is just a demonstration for new toolbar feature. You can add your custom toolbar items here. Then, for example, you can download excel file from server when user clicks this item. See toolbar in API reference documentation for usage.');
                }
            }]
            },
            fields: {
                id: {
                    key: true,
                    list: false,
                    edit: false,
                    list: false
                },
                date: {
                    title: 'Fecha',
                    width: '10%',
                    type: 'date',
                    //create: false,
                    //edit: false
                },
                db: {
                    title: 'BD',
                    width: '5%'
                },
                host: {
                    title: 'Maquina',
                    width: '10%'
                },
                type: {
                    title: 'Tipo',
                    width: '5%'
                },
                last_bk: {
                    title: 'Ultimo BK correcto',
                    width: '14%'
                },
                num_failed_bk: {
                    title: 'Numero fallidos',
                    width: '12%'
                },
                retried: {
                    title: 'Relanzado',
                    width: '2%',
                    options: ['SI','NO']
                },
                status: {
                    title: 'Fin Ok?',
                    width: '8%',
                    options: ['SI','NO'],
                   /*display: function (data) {
                        if (data.record) {
                        $("#oracleReports tr td").css({color: 'red'});
                        return  data.record.status;
                        console.log(data.record.status);

                        }
                    }*/
                },
                observation: {
                    title: 'Observaciones',
                    width: '34%',
                    type: 'textarea'
                }
            }
        });
    $('#oracleReports').jtable('load');
   

    //var data = $('.jtable').find('tr:nth-child(2)'); //Get All HTML td elements 
    //$(data).css( "background-color", "red" );
   
    
});