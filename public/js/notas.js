                        $(function(){
                            $('#oracleReports tr td').each(function(){
                                var i = $(this).index();
                                // since i'm interested in the 3rd column, I check for i === 2
                                // if you were interested in the 9th column, it would be i === 8
                                if (i === 1) {
                                    $(this).css({ 'color': 'red' });
                                }
                            });
                        });


                                            display: function (data) {
                        console.log(data.record.status);
                        console.log(this);
                        $("#oracleReports tr td").css({color: 'red'});
                    }



                       /* display: function (data) {
                        console.log(444);
                        if (data.record) {
                        return  data.record.status;
                        console.log(data.record.status);
                        } 
                    }*/